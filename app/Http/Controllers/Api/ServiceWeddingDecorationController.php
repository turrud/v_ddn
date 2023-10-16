<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceWeddingDecoration;
use App\Http\Resources\ServiceWeddingDecorationResource;
use App\Http\Resources\ServiceWeddingDecorationCollection;
use App\Http\Requests\ServiceWeddingDecorationStoreRequest;
use App\Http\Requests\ServiceWeddingDecorationUpdateRequest;

class ServiceWeddingDecorationController extends Controller
{
    public function index(Request $request): ServiceWeddingDecorationCollection
    {
        $this->authorize('view-any', ServiceWeddingDecoration::class);

        $search = $request->get('search', '');

        $serviceWeddingDecorations = ServiceWeddingDecoration::search($search)
            ->latest()
            ->paginate();

        return new ServiceWeddingDecorationCollection(
            $serviceWeddingDecorations
        );
    }

    public function store(
        ServiceWeddingDecorationStoreRequest $request
    ): ServiceWeddingDecorationResource {
            $this->authorize('create', ServiceWeddingDecoration::class);

            $validated = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->storeAs('public/service-wedding-decorations', $image->getClientOriginalName());
                $validated['image'] = $imagePath;
            }

            $serviceWeddingDecoration = ServiceWeddingDecoration::create($validated);

            return new ServiceWeddingDecorationResource($serviceWeddingDecoration);

    }

    public function show(
        Request $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): ServiceWeddingDecorationResource {
        $this->authorize('view', $serviceWeddingDecoration);

        return new ServiceWeddingDecorationResource($serviceWeddingDecoration);
    }

    public function update(
        ServiceWeddingDecorationUpdateRequest $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): ServiceWeddingDecorationResource {
        $this->authorize('update', $serviceWeddingDecoration);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceWeddingDecoration->image) {
                Storage::delete($serviceWeddingDecoration->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-wedding-decorations', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceWeddingDecoration->update($validated);

        return new ServiceWeddingDecorationResource($serviceWeddingDecoration);

    }

    public function destroy(
        Request $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): Response {
        $this->authorize('delete', $serviceWeddingDecoration);

        if ($serviceWeddingDecoration->image) {
            Storage::delete($serviceWeddingDecoration->image);
        }

        $serviceWeddingDecoration->delete();

        return response()->noContent();
    }
}