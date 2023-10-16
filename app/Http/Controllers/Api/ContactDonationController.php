<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactDonation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContactDonationResource;
use App\Http\Resources\ContactDonationCollection;
use App\Http\Requests\ContactDonationStoreRequest;
use App\Http\Requests\ContactDonationUpdateRequest;

class ContactDonationController extends Controller
{
    public function index(Request $request): ContactDonationCollection
    {
        $this->authorize('view-any', ContactDonation::class);

        $search = $request->get('search', '');

        $contactDonations = ContactDonation::search($search)
            ->latest()
            ->paginate();

        return new ContactDonationCollection($contactDonations);
    }

    public function store(
        ContactDonationStoreRequest $request
    ): ContactDonationResource {
        $this->authorize('create', ContactDonation::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-donations', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $contactDonation = ContactDonation::create($validated);

        return new ContactDonationResource($contactDonation);

    }

    public function show(
        Request $request,
        ContactDonation $contactDonation
    ): ContactDonationResource {
        $this->authorize('view', $contactDonation);

        return new ContactDonationResource($contactDonation);
    }

    public function update(
        ContactDonationUpdateRequest $request,
        ContactDonation $contactDonation
    ): ContactDonationResource {
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

        return new ContactDonationResource($contactDonation);

    }

    public function destroy(
        Request $request,
        ContactDonation $contactDonation
    ): Response {
        $this->authorize('delete', $contactDonation);

        if ($contactDonation->image) {
            Storage::delete($contactDonation->image);
        }

        $contactDonation->delete();

        return response()->noContent();
    }
}