<?php

namespace App\Http\Controllers\Api;

use App\Models\AboutPeople;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AboutPeopleResource;
use App\Http\Resources\AboutPeopleCollection;
use App\Http\Requests\AboutPeopleStoreRequest;
use App\Http\Requests\AboutPeopleUpdateRequest;

class AboutPeopleController extends Controller
{
    public function index(Request $request): AboutPeopleCollection
    {
        $this->authorize('view-any', AboutPeople::class);

        $search = $request->get('search', '');

        $allAboutPeople = AboutPeople::search($search)
            ->latest()
            ->paginate();

        return new AboutPeopleCollection($allAboutPeople);
    }

    public function store(AboutPeopleStoreRequest $request): AboutPeopleResource
    {
        $this->authorize('create', AboutPeople::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-people', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutPeople = AboutPeople::create($validated);

        return new AboutPeopleResource($aboutPeople);

    }

    public function show(
        Request $request,
        AboutPeople $aboutPeople
    ): AboutPeopleResource {
        $this->authorize('view', $aboutPeople);

        return new AboutPeopleResource($aboutPeople);
    }

    public function update(
        AboutPeopleUpdateRequest $request,
        AboutPeople $aboutPeople
    ): AboutPeopleResource {
        $this->authorize('update', $aboutPeople);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutPeople->image) {
                Storage::delete($aboutPeople->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-people', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutPeople->update($validated);

        return new AboutPeopleResource($aboutPeople);

    }

    public function destroy(
        Request $request,
        AboutPeople $aboutPeople
    ): Response {
        $this->authorize('delete', $aboutPeople);

        if ($aboutPeople->image) {
            Storage::delete($aboutPeople->image);
        }

        $aboutPeople->delete();

        return response()->noContent();
    }
}