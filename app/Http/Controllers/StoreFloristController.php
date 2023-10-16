<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\StoreFlorist;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFloristStoreRequest;
use App\Http\Requests\StoreFloristUpdateRequest;

class StoreFloristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StoreFlorist::class);

        $search = $request->get('search', '');

        $storeFlorists = StoreFlorist::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.store_florists.index',
            compact('storeFlorists', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StoreFlorist::class);

        return view('app.store_florists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFloristStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StoreFlorist::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/florists', $imageName);
            $validated['image'] = 'store/images/florists/' . $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/florists', $fileName);
            $validated['file'] = 'store/files/florists/' . $fileName;
        }

        $storeFlorist = StoreFlorist::create($validated);

        return redirect()
            ->route('store-florists.edit', $storeFlorist)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StoreFlorist $storeFlorist): View
    {
        $this->authorize('view', $storeFlorist);

        return view('app.store_florists.show', compact('storeFlorist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StoreFlorist $storeFlorist): View
    {
        $this->authorize('update', $storeFlorist);

        return view('app.store_florists.edit', compact('storeFlorist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StoreFloristUpdateRequest $request,
        StoreFlorist $storeFlorist
    ): RedirectResponse {
        $this->authorize('update', $storeFlorist);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/store/images/florists', $imageName);
            $validated['image'] = 'store/images/florists/' . $imageName;
            if ($storeFlorist->image) {
                Storage::delete('public/' . $storeFlorist->image);
            }
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/store/files/florists', $fileName);
            $validated['file'] = 'store/files/florists/' . $fileName;
            if ($storeFlorist->file) {
                Storage::delete('public/' . $storeFlorist->file);
            }
        }

        $storeFlorist->update($validated);

        return redirect()
            ->route('store-florists.edit', $storeFlorist)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StoreFlorist $storeFlorist
    ): RedirectResponse {
        $this->authorize('delete', $storeFlorist);

        if ($storeFlorist->image) {
            Storage::delete($storeFlorist->image);
        }

        if ($storeFlorist->file) {
            Storage::delete($storeFlorist->file);
        }

        $storeFlorist->delete();

        return redirect()
            ->route('store-florists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}