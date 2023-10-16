<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Store3dArchitecture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Store3dArchitectureResource;
use App\Http\Resources\Store3dArchitectureCollection;
use App\Http\Requests\Store3dArchitectureStoreRequest;
use App\Http\Requests\Store3dArchitectureUpdateRequest;

class Store3dArchitectureController extends Controller
{
    public function index(Request $request): Store3dArchitectureCollection
    {
        $this->authorize('view-any', Store3dArchitecture::class);

        $search = $request->get('search', '');

        $store3dArchitectures = Store3dArchitecture::search($search)
            ->latest()
            ->paginate();

        return new Store3dArchitectureCollection($store3dArchitectures);
    }

    public function store(
        Store3dArchitectureStoreRequest $request
    ): Store3dArchitectureResource {
        $this->authorize('create', Store3dArchitecture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d_architecture', $imageName);
            $validated['image'] = 'store/images/3d_architecture/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d_architecture', $fileName);
            $validated['file'] = 'store/files/3d_architecture/' . $fileName;
        }

        $store3dArchitecture = Store3dArchitecture::create($validated);

        return new Store3dArchitectureResource($store3dArchitecture);

    }

    public function show(
        Request $request,
        Store3dArchitecture $store3dArchitecture
    ): Store3dArchitectureResource {
        $this->authorize('view', $store3dArchitecture);

        return new Store3dArchitectureResource($store3dArchitecture);
    }

    public function update(
        Store3dArchitectureUpdateRequest $request,
        Store3dArchitecture $store3dArchitecture
    ): Store3dArchitectureResource {
        $this->authorize('update', $store3dArchitecture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($store3dArchitecture->image) {
                Storage::delete($store3dArchitecture->image);
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/3d_architecture', $imageName);
            $validated['image'] = 'store/images/3d_architecture/' . $imageName;
        }

        if ($request->hasFile('file')) {
            if ($store3dArchitecture->file) {
                Storage::delete($store3dArchitecture->file);
            }

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/3d_architecture', $fileName);
            $validated['file'] = 'store/files/3d_architecture/' . $fileName;
        }

        $store3dArchitecture->update($validated);

        return new Store3dArchitectureResource($store3dArchitecture);

    }

    public function destroy(
        Request $request,
        Store3dArchitecture $store3dArchitecture
    ): Response {
        $this->authorize('delete', $store3dArchitecture);

        if ($store3dArchitecture->image) {
            Storage::delete($store3dArchitecture->image);
        }

        if ($store3dArchitecture->file) {
            Storage::delete($store3dArchitecture->file);
        }

        $store3dArchitecture->delete();

        return response()->noContent();
    }
}