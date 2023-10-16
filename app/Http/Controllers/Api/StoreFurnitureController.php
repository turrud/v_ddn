<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StoreFurniture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\StoreFurnitureResource;
use App\Http\Resources\StoreFurnitureCollection;
use App\Http\Requests\StoreFurnitureStoreRequest;
use App\Http\Requests\StoreFurnitureUpdateRequest;

class StoreFurnitureController extends Controller
{
    public function index(Request $request): StoreFurnitureCollection
    {
        $this->authorize('view-any', StoreFurniture::class);

        $search = $request->get('search', '');

        $storeFurnitures = StoreFurniture::search($search)
            ->latest()
            ->paginate();

        return new StoreFurnitureCollection($storeFurnitures);
    }

    public function store(
        StoreFurnitureStoreRequest $request
    ): StoreFurnitureResource {
        $this->authorize('create', StoreFurniture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/store/images/furnitures', $imageName);
            $validated['image'] = 'store/images/furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/store/files/furnitures', $fileName);
            $validated['file'] = 'store/files/furnitures/' . $fileName;
        }

        $storeFurniture = StoreFurniture::create($validated);

        return new StoreFurnitureResource($storeFurniture);

    }

    public function show(
        Request $request,
        StoreFurniture $storeFurniture
    ): StoreFurnitureResource {
        $this->authorize('view', $storeFurniture);

        return new StoreFurnitureResource($storeFurniture);
    }

    public function update(
        StoreFurnitureUpdateRequest $request,
        StoreFurniture $storeFurniture
    ): StoreFurnitureResource {
        $this->authorize('update', $storeFurniture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/store/images/furnitures', $imageName);
            $validated['image'] = 'store/images/furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/store/files/furnitures', $fileName);
            $validated['file'] = 'store/files/furnitures/' . $fileName;
        }

        $storeFurniture->update($validated);

        return new StoreFurnitureResource($storeFurniture);

    }

    public function destroy(
        Request $request,
        StoreFurniture $storeFurniture
    ): Response {
        $this->authorize('delete', $storeFurniture);

        if ($storeFurniture->image) {
            Storage::delete($storeFurniture->image);
        }

        if ($storeFurniture->file) {
            Storage::delete($storeFurniture->file);
        }

        $storeFurniture->delete();

        return response()->noContent();
    }
}
