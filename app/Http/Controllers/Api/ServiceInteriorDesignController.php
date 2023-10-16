<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\ServiceInteriorDesign;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceInteriorDesignResource;
use App\Http\Resources\ServiceInteriorDesignCollection;
use App\Http\Requests\ServiceInteriorDesignStoreRequest;
use App\Http\Requests\ServiceInteriorDesignUpdateRequest;

class ServiceInteriorDesignController extends Controller
{
    public function index(Request $request): ServiceInteriorDesignCollection
    {
        $this->authorize('view-any', ServiceInteriorDesign::class);

        $search = $request->get('search', '');

        $serviceInteriorDesigns = ServiceInteriorDesign::search($search)
            ->latest()
            ->paginate();

        return new ServiceInteriorDesignCollection($serviceInteriorDesigns);
    }

    public function store(
        ServiceInteriorDesignStoreRequest $request
    ): ServiceInteriorDesignResource {
        $this->authorize('create', ServiceInteriorDesign::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_interior_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorDesign = ServiceInteriorDesign::create($validated);

        return new ServiceInteriorDesignResource($serviceInteriorDesign);

    }

    public function show(
        Request $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): ServiceInteriorDesignResource {
        $this->authorize('view', $serviceInteriorDesign);

        return new ServiceInteriorDesignResource($serviceInteriorDesign);
    }

    public function update(
        ServiceInteriorDesignUpdateRequest $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): ServiceInteriorDesignResource {
        $this->authorize('update', $serviceInteriorDesign);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceInteriorDesign->image) {
                Storage::delete($serviceInteriorDesign->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_interior_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorDesign->update($validated);

        return new ServiceInteriorDesignResource($serviceInteriorDesign);

    }

    public function destroy(
        Request $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): Response {
        $this->authorize('delete', $serviceInteriorDesign);

        if ($serviceInteriorDesign->image) {
            Storage::delete($serviceInteriorDesign->image);
        }

        $serviceInteriorDesign->delete();

        return response()->noContent();
    }
}