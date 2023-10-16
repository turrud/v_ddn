<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceInteriorPublic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceInteriorPublicStoreRequest;
use App\Http\Requests\ServiceInteriorPublicUpdateRequest;

class ServiceInteriorPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceInteriorPublic::class);

        $search = $request->get('search', '');

        $serviceInteriorPublics = ServiceInteriorPublic::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_interior_publics.index',
            compact('serviceInteriorPublics', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceInteriorPublic::class);

        return view('app.service_interior_publics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceInteriorPublicStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceInteriorPublic::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-interior-publics', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceInteriorPublic = ServiceInteriorPublic::create($validated);

        return redirect()
            ->route('service-interior-publics.edit', $serviceInteriorPublic)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): View {
        $this->authorize('view', $serviceInteriorPublic);

        return view(
            'app.service_interior_publics.show',
            compact('serviceInteriorPublic')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): View {
        $this->authorize('update', $serviceInteriorPublic);

        return view(
            'app.service_interior_publics.edit',
            compact('serviceInteriorPublic')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceInteriorPublicUpdateRequest $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): RedirectResponse {
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

        return redirect()
            ->route('service-interior-publics.edit', $serviceInteriorPublic)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceInteriorPublic $serviceInteriorPublic
    ): RedirectResponse {
        $this->authorize('delete', $serviceInteriorPublic);

        if ($serviceInteriorPublic->image) {
            Storage::delete($serviceInteriorPublic->image);
        }

        $serviceInteriorPublic->delete();

        return redirect()
            ->route('service-interior-publics.index')
            ->withSuccess(__('crud.common.removed'));
    }
}