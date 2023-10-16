<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\NewsResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Http\Requests\NewsStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{
    public function index(Request $request): NewsCollection
    {
        $this->authorize('view-any', News::class);

        $search = $request->get('search', '');

        $allNews = News::search($search)
            ->latest()
            ->paginate();

        return new NewsCollection($allNews);
    }

    public function store(NewsStoreRequest $request): NewsResource
    {
        $this->authorize('create', News::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/news', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $news = News::create($validated);

        return new NewsResource($news);

    }

    public function show(Request $request, News $news): NewsResource
    {
        $this->authorize('view', $news);

        return new NewsResource($news);
    }

    public function update(NewsUpdateRequest $request, News $news): NewsResource
    {
        $this->authorize('update', $news);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::delete($news->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/news', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $news->update($validated);

        return new NewsResource($news);

    }

    public function destroy(Request $request, News $news): Response
    {
        $this->authorize('delete', $news);

        if ($news->image) {
            Storage::delete($news->image);
        }

        $news->delete();

        return response()->noContent();
    }
}