<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\AboutEvent;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AboutEventStoreRequest;
use App\Http\Requests\AboutEventUpdateRequest;

class AboutEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AboutEvent::class);

        $search = $request->get('search', '');

        $aboutEvents = AboutEvent::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.about_events.index', compact('aboutEvents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AboutEvent::class);

        return view('app.about_events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutEventStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AboutEvent::class);

        $validated = $request->validated();

        $aboutEvent = AboutEvent::create($validated);

        return redirect()
            ->route('about-events.edit', $aboutEvent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AboutEvent $aboutEvent): View
    {
        $this->authorize('view', $aboutEvent);

        return view('app.about_events.show', compact('aboutEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AboutEvent $aboutEvent): View
    {
        $this->authorize('update', $aboutEvent);

        return view('app.about_events.edit', compact('aboutEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AboutEventUpdateRequest $request,
        AboutEvent $aboutEvent
    ): RedirectResponse {
        $this->authorize('update', $aboutEvent);

        $validated = $request->validated();

        $aboutEvent->update($validated);

        return redirect()
            ->route('about-events.edit', $aboutEvent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AboutEvent $aboutEvent
    ): RedirectResponse {
        $this->authorize('delete', $aboutEvent);

        $aboutEvent->delete();

        return redirect()
            ->route('about-events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
