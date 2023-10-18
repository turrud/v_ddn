<?php

namespace App\Http\Controllers\store;

use {{ namespacedModel }};
use App\Http\Controllers\Controller;
use App\Models\store;
use Illuminate\Http\Request;

class ViewStore3dArchitectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(store $store)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(store $store)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, store $store)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(store $store, {{ model }} ${{ modelVariable }})
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(store $store, {{ model }} ${{ modelVariable }})
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, store $store, {{ model }} ${{ modelVariable }})
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(store $store, {{ model }} ${{ modelVariable }})
    {
        //
    }
}
