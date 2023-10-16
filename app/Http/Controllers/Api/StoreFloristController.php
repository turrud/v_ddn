<?php

namespace App\Http\Controllers\Api;

use App\Models\StoreFlorist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\StoreFloristResource;
use App\Http\Resources\StoreFloristCollection;
use App\Http\Requests\StoreFloristStoreRequest;
use App\Http\Requests\StoreFloristUpdateRequest;

class StoreFloristController extends Controller
{
    public function index(Request $request): StoreFloristCollection
    {
        $this->authorize('view-any', StoreFlorist::class);

        $search = $request->get('search', '');

        $storeFlorists = StoreFlorist::search($search)
            ->latest()
            ->paginate();

        return new StoreFloristCollection($storeFlorists);
    }

    public function store(
        StoreFloristStoreRequest $request
    ): StoreFloristResource {
        $this->authorize('create', StoreFlorist::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/florists', $imageName);
            $validated['image'] = 'store/images/florists/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/florists', $fileName);
            $validated['file'] = 'store/files/florists/' . $fileName;
        }

        $storeFlorist = StoreFlorist::create($validated);

        return new StoreFloristResource($storeFlorist);

    }

    public function show(
        Request $request,
        StoreFlorist $storeFlorist
    ): StoreFloristResource {
        $this->authorize('view', $storeFlorist);

        return new StoreFloristResource($storeFlorist);
    }

    public function update(
        StoreFloristUpdateRequest $request,
        StoreFlorist $storeFlorist
    ): StoreFloristResource {
        $this->authorize('update', $storeFlorist);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/florists', $imageName);
            $validated['image'] = 'store/images/florists/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/florists', $fileName);
            $validated['file'] = 'store/files/florists/' . $fileName;
        }

        $storeFlorist->update($validated);

        return new StoreFloristResource($storeFlorist);

    }

    public function destroy(
        Request $request,
        StoreFlorist $storeFlorist
    ): Response {
        $this->authorize('delete', $storeFlorist);

        if ($storeFlorist->image) {
            Storage::delete($storeFlorist->image);
        }

        if ($storeFlorist->file) {
            Storage::delete($storeFlorist->file);
        }

        $storeFlorist->delete();

        return response()->noContent();
    }
}
