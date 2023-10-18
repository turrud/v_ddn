<?php

namespace App\Http\Controllers\view;


use App\Http\Controllers\Controller;
use App\Models\AboutClient;
use App\Models\AboutEvent;

class ViewAboutEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = AboutEvent::all();
        return view('showPage.about.event', compact('event'));

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(view $view)
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request, view $view)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(view $view, {{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(view $view, {{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, view $view, {{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(view $view, {{ model }} ${{ modelVariable }})
    // {
    //     //
    // }
}