<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceBoothDesign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceBoothDesignStoreRequest;
use App\Http\Requests\ServiceBoothDesignUpdateRequest;

class ServiceBoothDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceBoothDesign::class);

        $search = $request->get('search', '');

        $serviceBoothDesigns = ServiceBoothDesign::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_booth_designs.index',
            compact('serviceBoothDesigns', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceBoothDesign::class);

        return view('app.service_booth_designs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceBoothDesignStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceBoothDesign::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_booth_design', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceBoothDesign = ServiceBoothDesign::create($validated);

        return redirect()
            ->route('service-booth-designs.edit', $serviceBoothDesign)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceBoothDesign $serviceBoothDesign
    ): View {
        $this->authorize('view', $serviceBoothDesign);

        return view(
            'app.service_booth_designs.show',
            compact('serviceBoothDesign')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceBoothDesign $serviceBoothDesign
    ): View {
        $this->authorize('update', $serviceBoothDesign);

        return view(
            'app.service_booth_designs.edit',
            compact('serviceBoothDesign')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceBoothDesignUpdateRequest $request,
        ServiceBoothDesign $serviceBoothDesign
    ): RedirectResponse {
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

        return redirect()
            ->route('service-booth-designs.edit', $serviceBoothDesign)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceBoothDesign $serviceBoothDesign
    ): RedirectResponse {
        $this->authorize('delete', $serviceBoothDesign);

        if ($serviceBoothDesign->image) {
            Storage::delete($serviceBoothDesign->image);
        }

        $serviceBoothDesign->delete();

        return redirect()
            ->route('service-booth-designs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
