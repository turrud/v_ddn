<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactServiceResource;
use App\Http\Resources\ContactServiceCollection;
use App\Http\Requests\ContactServiceStoreRequest;
use App\Http\Requests\ContactServiceUpdateRequest;

class ContactServiceController extends Controller
{
    public function index(Request $request): ContactServiceCollection
    {
        $this->authorize('view-any', ContactService::class);

        $search = $request->get('search', '');

        $contactServices = ContactService::search($search)
            ->latest()
            ->paginate();

        return new ContactServiceCollection($contactServices);
    }

    public function store(
        ContactServiceStoreRequest $request
    ): ContactServiceResource {
        $this->authorize('create', ContactService::class);

        $validated = $request->validated();

        $contactService = ContactService::create($validated);

        return new ContactServiceResource($contactService);
    }

    public function show(
        Request $request,
        ContactService $contactService
    ): ContactServiceResource {
        $this->authorize('view', $contactService);

        return new ContactServiceResource($contactService);
    }

    public function update(
        ContactServiceUpdateRequest $request,
        ContactService $contactService
    ): ContactServiceResource {
        $this->authorize('update', $contactService);

        $validated = $request->validated();

        $contactService->update($validated);

        return new ContactServiceResource($contactService);
    }

    public function destroy(
        Request $request,
        ContactService $contactService
    ): Response {
        $this->authorize('delete', $contactService);

        $contactService->delete();

        return response()->noContent();
    }
}
