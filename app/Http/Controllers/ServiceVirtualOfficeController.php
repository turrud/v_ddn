<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceVirtualOffice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceVirtualOfficeStoreRequest;
use App\Http\Requests\ServiceVirtualOfficeUpdateRequest;

class ServiceVirtualOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceVirtualOffice::class);

        $search = $request->get('search', '');

        $serviceVirtualOffices = ServiceVirtualOffice::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_virtual_offices.index',
            compact('serviceVirtualOffices', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceVirtualOffice::class);

        return view('app.service_virtual_offices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceVirtualOfficeStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceVirtualOffice::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-virtual-offices', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceVirtualOffice = ServiceVirtualOffice::create($validated);

        return redirect()
            ->route('service-virtual-offices.edit', $serviceVirtualOffice)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): View {
        $this->authorize('view', $serviceVirtualOffice);

        return view(
            'app.service_virtual_offices.show',
            compact('serviceVirtualOffice')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): View {
        $this->authorize('update', $serviceVirtualOffice);

        return view(
            'app.service_virtual_offices.edit',
            compact('serviceVirtualOffice')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceVirtualOfficeUpdateRequest $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): RedirectResponse {
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

        return redirect()
            ->route('service-virtual-offices.edit', $serviceVirtualOffice)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceVirtualOffice $serviceVirtualOffice
    ): RedirectResponse {
        $this->authorize('delete', $serviceVirtualOffice);

        if ($serviceVirtualOffice->image) {
            Storage::delete($serviceVirtualOffice->image);
        }

        $serviceVirtualOffice->delete();

        return redirect()
            ->route('service-virtual-offices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}