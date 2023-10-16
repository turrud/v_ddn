<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactInvest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContactInvestResource;
use App\Http\Resources\ContactInvestCollection;
use App\Http\Requests\ContactInvestStoreRequest;
use App\Http\Requests\ContactInvestUpdateRequest;

class ContactInvestController extends Controller
{
    public function index(Request $request): ContactInvestCollection
    {
        $this->authorize('view-any', ContactInvest::class);

        $search = $request->get('search', '');

        $contactInvests = ContactInvest::search($search)
            ->latest()
            ->paginate();

        return new ContactInvestCollection($contactInvests);
    }

    public function store(
        ContactInvestStoreRequest $request
    ): ContactInvestResource {
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

        return new ContactInvestResource($contactInvest);

    }

    public function show(
        Request $request,
        ContactInvest $contactInvest
    ): ContactInvestResource {
        $this->authorize('view', $contactInvest);

        return new ContactInvestResource($contactInvest);
    }

    public function update(
        ContactInvestUpdateRequest $request,
        ContactInvest $contactInvest
    ): ContactInvestResource {
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

        return new ContactInvestResource($contactInvest);

    }

    public function destroy(
        Request $request,
        ContactInvest $contactInvest
    ): Response {
        $this->authorize('delete', $contactInvest);

        if ($contactInvest->image) {
            Storage::delete($contactInvest->image);
        }

        if ($contactInvest->file) {
            Storage::delete($contactInvest->file);
        }

        $contactInvest->delete();

        return response()->noContent();
    }
}