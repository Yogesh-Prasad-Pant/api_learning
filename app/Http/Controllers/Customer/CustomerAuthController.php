<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'phone'    => ['nullable', 'string', 'max:20', 'unique:users,phone'],
        ]);
        $phone = $request->filled('phone') ? trim($request->phone) : null;
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'], // Auto-hashed via model cast
            'phone'    => $phone,
            'status'   => 'active',
        ]);

        $token = $user->createToken('customer_auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully!',
            'token'   => $token,
            'user'    => $user->only(['id', 'name', 'email', 'phone']),
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        // Clean whitespace first
        $loginInput = trim($request->input('login'));

        $request->merge(['login' => $loginInput]);

        // 1. Basic presence check
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // 2. Distinguish input type
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL) !== false;
        $isPhone = preg_match('/^\+?[0-9]{7,15}$/', $loginInput) === 1;

        // Fail early if it is neither a valid email nor a valid phone number
        if (! $isEmail && ! $isPhone) {
            throw ValidationException::withMessages([
                'login' => ['Please enter a valid email address or phone number.'],
            ]);
        }

        // 3. Query based on detected type
        $user = User::when($isEmail, function ($query) use ($loginInput) {
                    return $query->where('email', $loginInput);
                })
                ->when($isPhone, function ($query) use ($loginInput) {
                    return $query->where('phone', $loginInput);
                })
                ->first();

        // 4. Validate credentials
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials provided.'],
            ]);
        }

        // 5. Account status check
        if ($user->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is ' . $user->status . '. Please contact support.',
            ], 403);
        }

        // 6. Issue Sanctum Token
        $token = $user->createToken('customer_auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully!',
            'token'   => $token,
            'user'    => $user->only(['id', 'name', 'email', 'phone']),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $resetToken = sprintf("%06d", mt_rand(1, 999999));

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => Hash::make($resetToken),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'success'  => true,
            'message'  => 'Password reset code sent to your email.',
            'dev_code' => config('app.debug') ? $resetToken : null,
        ]);
    }
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => ['required', 'email', 'exists:users,email'],
            'token'    => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (! $record || ! Hash::check($request->token, $record->token)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired reset code.',
            ], 422);
        }
        if (now()->subMinutes(15)->greaterThan($record->created_at)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return response()->json([
                'success' => false,
                'message' => 'Reset code has expired. Please request a new one.',
            ], 422);
        }
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => $request->password]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully! You can now log in.',
        ]);
    }
}