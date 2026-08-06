<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CustomerAddressController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        
        // Auth middleware guarantees $request->user() is valid here
        $Addresses = null;
            try {
                $Addresses = $request->user()->addresses()->latest()->get();
            } catch (\Throwable $e) {
                $Addresses = null;
            }
        return response()->json([
            'status'  => true,
            'message' => $Addresses? 'Addresses retrieved successfully.' : 'No addresses found.',
            'data'    => $Addresses,
        ], 200);
    }
    public function store(Request $request)
    {
        try{
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        $user = $request->user();

        $address = DB::transaction(function () use ($user, $validated) {
            $isFirstAddress = $user->addresses()->count() === 0;
            $shouldBeDefault = !empty($validated['is_default']) || $isFirstAddress;

            if ($shouldBeDefault) {
                // Unset all existing defaults for this user
                $user->addresses()->update(['is_default' => false]);
            }

            // Force is_default to true if it should be default
            $validated['is_default'] = $shouldBeDefault;

            return $user->addresses()->create($validated);
        });
        }
        catch (\Throwable $e) {
    return response()->json([
        'status'  => false,
        'message' => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine()
    ], 500);
}

        return response()->json([
            'status' => true,
            'message' => 'Address created successfully.',
            'data' => $address,
        ], 201);
    }
    public function update(Request $request, CustomerAddress $customerAddress)
    {
        if ($customerAddress->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'address_line_1' => 'sometimes|required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'sometimes|required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request, $customerAddress, $validated) {
            if (!empty($validated['is_default'])) {
                $request->user()->addresses()->where('id', '!=', $customerAddress->id)->update(['is_default' => false]);
            }

            $customerAddress->update($validated);
        });

        return response()->json([
            'status' => true,
            'message' => 'Address updated successfully.',
            'data' => $customerAddress->fresh(),
        ]);
    }
    public function setDefault(Request $request, CustomerAddress $customerAddress)
    {
        if ($customerAddress->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Unauthorized action.'], 403);
        }

        DB::transaction(function () use ($request, $customerAddress) {
            $request->user()->addresses()->update(['is_default' => false]);
            $customerAddress->update(['is_default' => true]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Default address set successfully.',
        ]);
    }

    public function destroy(Request $request, CustomerAddress $customerAddress)
    {
        if ($customerAddress->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Unauthorized action.'], 403);
        }
        $wasDefault = $customerAddress->is_default;
        $customerAddress->delete();
        if ($wasDefault) {
            $nextAddress = $request->user()->addresses()->first();
            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Address deleted successfully.',
        ]);
    }
    public function show(Request $request, CustomerAddress $customerAddress): JsonResponse
    {
        if ($customerAddress->user_id !== $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'Unauthorized action.'], 403);
        }

        return response()->json([
            'status' => true,
            'data'   => $customerAddress,
        ]);
    }
}
