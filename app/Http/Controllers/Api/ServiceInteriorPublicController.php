<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\ServiceInteriorPublic;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceInteriorPublicResource;
use App\Http\Resources\ServiceInteriorPublicCollection;
use App\Http\Requests\ServiceInteriorPublicStoreRequest;
use App\Http\Requests\ServiceInteriorPublicUpdateRequest;

class ServiceInteriorPublicController extends Controller
{
    public function index(Request $request): ServiceInteriorPublicCollection
    {
        $this->authorize('view-any', ServiceInteriorPublic::class);

        $search = $request->get('search', '');

        $serviceInteriorPublics = ServiceInteriorPublic::search($search)
            ->latest()
            ->paginate();

        return new ServiceInteriorPublicCollection($serviceInteriorPublics);
    }

    public function store(
        ServiceInteriorPublicStoreRequest $request
    ): ServiceInteriorPublicResource {
        $this->authorize('create', ServiceInteriorPublic::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-interior-publics', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorPublic = ServiceInteriorPublic::create($validated);

        return new ServiceInteriorPublicResource($serviceInteriorPublic);

    }

    public function show(
        Request $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): ServiceInteriorPublicResource {
        $this->authorize('view', $serviceInteriorPublic);

        return new ServiceInteriorPublicResource($serviceInteriorPublic);
    }

    public function update(
        ServiceInteriorPublicUpdateRequest $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): ServiceInteriorPublicResource {
        $this->authorize('update', $serviceInteriorPublic);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceInteriorPublic->image) {
                Storage::delete($serviceInteriorPublic->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-interior-publics', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorPublic->update($validated);

        return new ServiceInteriorPublicResource($serviceInteriorPublic);

    }

    public function destroy(
        Request $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): Response {
        $this->authorize('delete', $serviceInteriorPublic);

        if ($serviceInteriorPublic->image) {
            Storage::delete($serviceInteriorPublic->image);
        }

        $serviceInteriorPublic->delete();

        return response()->noContent();
    }
}
