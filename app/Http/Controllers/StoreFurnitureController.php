<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StoreFurniture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFurnitureStoreRequest;
use App\Http\Requests\StoreFurnitureUpdateRequest;

class StoreFurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StoreFurniture::class);

        $search = $request->get('search', '');

        $storeFurnitures = StoreFurniture::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store_furnitures.index',
            compact('storeFurnitures', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StoreFurniture::class);

        return view('app.store_furnitures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFurnitureStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StoreFurniture::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/furnitures', $imageName);
            $validated['image'] = 'store/images/furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/furnitures', $fileName);
            $validated['file'] = 'store/files/furnitures/' . $fileName;
        }

        $storeFurniture = StoreFurniture::create($validated);

        return redirect()
            ->route('store-furnitures.edit', $storeFurniture)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StoreFurniture $storeFurniture): View
    {
        $this->authorize('view', $storeFurniture);

        return view('app.store_furnitures.show', compact('storeFurniture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StoreFurniture $storeFurniture): View
    {
        $this->authorize('update', $storeFurniture);

        return view('app.store_furnitures.edit', compact('storeFurniture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StoreFurnitureUpdateRequest $request,
        StoreFurniture $storeFurniture
    ): RedirectResponse {
        $this->authorize('update', $storeFurniture);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
            $image->storeAs('public/store/images/furnitures', $imageName);
            $validated['image'] = 'store/images/furnitures/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName(); 
            $file->storeAs('public/store/files/furnitures', $fileName);
            $validated['file'] = 'store/files/furnitures/' . $fileName;
        }

        $storeFurniture->update($validated);

        return redirect()
            ->route('store-furnitures.edit', $storeFurniture)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StoreFurniture $storeFurniture
    ): RedirectResponse {
        $this->authorize('delete', $storeFurniture);

        if ($storeFurniture->image) {
            Storage::delete($storeFurniture->image);
        }

        if ($storeFurniture->file) {
            Storage::delete($storeFurniture->file);
        }

        $storeFurniture->delete();

        return redirect()
            ->route('store-furnitures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}