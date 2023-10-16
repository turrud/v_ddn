<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceArchitecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ServiceArchitectureStoreRequest;
use App\Http\Requests\ServiceArchitectureUpdateRequest;

class ServiceArchitectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ServiceArchitecture::class);

        $search = $request->get('search', '');

        $serviceArchitectures = ServiceArchitecture::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.service_architectures.index',
            compact('serviceArchitectures', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ServiceArchitecture::class);

        return view('app.service_architectures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ServiceArchitectureStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ServiceArchitecture::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/service_architecture', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $serviceArchitecture = ServiceArchitecture::create($validated);

        return redirect()
            ->route('service-architectures.edit', $serviceArchitecture)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ServiceArchitecture $serviceArchitecture
    ): View {
        $this->authorize('view', $serviceArchitecture);

        return view(
            'app.service_architectures.show',
            compact('serviceArchitecture')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ServiceArchitecture $serviceArchitecture
    ): View {
        $this->authorize('update', $serviceArchitecture);

        return view(
            'app.service_architectures.edit',
            compact('serviceArchitecture')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ServiceArchitectureUpdateRequest $request,
        ServiceArchitecture $serviceArchitecture
    ): RedirectResponse {
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

        return redirect()
            ->route('service-architectures.edit', $serviceArchitecture)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ServiceArchitecture $serviceArchitecture
    ): RedirectResponse {
        $this->authorize('delete', $serviceArchitecture);

        if ($serviceArchitecture->image) {
            Storage::delete($serviceArchitecture->image);
        }

        $serviceArchitecture->delete();

        return redirect()
            ->route('service-architectures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
