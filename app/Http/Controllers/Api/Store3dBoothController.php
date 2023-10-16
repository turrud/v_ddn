<?php

namespace App\Http\Controllers\Api;

use App\Models\Store3dBooth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Store3dBoothResource;
use App\Http\Resources\Store3dBoothCollection;
use App\Http\Requests\Store3dBoothStoreRequest;
use App\Http\Requests\Store3dBoothUpdateRequest;

class Store3dBoothController extends Controller
{
    public function index(Request $request): Store3dBoothCollection
    {
        $this->authorize('view-any', Store3dBooth::class);

        $search = $request->get('search', '');

        $store3dBooths = Store3dBooth::search($search)
            ->latest()
            ->paginate();

        return new Store3dBoothCollection($store3dBooths);
    }

    public function store(
        Store3dBoothStoreRequest $request
    ): Store3dBoothResource {
        $this->authorize('create', Store3dBooth::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-booths', $imageName);
            $validated['image'] = 'store/images/3d-booths/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-booths', $fileName);
            $validated['file'] = 'store/files/3d-booths/' . $fileName;
        }

        $store3dBooth = Store3dBooth::create($validated);

        return new Store3dBoothResource($store3dBooth);

    }

    public function show(
        Request $request,
        Store3dBooth $store3dBooth
    ): Store3dBoothResource {
        $this->authorize('view', $store3dBooth);

        return new Store3dBoothResource($store3dBooth);
    }

    public function update(
        Store3dBoothUpdateRequest $request,
        Store3dBooth $store3dBooth
    ): Store3dBoothResource {
        $this->authorize('update', $store3dBooth);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-booths', $imageName);
            $validated['image'] = 'store/images/3d-booths/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-booths', $fileName);
            $validated['file'] = 'store/files/3d-booths/' . $fileName;
        }

        $store3dBooth->update($validated);

        return new Store3dBoothResource($store3dBooth);

    }

    public function destroy(
        Request $request,
        Store3dBooth $store3dBooth
    ): Response {
        $this->authorize('delete', $store3dBooth);

        if ($store3dBooth->image) {
            Storage::delete($store3dBooth->image);
        }

        if ($store3dBooth->file) {
            Storage::delete($store3dBooth->file);
        }

        $store3dBooth->delete();

        return response()->noContent();
    }
}
