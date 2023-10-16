<?php

namespace App\Http\Controllers\Api;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\HomeResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeCollection;
use App\Http\Requests\HomeStoreRequest;
use App\Http\Requests\HomeUpdateRequest;

class HomeController extends Controller
{
    public function index(Request $request): HomeCollection
    {
        $this->authorize('view-any', Home::class);

        $search = $request->get('search', '');

        $homes = Home::search($search)
            ->latest()
            ->paginate();

        return new HomeCollection($homes);
    }

    public function store(HomeStoreRequest $request): HomeResource
    {
        $this->authorize('create', Home::class);

        $validated = $request->validated();

        $home = Home::create($validated);

        return new HomeResource($home);
    }

    public function show(Request $request, Home $home): HomeResource
    {
        $this->authorize('view', $home);

        return new HomeResource($home);
    }

    public function update(HomeUpdateRequest $request, Home $home): HomeResource
    {
        $this->authorize('update', $home);

        $validated = $request->validated();

        $home->update($validated);

        return new HomeResource($home);
    }

    public function destroy(Request $request, Home $home): Response
    {
        $this->authorize('delete', $home);

        $home->delete();

        return response()->noContent();
    }
}
