<?php

namespace App\Http\Controllers\Api;

use App\Models\AboutAward;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AboutAwardResource;
use App\Http\Resources\AboutAwardCollection;
use App\Http\Requests\AboutAwardStoreRequest;
use App\Http\Requests\AboutAwardUpdateRequest;

class AboutAwardController extends Controller
{
    public function index(Request $request): AboutAwardCollection
    {
        $this->authorize('view-any', AboutAward::class);

        $search = $request->get('search', '');

        $aboutAwards = AboutAward::search($search)
            ->latest()
            ->paginate();

        return new AboutAwardCollection($aboutAwards);
    }

    public function store(AboutAwardStoreRequest $request): AboutAwardResource
    {
        $this->authorize('create', AboutAward::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-awards', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutAward = AboutAward::create($validated);

        return new AboutAwardResource($aboutAward);

    }

    public function show(
        Request $request,
        AboutAward $aboutAward
    ): AboutAwardResource {
        $this->authorize('view', $aboutAward);

        return new AboutAwardResource($aboutAward);
    }

    public function update(
        AboutAwardUpdateRequest $request,
        AboutAward $aboutAward
    ): AboutAwardResource {
        $this->authorize('update', $aboutAward);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutAward->image) {
                Storage::delete($aboutAward->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/about-awards', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $aboutAward->update($validated);

        return new AboutAwardResource($aboutAward);

    }

    public function destroy(Request $request, AboutAward $aboutAward): Response
    {
        $this->authorize('delete', $aboutAward);

        if ($aboutAward->image) {
            Storage::delete($aboutAward->image);
        }

        $aboutAward->delete();

        return response()->noContent();
    }
}
