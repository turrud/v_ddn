<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactPartner;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactPartnerStoreRequest;
use App\Http\Requests\ContactPartnerUpdateRequest;

class ContactPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactPartner::class);

        $search = $request->get('search', '');

        $contactPartners = ContactPartner::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_partners.index',
            compact('contactPartners', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactPartner::class);

        return view('app.contact_partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactPartnerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContactPartner::class);

        $validated = $request->validated();

        $contactPartner = ContactPartner::create($validated);

        return redirect()
            ->route('contact-partners.edit', $contactPartner)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContactPartner $contactPartner): View
    {
        $this->authorize('view', $contactPartner);

        return view('app.contact_partners.show', compact('contactPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContactPartner $contactPartner): View
    {
        $this->authorize('update', $contactPartner);

        return view('app.contact_partners.edit', compact('contactPartner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactPartnerUpdateRequest $request,
        ContactPartner $contactPartner
    ): RedirectResponse {
        $this->authorize('update', $contactPartner);

        $validated = $request->validated();

        $contactPartner->update($validated);

        return redirect()
            ->route('contact-partners.edit', $contactPartner)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactPartner $contactPartner
    ): RedirectResponse {
        $this->authorize('delete', $contactPartner);

        $contactPartner->delete();

        return redirect()
            ->route('contact-partners.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
