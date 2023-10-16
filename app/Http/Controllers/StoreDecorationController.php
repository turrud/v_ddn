<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StoreDecoration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDecorationStoreRequest;
use App\Http\Requests\StoreDecorationUpdateRequest;

class StoreDecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StoreDecoration::class);

        $search = $request->get('search', '');

        $storeDecorations = StoreDecoration::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store_decorations.index',
            compact('storeDecorations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StoreDecoration::class);

        return view('app.store_decorations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreDecorationStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', StoreDecoration::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/decorations', $imageName);
            $validated['image'] = 'store/images/decorations/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/decorations', $fileName);
            $validated['file'] = 'store/files/decorations/' . $fileName;
        }

        $storeDecoration = StoreDecoration::create($validated);

        return redirect()
            ->route('store-decorations.edit', $storeDecoration)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        StoreDecoration $storeDecoration
    ): View {
        $this->authorize('view', $storeDecoration);

        return view('app.store_decorations.show', compact('storeDecoration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        StoreDecoration $storeDecoration
    ): View {
        $this->authorize('update', $storeDecoration);

        return view('app.store_decorations.edit', compact('storeDecoration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StoreDecorationUpdateRequest $request,
        StoreDecoration $storeDecoration
    ): RedirectResponse {
        $this->authorize('update', $storeDecoration);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/decorations', $imageName);
            $validated['image'] = 'store/images/decorations/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/decorations', $fileName);
            $validated['file'] = 'store/files/decorations/' . $fileName;
        }

        $storeDecoration->update($validated);

        return redirect()
            ->route('store-decorations.edit', $storeDecoration)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StoreDecoration $storeDecoration
    ): RedirectResponse {
        $this->authorize('delete', $storeDecoration);

        if ($storeDecoration->image) {
            Storage::delete($storeDecoration->image);
        }

        if ($storeDecoration->file) {
            Storage::delete($storeDecoration->file);
        }

        $storeDecoration->delete();

        return redirect()
            ->route('store-decorations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}