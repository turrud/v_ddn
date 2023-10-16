<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactInvest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContactInvestStoreRequest;
use App\Http\Requests\ContactInvestUpdateRequest;

class ContactInvestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactInvest::class);

        $search = $request->get('search', '');

        $contactInvests = ContactInvest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_invests.index',
            compact('contactInvests', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactInvest::class);

        return view('app.contact_invests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactInvestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContactInvest::class);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-invests/images', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->storeAs('public/contact-invests/files', $file->getClientOriginalName());
            $validated['file'] = $filePath;
        }

        $contactInvest = ContactInvest::create($validated);

        return redirect()
            ->route('contact-invests.edit', $contactInvest)
            ->withSuccess(__('crud.common.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContactInvest $contactInvest): View
    {
        $this->authorize('view', $contactInvest);

        return view('app.contact_invests.show', compact('contactInvest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContactInvest $contactInvest): View
    {
        $this->authorize('update', $contactInvest);

        return view('app.contact_invests.edit', compact('contactInvest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactInvestUpdateRequest $request,
        ContactInvest $contactInvest
    ): RedirectResponse {
        $this->authorize('update', $contactInvest);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($contactInvest->image) {
                Storage::delete($contactInvest->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-invests/images', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('file')) {
            if ($contactInvest->file) {
                Storage::delete($contactInvest->file);
            }

            $file = $request->file('file');
            $filePath = $file->storeAs('public/contact-invests/files', $file->getClientOriginalName());
            $validated['file'] = $filePath;
        }

        $contactInvest->update($validated);

        return redirect()
            ->route('contact-invests.edit', $contactInvest)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactInvest $contactInvest
    ): RedirectResponse {
        $this->authorize('delete', $contactInvest);

        if ($contactInvest->image) {
            Storage::delete($contactInvest->image);
        }

        if ($contactInvest->file) {
            Storage::delete($contactInvest->file);
        }

        $contactInvest->delete();

        return redirect()
            ->route('contact-invests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}