<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Store3dFurniture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Store3dFurnitureStoreRequest;
use App\Http\Requests\Store3dFurnitureUpdateRequest;

class Store3dFurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Store3dFurniture::class);

        $search = $request->get('search', '');

        $store3dFurnitures = Store3dFurniture::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store3d_furnitures.index',
            compact('store3dFurnitures', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Store3dFurniture::class);

        return view('app.store3d_furnitures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        Store3dFurnitureStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', Store3dFurniture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-furnitures', $imageName);
            $validated['image'] = 'store/images/3d-furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-furnitures', $fileName);
            $validated['file'] = 'store/files/3d-furnitures/' . $fileName;
        }

        $store3dFurniture = Store3dFurniture::create($validated);

        return redirect()
            ->route('store3d-furnitures.edit', $store3dFurniture)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        Store3dFurniture $store3dFurniture
    ): View {
        $this->authorize('view', $store3dFurniture);

        return view('app.store3d_furnitures.show', compact('store3dFurniture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        Store3dFurniture $store3dFurniture
    ): View {
        $this->authorize('update', $store3dFurniture);

        return view('app.store3d_furnitures.edit', compact('store3dFurniture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Store3dFurnitureUpdateRequest $request,
        Store3dFurniture $store3dFurniture
    ): RedirectResponse {
        $this->authorize('update', $store3dFurniture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/3d-furnitures', $imageName);
            $validated['image'] = 'store/images/3d-furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/3d-furnitures', $fileName);
            $validated['file'] = 'store/files/3d-furnitures/' . $fileName;
        }

        $store3dFurniture->update($validated);

        return redirect()
            ->route('store3d-furnitures.edit', $store3dFurniture)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Store3dFurniture $store3dFurniture
    ): RedirectResponse {
        $this->authorize('delete', $store3dFurniture);

        if ($store3dFurniture->image) {
            Storage::delete($store3dFurniture->image);
        }

        if ($store3dFurniture->file) {
            Storage::delete($store3dFurniture->file);
        }

        $store3dFurniture->delete();

        return redirect()
            ->route('store3d-furnitures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}