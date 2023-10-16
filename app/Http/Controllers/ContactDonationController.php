<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactDonation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContactDonationStoreRequest;
use App\Http\Requests\ContactDonationUpdateRequest;

class ContactDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactDonation::class);

        $search = $request->get('search', '');

        $contactDonations = ContactDonation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_donations.index',
            compact('contactDonations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactDonation::class);

        return view('app.contact_donations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ContactDonationStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ContactDonation::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-donations', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $contactDonation = ContactDonation::create($validated);

        return redirect()
            ->route('contact-donations.edit', $contactDonation)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ContactDonation $contactDonation
    ): View {
        $this->authorize('view', $contactDonation);

        return view('app.contact_donations.show', compact('contactDonation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ContactDonation $contactDonation
    ): View {
        $this->authorize('update', $contactDonation);

        return view('app.contact_donations.edit', compact('contactDonation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactDonationUpdateRequest $request,
        ContactDonation $contactDonation
    ): RedirectResponse {
        $this->authorize('update', $contactDonation);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($contactDonation->image) {
                Storage::delete($contactDonation->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-donations', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $contactDonation->update($validated);

        return redirect()
            ->route('contact-donations.edit', $contactDonation)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactDonation $contactDonation
    ): RedirectResponse {
        $this->authorize('delete', $contactDonation);

        if ($contactDonation->image) {
            Storage::delete($contactDonation->image);
        }

        $contactDonation->delete();

        return redirect()
            ->route('contact-donations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
