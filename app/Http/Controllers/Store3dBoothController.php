<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Store3dBooth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Store3dBoothStoreRequest;
use App\Http\Requests\Store3dBoothUpdateRequest;

class Store3dBoothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Store3dBooth::class);

        $search = $request->get('search', '');

        $store3dBooths = Store3dBooth::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store3d_booths.index',
            compact('store3dBooths', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Store3dBooth::class);

        return view('app.store3d_booths.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store3dBoothStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Store3dBooth::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-booths', $imageName);
            $validated['image'] = 'store/images/3d-booths/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-booths', $fileName);
            $validated['file'] = 'store/files/3d-booths/' . $fileName;
        }

        $store3dBooth = Store3dBooth::create($validated);

        return redirect()
            ->route('store3d-booths.edit', $store3dBooth)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Store3dBooth $store3dBooth): View
    {
        $this->authorize('view', $store3dBooth);

        return view('app.store3d_booths.show', compact('store3dBooth'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Store3dBooth $store3dBooth): View
    {
        $this->authorize('update', $store3dBooth);

        return view('app.store3d_booths.edit', compact('store3dBooth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Store3dBoothUpdateRequest $request,
        Store3dBooth $store3dBooth
    ): RedirectResponse {
        $this->authorize('update', $store3dBooth);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-booths', $imageName);
            $validated['image'] = 'store/images/3d-booths/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-booths', $fileName);
            $validated['file'] = 'store/files/3d-booths/' . $fileName;
        }

        $store3dBooth->update($validated);

        return redirect()
            ->route('store3d-booths.edit', $store3dBooth)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Store3dBooth $store3dBooth
    ): RedirectResponse {
        $this->authorize('delete', $store3dBooth);

        if ($store3dBooth->image) {
            Storage::delete($store3dBooth->image);
        }

        if ($store3dBooth->file) {
            Storage::delete($store3dBooth->file);
        }

        $store3dBooth->delete();

        return redirect()
            ->route('store3d-booths.index')
            ->withSuccess(__('crud.common.removed'));
    }
}