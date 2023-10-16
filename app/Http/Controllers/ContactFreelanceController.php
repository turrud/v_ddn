<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactFreelance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContactFreelanceStoreRequest;
use App\Http\Requests\ContactFreelanceUpdateRequest;

class ContactFreelanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactFreelance::class);

        $search = $request->get('search', '');

        $contactFreelances = ContactFreelance::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_freelances.index',
            compact('contactFreelances', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactFreelance::class);

        return view('app.contact_freelances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ContactFreelanceStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ContactFreelance::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->storeAs('public/contact-freelances', $file->getClientOriginalName());
            $validated['file'] = $filePath;
        }

        $contactFreelance = ContactFreelance::create($validated);

        return redirect()
            ->route('contact-freelances.edit', $contactFreelance)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ContactFreelance $contactFreelance
    ): View {
        $this->authorize('view', $contactFreelance);

        return view('app.contact_freelances.show', compact('contactFreelance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ContactFreelance $contactFreelance
    ): View {
        $this->authorize('update', $contactFreelance);

        return view('app.contact_freelances.edit', compact('contactFreelance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactFreelanceUpdateRequest $request,
        ContactFreelance $contactFreelance
    ): RedirectResponse {
        $this->authorize('update', $contactFreelance);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($contactFreelance->file) {
                Storage::delete($contactFreelance->file);
            }

            $file = $request->file('file');
            $filePath = $file->storeAs('public/contact-freelances', $file->getClientOriginalName());
            $validated['file'] = $filePath;
        }

        $contactFreelance->update($validated);

        return redirect()
            ->route('contact-freelances.edit', $contactFreelance)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactFreelance $contactFreelance
    ): RedirectResponse {
        $this->authorize('delete', $contactFreelance);

        if ($contactFreelance->file) {
            Storage::delete($contactFreelance->file);
        }

        $contactFreelance->delete();

        return redirect()
            ->route('contact-freelances.index')
            ->withSuccess(__('crud.common.removed'));
    }
}