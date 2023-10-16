<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContactCourse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContactCourseResource;
use App\Http\Resources\ContactCourseCollection;
use App\Http\Requests\ContactCourseStoreRequest;
use App\Http\Requests\ContactCourseUpdateRequest;

class ContactCourseController extends Controller
{
    public function index(Request $request): ContactCourseCollection
    {
        $this->authorize('view-any', ContactCourse::class);

        $search = $request->get('search', '');

        $contactCourses = ContactCourse::search($search)
            ->latest()
            ->paginate();

        return new ContactCourseCollection($contactCourses);
    }

    public function store(
        ContactCourseStoreRequest $request
    ): ContactCourseResource {
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

    public function show(
        Request $request,
        ContactCourse $contactCourse
    ): ContactCourseResource {
        $this->authorize('view', $contactCourse);

        return new ContactCourseResource($contactCourse);
    }

    public function update(
        ContactCourseUpdateRequest $request,
        ContactCourse $contactCourse
    ): ContactCourseResource {
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

        return new ContactCourseResource($contactCourse);

    }

    public function destroy(
        Request $request,
        ContactCourse $contactCourse
    ): Response {
        $this->authorize('delete', $contactCourse);

        if ($contactCourse->image) {
            Storage::delete($contactCourse->image);
        }

        $contactCourse->delete();

        return response()->noContent();
    }
}