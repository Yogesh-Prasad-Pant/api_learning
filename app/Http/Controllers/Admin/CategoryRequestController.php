<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryRequestController extends Controller
{
    // SHOP ADMIN METHODS 
    public function store(Request $request){
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'reason'              => ['nullable', 'string', 'max:1000'],
            'suggested_parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;
        $admin = auth('admin')->user();

        $categoryRequest = new CategoryRequest();
        $categoryRequest->fill($validated);
        $categoryRequest->admin_id = $admin->id;
        $categoryRequest->shop_id  = $shopId;
        $categoryRequest->status   = 'pending';
        $categoryRequest->save();

        return response()->json([
            'message' => 'Category request submitted successfully and is pending Superadmin review.',
            'data'    => $categoryRequest->load('suggestedParent:id,name'),
        ], 201);
    }
    public function myShopRequest(Request $request){
        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;
        $admin = auth('admin')->user();

        $requests = CategoryRequest::with('suggestedParent:id,name')
            ->where('shop_id', $shopId)
            ->where('admin_id', $admin->id)
            ->latest()
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'status' => 'success',
            'data'   => $requests,
        ]);
    }
    public function update(Request $request, $id){
        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;
        $admin = auth('admin')->user();

        $categoryRequest = CategoryRequest::where('id', $id)
            ->where('shop_id', $shopId)
            ->where('admin_id', $admin->id)
            ->firstOrFail();

        if ($categoryRequest->status !== 'pending') {
            return response()->json([
                'message' => 'Cannot update a request that has already been processed.'
            ], 422);
        }

        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'reason'              => ['nullable', 'string', 'max:1000'],
            'suggested_parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $categoryRequest->update($validated);

        return response()->json([
            'message' => 'Category request updated successfully.',
            'data'    => $categoryRequest->load('suggestedParent:id,name'),
        ]);
    }
    public function destroy(Request $request, $id){
        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;
        $admin = auth('admin')->user();

        $categoryRequest = CategoryRequest::where('id', $id)
            ->where('shop_id', $shopId)
            ->where('admin_id', $admin->id)
            ->firstOrFail();

        if ($categoryRequest->status !== 'pending') {
            return response()->json([
                'message' => 'Cannot delete a request that has already been processed.'
            ], 422);
        }

        $categoryRequest->delete();

        return response()->json([
            'message' => 'Category request cancelled and deleted successfully.'
        ]);
    }
           // SUPERADMIN METHODS   
                                    
    public function index(Request $request){
        $query = CategoryRequest::with([
            'shop:id,name',
            'admin:id,name,email',
            'suggestedParent:id,name',
        ]);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate($request->get('per_page', 15));

        return response()->json([
            'status' => 'success',
            'data'   => $requests,
        ]);
    }
    public function approve(Request $request, $id){
        $categoryRequest = CategoryRequest::findOrFail($id);

        if ($categoryRequest->status !== 'pending') {
            return response()->json([
                'message' => 'This request has already been processed.'
            ], 422);
        }

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'parent_id'       => 'nullable|exists:categories,id',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'admin_note'      => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($categoryRequest, $validated) {
            $category = new Category();
            $category->name      = $validated['name'];
            $category->parent_id = $validated['parent_id'] ?? $categoryRequest->suggested_parent_id;

            if (isset($validated['commission_rate'])) {
                $category->commission_rate = $validated['commission_rate'];
            }
            $category->is_active = true;
            $category->save();

            // Link category to shop
            if ($categoryRequest->shop) {
                $categoryRequest->shop->categories()->syncWithoutDetaching([$category->id]);
            }

            $categoryRequest->update([
                'status'     => 'approved',
                'admin_note' => $validated['admin_note'] ?? 'Approved and attached to your shop.',
            ]);
        });

        return response()->json([
            'message' => 'Category request approved, master category created, and linked to shop successfully.',
        ]);
    }
    public function reject(Request $request, $id){
        $categoryRequest = CategoryRequest::findOrFail($id);

        if ($categoryRequest->status !== 'pending') {
            return response()->json([
                'message' => 'This request has already been processed.'
            ], 422);
        }

        $validated = $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $categoryRequest->update([
            'status'     => 'rejected',
            'admin_note' => $validated['admin_note'],
        ]);

        return response()->json([
            'message' => 'Category request rejected.',
            'data'    => $categoryRequest,
        ]);
    }
}