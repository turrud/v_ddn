<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContactCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContactCourseStoreRequest;
use App\Http\Requests\ContactCourseUpdateRequest;

class ContactCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContactCourse::class);

        $search = $request->get('search', '');

        $contactCourses = ContactCourse::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contact_courses.index',
            compact('contactCourses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContactCourse::class);

        return view('app.contact_courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactCourseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContactCourse::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-courses', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $contactCourse = ContactCourse::create($validated);

        return new ContactCourseResource($contactCourse);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContactCourse $contactCourse): View
    {
        $this->authorize('view', $contactCourse);

        return view('app.contact_courses.show', compact('contactCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContactCourse $contactCourse): View
    {
        $this->authorize('update', $contactCourse);

        return view('app.contact_courses.edit', compact('contactCourse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContactCourseUpdateRequest $request,
        ContactCourse $contactCourse
    ): RedirectResponse {
        $this->authorize('update', $contactCourse);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($contactCourse->image) {
                Storage::delete($contactCourse->image);
            }

            $image = $request->file('image');
            $imagePath = $image->storeAs('public/contact-courses', $image->getClientOriginalName());
            $validated['image'] = $imagePath;
        }

        $contactCourse->update($validated);

        return redirect()
            ->route('contact-courses.edit', $contactCourse)
            ->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContactCourse $contactCourse
    ): RedirectResponse {
        $this->authorize('delete', $contactCourse);

        if ($contactCourse->image) {
            Storage::delete($contactCourse->image);
        }

        $contactCourse->delete();

        return redirect()
            ->route('contact-courses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}