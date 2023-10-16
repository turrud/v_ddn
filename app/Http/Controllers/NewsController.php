<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NewsStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', News::class);

        $search = $request->get('search', '');

        $allNews = News::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_news.index', compact('allNews', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', News::class);

        return view('app.all_news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', News::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/news', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $news = News::create($validated);

        return redirect()
            ->route('all-news.edit', $news)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, News $news): View
    {
        $this->authorize('view', $news);

        return view('app.all_news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, News $news): View
    {
        $this->authorize('update', $news);

        return view('app.all_news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NewsUpdateRequest $request,
        News $news
    ): RedirectResponse {
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

        return redirect()
            ->route('all-news.edit', $news)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, News $news): RedirectResponse
    {
        $this->authorize('delete', $news);

        if ($news->image) {
            Storage::delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('all-news.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
