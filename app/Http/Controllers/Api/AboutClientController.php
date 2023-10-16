<?php

namespace App\Http\Controllers\Api;

use App\Models\AboutClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AboutClientResource;
use App\Http\Resources\AboutClientCollection;
use App\Http\Requests\AboutClientStoreRequest;
use App\Http\Requests\AboutClientUpdateRequest;

class AboutClientController extends Controller
{
    public function index(Request $request): AboutClientCollection
    {
        $this->authorize('view-any', AboutClient::class);

        $search = $request->get('search', '');

        $aboutClients = AboutClient::search($search)
            ->latest()
            ->paginate();

        return new AboutClientCollection($aboutClients);
    }

    public function store(AboutClientStoreRequest $request): AboutClientResource
    {
        $this->authorize('create', AboutClient::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-clients', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutClient = AboutClient::create($validated);

        return new AboutClientResource($aboutClient);

    }

    public function show(
        Request $request,
        AboutClient $aboutClient
    ): AboutClientResource {
        $this->authorize('view', $aboutClient);

        return new AboutClientResource($aboutClient);
    }

    public function update(
        AboutClientUpdateRequest $request,
        AboutClient $aboutClient
    ): AboutClientResource {
        $this->authorize('update', $aboutClient);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutClient->image) {
                Storage::delete($aboutClient->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-clients', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutClient->update($validated);

        return new AboutClientResource($aboutClient);

    }

    public function destroy(
        Request $request,
        AboutClient $aboutClient
    ): Response {
        $this->authorize('delete', $aboutClient);

        if ($aboutClient->image) {
            Storage::delete($aboutClient->image);
        }

        $aboutClient->delete();

        return response()->noContent();
    }
}