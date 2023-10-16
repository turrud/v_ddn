<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ServiceArchitecture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceArchitectureResource;
use App\Http\Resources\ServiceArchitectureCollection;
use App\Http\Requests\ServiceArchitectureStoreRequest;
use App\Http\Requests\ServiceArchitectureUpdateRequest;

class ServiceArchitectureController extends Controller
{
    public function index(Request $request): ServiceArchitectureCollection
    {
        $this->authorize('view-any', ServiceArchitecture::class);

        $search = $request->get('search', '');

        $serviceArchitectures = ServiceArchitecture::search($search)
            ->latest()
            ->paginate();

        return new ServiceArchitectureCollection($serviceArchitectures);
    }

    public function store(
        ServiceArchitectureStoreRequest $request
    ): ServiceArchitectureResource {
        $this->authorize('create', ServiceArchitecture::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_architecture', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceArchitecture = ServiceArchitecture::create($validated);

        return new ServiceArchitectureResource($serviceArchitecture);

    }

    public function show(
        Request $request,
        ServiceArchitecture $serviceArchitecture
    ): ServiceArchitectureResource {
        $this->authorize('view', $serviceArchitecture);

        return new ServiceArchitectureResource($serviceArchitecture);
    }

    public function update(
        ServiceArchitectureUpdateRequest $request,
        ServiceArchitecture $serviceArchitecture
    ): ServiceArchitectureResource {
        $this->authorize('update', $serviceArchitecture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceArchitecture->image) {
                Storage::delete($serviceArchitecture->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_architecture', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceArchitecture->update($validated);

        return new ServiceArchitectureResource($serviceArchitecture);

    }

    public function destroy(
        Request $request,
        ServiceArchitecture $serviceArchitecture
    ): Response {
        $this->authorize('delete', $serviceArchitecture);

        if ($serviceArchitecture->image) {
            Storage::delete($serviceArchitecture->image);
        }

        $serviceArchitecture->delete();

        return response()->noContent();
    }
}