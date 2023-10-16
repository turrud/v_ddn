<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\AboutAward;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutAwardStoreRequest;
use App\Http\Requests\AboutAwardUpdateRequest;

class AboutAwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AboutAward::class);

        $search = $request->get('search', '');

        $aboutAwards = AboutAward::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.about_awards.index', compact('aboutAwards', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AboutAward::class);

        return view('app.about_awards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutAwardStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AboutAward::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-awards', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutAward = AboutAward::create($validated);

        return redirect()
            ->route('about-awards.edit', $aboutAward)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AboutAward $aboutAward): View
    {
        $this->authorize('view', $aboutAward);

        return view('app.about_awards.show', compact('aboutAward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AboutAward $aboutAward): View
    {
        $this->authorize('update', $aboutAward);

        return view('app.about_awards.edit', compact('aboutAward'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AboutAwardUpdateRequest $request,
        AboutAward $aboutAward
    ): RedirectResponse {
        $this->authorize('update', $aboutAward);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutAward->image) {
                Storage::delete($aboutAward->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-awards', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutAward->update($validated);

        return redirect()
            ->route('about-awards.edit', $aboutAward)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AboutAward $aboutAward
    ): RedirectResponse {
        $this->authorize('delete', $aboutAward);

        if ($aboutAward->image) {
            Storage::delete($aboutAward->image);
        }

        $aboutAward->delete();

        return redirect()
            ->route('about-awards.index')
            ->withSuccess(__('crud.common.removed'));
    }
}