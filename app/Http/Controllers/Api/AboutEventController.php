<?php

namespace App\Http\Controllers\Api;

use App\Models\AboutEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutEventResource;
use App\Http\Resources\AboutEventCollection;
use App\Http\Requests\AboutEventStoreRequest;
use App\Http\Requests\AboutEventUpdateRequest;

class AboutEventController extends Controller
{
    public function index(Request $request): AboutEventCollection
    {
        $this->authorize('view-any', AboutEvent::class);

        $search = $request->get('search', '');

        $aboutEvents = AboutEvent::search($search)
            ->latest()
            ->paginate();

        return new AboutEventCollection($aboutEvents);
    }

    public function store(AboutEventStoreRequest $request): AboutEventResource
    {
        $this->authorize('create', AboutEvent::class);

        $validated = $request->validated();

        $aboutEvent = AboutEvent::create($validated);

        return new AboutEventResource($aboutEvent);
    }

    public function show(
        Request $request,
        AboutEvent $aboutEvent
    ): AboutEventResource {
        $this->authorize('view', $aboutEvent);

        return new AboutEventResource($aboutEvent);
    }

    public function update(
        AboutEventUpdateRequest $request,
        AboutEvent $aboutEvent
    ): AboutEventResource {
        $this->authorize('update', $aboutEvent);

        $validated = $request->validated();

        $aboutEvent->update($validated);

        return new AboutEventResource($aboutEvent);
    }

    public function destroy(Request $request, AboutEvent $aboutEvent): Response
    {
        $this->authorize('delete', $aboutEvent);

        $aboutEvent->delete();

        return response()->noContent();
    }
}
