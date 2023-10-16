<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\AboutClient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutClientStoreRequest;
use App\Http\Requests\AboutClientUpdateRequest;

class AboutClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AboutClient::class);

        $search = $request->get('search', '');

        $aboutClients = AboutClient::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.about_clients.index',
            compact('aboutClients', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AboutClient::class);

        return view('app.about_clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutClientStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AboutClient::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-clients', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutClient = AboutClient::create($validated);

        return redirect()
            ->route('about-clients.edit', $aboutClient)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AboutClient $aboutClient): View
    {
        $this->authorize('view', $aboutClient);

        return view('app.about_clients.show', compact('aboutClient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AboutClient $aboutClient): View
    {
        $this->authorize('update', $aboutClient);

        return view('app.about_clients.edit', compact('aboutClient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AboutClientUpdateRequest $request,
        AboutClient $aboutClient
    ): RedirectResponse {
        $this->authorize('update', $aboutClient);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutClient->image) {
                Storage::delete($aboutClient->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-clients', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutClient->update($validated);

        return redirect()
            ->route('about-clients.edit', $aboutClient)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AboutClient $aboutClient
    ): RedirectResponse {
        $this->authorize('delete', $aboutClient);

        if ($aboutClient->image) {
            Storage::delete($aboutClient->image);
        }

        $aboutClient->delete();

        return redirect()
            ->route('about-clients.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
