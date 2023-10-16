<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\AboutPeople;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutPeopleStoreRequest;
use App\Http\Requests\AboutPeopleUpdateRequest;

class AboutPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AboutPeople::class);

        $search = $request->get('search', '');

        $allAboutPeople = AboutPeople::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_about_people.index',
            compact('allAboutPeople', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AboutPeople::class);

        return view('app.all_about_people.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutPeopleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AboutPeople::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-people', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutPeople = AboutPeople::create($validated);

        return redirect()
            ->route('all-about-people.edit', $aboutPeople)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AboutPeople $aboutPeople): View
    {
        $this->authorize('view', $aboutPeople);

        return view('app.all_about_people.show', compact('aboutPeople'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AboutPeople $aboutPeople): View
    {
        $this->authorize('update', $aboutPeople);

        return view('app.all_about_people.edit', compact('aboutPeople'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AboutPeopleUpdateRequest $request,
        AboutPeople $aboutPeople
    ): RedirectResponse {
        $this->authorize('update', $aboutPeople);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($aboutPeople->image) {
                Storage::delete($aboutPeople->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-people', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutPeople->update($validated);

        return redirect()
            ->route('all-about-people.edit', $aboutPeople)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AboutPeople $aboutPeople
    ): RedirectResponse {
        $this->authorize('delete', $aboutPeople);

        if ($aboutPeople->image) {
            Storage::delete($aboutPeople->image);
        }

        $aboutPeople->delete();

        return redirect()
            ->route('all-about-people.index')
            ->withSuccess(__('crud.common.removed'));
    }
}