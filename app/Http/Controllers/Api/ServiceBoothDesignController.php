<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ServiceBoothDesign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceBoothDesignResource;
use App\Http\Resources\ServiceBoothDesignCollection;
use App\Http\Requests\ServiceBoothDesignStoreRequest;
use App\Http\Requests\ServiceBoothDesignUpdateRequest;

class ServiceBoothDesignController extends Controller
{
    public function index(Request $request): ServiceBoothDesignCollection
    {
        $this->authorize('view-any', ServiceBoothDesign::class);

        $search = $request->get('search', '');

        $serviceBoothDesigns = ServiceBoothDesign::search($search)
            ->latest()
            ->paginate();

        return new ServiceBoothDesignCollection($serviceBoothDesigns);
    }

    public function store(
        ServiceBoothDesignStoreRequest $request
    ): ServiceBoothDesignResource {
        $this->authorize('create', ServiceBoothDesign::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_booth_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceBoothDesign = ServiceBoothDesign::create($validated);

        return new ServiceBoothDesignResource($serviceBoothDesign);

    }

    public function show(
        Request $request,
        ServiceBoothDesign $serviceBoothDesign
    ): ServiceBoothDesignResource {
        $this->authorize('view', $serviceBoothDesign);

        return new ServiceBoothDesignResource($serviceBoothDesign);
    }

    public function update(
        ServiceBoothDesignUpdateRequest $request,
        ServiceBoothDesign $serviceBoothDesign
    ): ServiceBoothDesignResource {
        $this->authorize('update', $serviceBoothDesign);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceBoothDesign->image) {
                Storage::delete($serviceBoothDesign->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_booth_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceBoothDesign->update($validated);

        return new ServiceBoothDesignResource($serviceBoothDesign);

    }

    public function destroy(
        Request $request,
        ServiceBoothDesign $serviceBoothDesign
    ): Response {
        $this->authorize('delete', $serviceBoothDesign);

        if ($serviceBoothDesign->image) {
            Storage::delete($serviceBoothDesign->image);
        }

        $serviceBoothDesign->delete();

        return response()->noContent();
    }
}