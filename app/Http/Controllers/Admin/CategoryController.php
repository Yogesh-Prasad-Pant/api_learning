<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{   
    public function index(Request $request)
    {
        $query = Category::with('parent', 'children');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('is_active')) {
            $query->where('is_active', filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->boolean('root_only')) {
            $query->whereNull('parent_id');
        }

        $categories = $query->orderBy('order_priority', 'asc')->latest()->paginate($request->input('per_page', 15));

        return response()->json([
            'success' => true, 
            'message' => 'Categories retrieved successfully.',
            'data'    => $categories,
        ], 200);
    }
    public function getCategories(Request $request)
    {
        $query = Category::where('is_active', true)->with('parent', 'children');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        if ($request->boolean('root_only')) {
            $query->whereNull('parent_id');
        }

        $categories = $request->boolean('all')
            ? $query->orderBy('order_priority', 'asc')->latest()->get()
            : $query->orderBy('order_priority', 'asc')->latest()->paginate($request->input('per_page', 15));

        // CategoryResource strips out commission_rate, is_active, etc. for all categories & children
        return CategoryResource::collection($categories)->additional([
            'success' => true,
            'message' => 'Public categories retrieved successfully.',
        ]);
    }
    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);

        // Upload media files using helper method
        $this->handleMediaUploads($request, $validated);

        $category = new Category($validated);
        $this->assignGuardedFields($request, $category);
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data'    => $category->load('parent')
        ], 201);
    }
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data'    => $category->load(['parent', 'children'])
        ], 200);
    }
    public function update(Request $request, Category $category)
    {
        $validated = $this->validateCategory($request, $category->id);

        $this->handleMediaUploads($request, $validated, $category);

        $category->fill($validated);
        $this->assignGuardedFields($request, $category);
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data'    => $category->load('parent')
        ], 200);
    }
    public function destroy(Category $category)
    {
        // Delete all attached media files
        $this->deleteMediaFile($category->image);
        $this->deleteMediaFile($category->banner);

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ], 200);
    }
    private function validateCategory(Request $request, $id = null): array
    {
        $uniqueName = 'unique:categories,name' . ($id ? ",{$id}" : '');
        $uniqueSlug = 'unique:categories,slug' . ($id ? ",{$id}" : '');
        $nameRule   = $id ? 'sometimes|required' : 'required';

        return $request->validate([
            'name'             => "{$nameRule}|string|max:255|{$uniqueName}",
            'slug'             => "nullable|string|max:255|{$uniqueSlug}",
            'parent_id'        => 'nullable|exists:categories,id' . ($id ? "|different:{$id}" : ''),
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon'             => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'is_active'        => 'boolean',
            'is_featured'      => 'boolean',
            'is_menu'          => 'boolean',
            'order_priority'   => 'nullable|integer',
            'commission_rate'  => 'nullable|numeric|min:0|max:100',
            'attributes'       => 'nullable|array',
        ]);
    }
    private function handleMediaUploads(Request $request, array &$validated, ?Category $category = null): void
    {
        if ($request->hasFile('image')) {
            if ($category) {
                $this->deleteMediaFile($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($category) {
                $this->deleteMediaFile($category->banner);
            }
            $validated['banner'] = $request->file('banner')->store('categories/banners', 'public');
        }
    }
    private function deleteMediaFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
    private function assignGuardedFields(Request $request, Category $category): void
    {
        if ($request->has('is_active')) {
            $category->is_active = $request->boolean('is_active');
        }
        if ($request->has('is_featured')) {
            $category->is_featured = $request->boolean('is_featured');
        }
        if ($request->has('is_menu')) {
            $category->is_menu = $request->boolean('is_menu');
        }
        if ($request->has('commission_rate')) {
            $category->commission_rate = $request->input('commission_rate');
        }
    }
}