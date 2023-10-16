<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Store3dFurniture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Store3dFurnitureResource;
use App\Http\Resources\Store3dFurnitureCollection;
use App\Http\Requests\Store3dFurnitureStoreRequest;
use App\Http\Requests\Store3dFurnitureUpdateRequest;

class Store3dFurnitureController extends Controller
{
    public function index(Request $request): Store3dFurnitureCollection
    {
        $this->authorize('view-any', Store3dFurniture::class);

        $search = $request->get('search', '');

        $store3dFurnitures = Store3dFurniture::search($search)
            ->latest()
            ->paginate();

        return new Store3dFurnitureCollection($store3dFurnitures);
    }

    public function store(
        Store3dFurnitureStoreRequest $request
    ): Store3dFurnitureResource {
        $this->authorize('create', Store3dFurniture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-furnitures', $imageName);
            $validated['image'] = 'store/images/3d-furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-furnitures', $fileName);
            $validated['file'] = 'store/files/3d-furnitures/' . $fileName;
        }

        $store3dFurniture = Store3dFurniture::create($validated);

        return new Store3dFurnitureResource($store3dFurniture);

    }

    public function show(
        Request $request,
        Store3dFurniture $store3dFurniture
    ): Store3dFurnitureResource {
        $this->authorize('view', $store3dFurniture);

        return new Store3dFurnitureResource($store3dFurniture);
    }

    public function update(
        Store3dFurnitureUpdateRequest $request,
        Store3dFurniture $store3dFurniture
    ): Store3dFurnitureResource {
        $this->authorize('update', $store3dFurniture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-furnitures', $imageName);
            $validated['image'] = 'store/images/3d-furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-furnitures', $fileName);
            $validated['file'] = 'store/files/3d-furnitures/' . $fileName;
        }

        $store3dFurniture->update($validated);

        return new Store3dFurnitureResource($store3dFurniture);

    }

    public function destroy(
        Request $request,
        Store3dFurniture $store3dFurniture
    ): Response {
        $this->authorize('delete', $store3dFurniture);

        if ($store3dFurniture->image) {
            Storage::delete($store3dFurniture->image);
        }

        if ($store3dFurniture->file) {
            Storage::delete($store3dFurniture->file);
        }

        $store3dFurniture->delete();

        return response()->noContent();
    }
}
