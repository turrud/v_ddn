<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceInteriorDesign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceInteriorDesignStoreRequest;
use App\Http\Requests\ServiceInteriorDesignUpdateRequest;

class ServiceInteriorDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceInteriorDesign::class);

        $search = $request->get('search', '');

        $serviceInteriorDesigns = ServiceInteriorDesign::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_interior_designs.index',
            compact('serviceInteriorDesigns', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceInteriorDesign::class);

        return view('app.service_interior_designs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceInteriorDesignStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceInteriorDesign::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_interior_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorDesign = ServiceInteriorDesign::create($validated);

        return redirect()
            ->route('service-interior-designs.edit', $serviceInteriorDesign)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): View {
        $this->authorize('view', $serviceInteriorDesign);

        return view(
            'app.service_interior_designs.show',
            compact('serviceInteriorDesign')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): View {
        $this->authorize('update', $serviceInteriorDesign);

        return view(
            'app.service_interior_designs.edit',
            compact('serviceInteriorDesign')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceInteriorDesignUpdateRequest $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): RedirectResponse {
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

        return redirect()
            ->route('service-interior-designs.edit', $serviceInteriorDesign)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceInteriorDesign $serviceInteriorDesign
    ): RedirectResponse {
        $this->authorize('delete', $serviceInteriorDesign);

        if ($serviceInteriorDesign->image) {
            Storage::delete($serviceInteriorDesign->image);
        }

        $serviceInteriorDesign->delete();

        return redirect()
            ->route('service-interior-designs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
