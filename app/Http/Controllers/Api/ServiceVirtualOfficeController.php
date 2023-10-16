<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ServiceVirtualOffice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceVirtualOfficeResource;
use App\Http\Resources\ServiceVirtualOfficeCollection;
use App\Http\Requests\ServiceVirtualOfficeStoreRequest;
use App\Http\Requests\ServiceVirtualOfficeUpdateRequest;

class ServiceVirtualOfficeController extends Controller
{
    public function index(Request $request): ServiceVirtualOfficeCollection
    {
        $this->authorize('view-any', ServiceVirtualOffice::class);

        $search = $request->get('search', '');

        $serviceVirtualOffices = ServiceVirtualOffice::search($search)
            ->latest()
            ->paginate();

        return new ServiceVirtualOfficeCollection($serviceVirtualOffices);
    }

    public function store(
        ServiceVirtualOfficeStoreRequest $request
    ): ServiceVirtualOfficeResource {
        $this->authorize('create', ServiceVirtualOffice::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-virtual-offices', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceVirtualOffice = ServiceVirtualOffice::create($validated);

        return new ServiceVirtualOfficeResource($serviceVirtualOffice);

    }

    public function show(
        Request $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): ServiceVirtualOfficeResource {
        $this->authorize('view', $serviceVirtualOffice);

        return new ServiceVirtualOfficeResource($serviceVirtualOffice);
    }

    public function update(
        ServiceVirtualOfficeUpdateRequest $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): ServiceVirtualOfficeResource {
        $this->authorize('update', $serviceVirtualOffice);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($serviceVirtualOffice->image) {
                Storage::delete($serviceVirtualOffice->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-virtual-offices', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceVirtualOffice->update($validated);

        return new ServiceVirtualOfficeResource($serviceVirtualOffice);

    }

    public function destroy(
        Request $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): Response {
        $this->authorize('delete', $serviceVirtualOffice);

        if ($serviceVirtualOffice->image) {
            Storage::delete($serviceVirtualOffice->image);
        }

        $serviceVirtualOffice->delete();

        return response()->noContent();
    }
}
