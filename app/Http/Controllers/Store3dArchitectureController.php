<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Store3dArchitecture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Store3dArchitectureStoreRequest;
use App\Http\Requests\Store3dArchitectureUpdateRequest;

class Store3dArchitectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Store3dArchitecture::class);

        $search = $request->get('search', '');

        $store3dArchitectures = Store3dArchitecture::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store3d_architectures.index',
            compact('store3dArchitectures', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Store3dArchitecture::class);

        return view('app.store3d_architectures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        Store3dArchitectureStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', Store3dArchitecture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-architectures', $imageName);
            $validated['image'] = 'store/images/3d-architectures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-architectures', $fileName);
            $validated['file'] = 'store/files/3d-architectures/' . $fileName;
        }

        $store3dArchitecture = Store3dArchitecture::create($validated);

        return redirect()
            ->route('store3d-architectures.edit', $store3dArchitecture)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        Store3dArchitecture $store3dArchitecture
    ): View {
        $this->authorize('view', $store3dArchitecture);

        return view(
            'app.store3d_architectures.show',
            compact('store3dArchitecture')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        Store3dArchitecture $store3dArchitecture
    ): View {
        $this->authorize('update', $store3dArchitecture);

        return view(
            'app.store3d_architectures.edit',
            compact('store3dArchitecture')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Store3dArchitectureUpdateRequest $request,
        Store3dArchitecture $store3dArchitecture
    ): RedirectResponse {
        $this->authorize('update', $store3dArchitecture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-architectures', $imageName);
            $validated['image'] = 'store/images/3d-architectures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-architectures', $fileName);
            $validated['file'] = 'store/files/3d-architectures/' . $fileName;
        }

        $store3dArchitecture->update($validated);

        return redirect()
            ->route('store3d-architectures.edit', $store3dArchitecture)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Store3dArchitecture $store3dArchitecture
    ): RedirectResponse {
        $this->authorize('delete', $store3dArchitecture);

        if ($store3dArchitecture->image) {
            Storage::delete($store3dArchitecture->image);
        }

        if ($store3dArchitecture->file) {
            Storage::delete($store3dArchitecture->file);
        }

        $store3dArchitecture->delete();

        return redirect()
            ->route('store3d-architectures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}