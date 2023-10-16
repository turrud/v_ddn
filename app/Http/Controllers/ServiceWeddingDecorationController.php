<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceWeddingDecoration;
use App\Http\Requests\ServiceWeddingDecorationStoreRequest;
use App\Http\Requests\ServiceWeddingDecorationUpdateRequest;

class ServiceWeddingDecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceWeddingDecoration::class);

        $search = $request->get('search', '');

        $serviceWeddingDecorations = ServiceWeddingDecoration::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_wedding_decorations.index',
            compact('serviceWeddingDecorations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceWeddingDecoration::class);

        return view('app.service_wedding_decorations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceWeddingDecorationStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceWeddingDecoration::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service-wedding-decorations', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceWeddingDecoration = ServiceWeddingDecoration::create($validated);

        return redirect()
            ->route('service-wedding-decorations.edit', $serviceWeddingDecoration)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): View {
        $this->authorize('view', $serviceWeddingDecoration);

        return view(
            'app.service_wedding_decorations.show',
            compact('serviceWeddingDecoration')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): View {
        $this->authorize('update', $serviceWeddingDecoration);

        return view(
            'app.service_wedding_decorations.edit',
            compact('serviceWeddingDecoration')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceWeddingDecorationUpdateRequest $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): RedirectResponse {
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

        return redirect()
            ->route('service-wedding-decorations.edit', $serviceWeddingDecoration)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceWeddingDecoration $serviceWeddingDecoration
    ): RedirectResponse {
        $this->authorize('delete', $serviceWeddingDecoration);

        if ($serviceWeddingDecoration->image) {
            Storage::delete($serviceWeddingDecoration->image);
        }

        $serviceWeddingDecoration->delete();

        return redirect()
            ->route('service-wedding-decorations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}