<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactFreelance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContactFreelanceResource;
use App\Http\Resources\ContactFreelanceCollection;
use App\Http\Requests\ContactFreelanceStoreRequest;
use App\Http\Requests\ContactFreelanceUpdateRequest;

class ContactFreelanceController extends Controller
{
    public function index(Request $request): ContactFreelanceCollection
    {
        $this->authorize('view-any', ContactFreelance::class);

        $search = $request->get('search', '');

        $contactFreelances = ContactFreelance::search($search)
            ->latest()
            ->paginate();

        return new ContactFreelanceCollection($contactFreelances);
    }

    public function store(
        ContactFreelanceStoreRequest $request
    ): ContactFreelanceResource {
        $this->authorize('create', ContactFreelance::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->storeAs('public/contact-freelances', $file->getClientOriginalName());
            $validated['file'] = $filePath;
        }

        $contactFreelance = ContactFreelance::create($validated);

        return new ContactFreelanceResource($contactFreelance);

    }

    public function show(
        Request $request,
        ContactFreelance $contactFreelance
    ): ContactFreelanceResource {
        $this->authorize('view', $contactFreelance);

        return new ContactFreelanceResource($contactFreelance);
    }

    public function update(
        ContactFreelanceUpdateRequest $request,
        ContactFreelance $contactFreelance
    ): ContactFreelanceResource {
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

        return new ContactFreelanceResource($contactFreelance);

    }

    public function destroy(
        Request $request,
        ContactFreelance $contactFreelance
    ): Response {
        $this->authorize('delete', $contactFreelance);

        if ($contactFreelance->file) {
            Storage::delete($contactFreelance->file);
        }

        $contactFreelance->delete();

        return response()->noContent();
    }
}
