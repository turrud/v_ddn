<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactPartner;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactPartnerResource;
use App\Http\Resources\ContactPartnerCollection;
use App\Http\Requests\ContactPartnerStoreRequest;
use App\Http\Requests\ContactPartnerUpdateRequest;

class ContactPartnerController extends Controller
{
    public function index(Request $request): ContactPartnerCollection
    {
        $this->authorize('view-any', ContactPartner::class);

        $search = $request->get('search', '');

        $contactPartners = ContactPartner::search($search)
            ->latest()
            ->paginate();

        return new ContactPartnerCollection($contactPartners);
    }

    public function store(
        ContactPartnerStoreRequest $request
    ): ContactPartnerResource {
        $this->authorize('create', ContactPartner::class);

        $validated = $request->validated();

        $contactPartner = ContactPartner::create($validated);

        return new ContactPartnerResource($contactPartner);
    }

    public function show(
        Request $request,
        ContactPartner $contactPartner
    ): ContactPartnerResource {
        $this->authorize('view', $contactPartner);

        return new ContactPartnerResource($contactPartner);
    }

    public function update(
        ContactPartnerUpdateRequest $request,
        ContactPartner $contactPartner
    ): ContactPartnerResource {
        $this->authorize('update', $contactPartner);

        $validated = $request->validated();

        $contactPartner->update($validated);

        return new ContactPartnerResource($contactPartner);
    }

    public function destroy(
        Request $request,
        ContactPartner $contactPartner
    ): Response {
        $this->authorize('delete', $contactPartner);

        $contactPartner->delete();

        return response()->noContent();
    }
}
