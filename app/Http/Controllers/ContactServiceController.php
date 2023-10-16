<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactServiceStoreRequest;
use App\Http\Requests\ContactServiceUpdateRequest;

class ContactServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactService::class);

        $search = $request->get('search', '');

        $contactServices = ContactService::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_services.index',
            compact('contactServices', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactService::class);

        return view('app.contact_services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactServiceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContactService::class);

        $validated = $request->validated();

        $contactService = ContactService::create($validated);

        return redirect()
            ->route('contact-services.edit', $contactService)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContactService $contactService): View
    {
        $this->authorize('view', $contactService);

        return view('app.contact_services.show', compact('contactService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContactService $contactService): View
    {
        $this->authorize('update', $contactService);

        return view('app.contact_services.edit', compact('contactService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactServiceUpdateRequest $request,
        ContactService $contactService
    ): RedirectResponse {
        $this->authorize('update', $contactService);

        $validated = $request->validated();

        $contactService->update($validated);

        return redirect()
            ->route('contact-services.edit', $contactService)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactService $contactService
    ): RedirectResponse {
        $this->authorize('delete', $contactService);

        $contactService->delete();

        return redirect()
            ->route('contact-services.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
