<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user()->load('defaultAddress');

        return response()->json([
            'success' => true,
            'data' => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'phone'    => $user->phone,
                'avatar'   => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'city'     => $user->city,
                'address'  => $user->address,
                'default_address' => $user->defaultAddress,
            ]
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();

       $validated = $request->validate([
            'name'    => ['nullable', 'string', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'city'    => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'avatar'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);


        $dataToUpdate = array_filter($validated, fn($value) => !is_null($value));

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $dataToUpdate['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($dataToUpdate);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated!',
            'data'    => $user->fresh(),
        ]);
    }

    public function deactivateAccount(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->update(['status' => 'inactive']);
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Account deactivated.',
        ]);
    }
}