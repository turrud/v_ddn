<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StoreDecoration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\StoreDecorationResource;
use App\Http\Resources\StoreDecorationCollection;
use App\Http\Requests\StoreDecorationStoreRequest;
use App\Http\Requests\StoreDecorationUpdateRequest;

class StoreDecorationController extends Controller
{
    public function index(Request $request): StoreDecorationCollection
    {
        $this->authorize('view-any', StoreDecoration::class);

        $search = $request->get('search', '');

        $storeDecorations = StoreDecoration::search($search)
            ->latest()
            ->paginate();

        return new StoreDecorationCollection($storeDecorations);
    }

    public function store(
        StoreDecorationStoreRequest $request
    ): StoreDecorationResource {
        $this->authorize('create', StoreDecoration::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/store/images/decorations', $imageName);
            $validated['image'] = 'store/images/decorations/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/store/files/decorations', $fileName);
            $validated['file'] = 'store/files/decorations/' . $fileName;
        }

        $storeDecoration = StoreDecoration::create($validated);

        return new StoreDecorationResource($storeDecoration);

    }

    public function show(
        Request $request,
        StoreDecoration $storeDecoration
    ): StoreDecorationResource {
        $this->authorize('view', $storeDecoration);

        return new StoreDecorationResource($storeDecoration);
    }

    public function update(
        StoreDecorationUpdateRequest $request,
        StoreDecoration $storeDecoration
    ): StoreDecorationResource {
        $this->authorize('update', $storeDecoration);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Dapatkan nama file asli
            $image->storeAs('public/store/images/decorations', $imageName);
            $validated['image'] = 'store/images/decorations/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); // Dapatkan nama file asli
            $file->storeAs('public/store/files/decorations', $fileName);
            $validated['file'] = 'store/files/decorations/' . $fileName;
        }

        $storeDecoration->update($validated);

        return new StoreDecorationResource($storeDecoration);

    }

    public function destroy(
        Request $request,
        StoreDecoration $storeDecoration
    ): Response {
        $this->authorize('delete', $storeDecoration);

        if ($storeDecoration->image) {
            Storage::delete($storeDecoration->image);
        }

        if ($storeDecoration->file) {
            Storage::delete($storeDecoration->file);
        }

        $storeDecoration->delete();

        return response()->noContent();
    }
}