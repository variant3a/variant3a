<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemoRequest;
use App\Http\Requests\UpdateMemoRequest;
use App\Models\Memo;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function edit(Memo $memo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemoRequest  $request
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemoRequest $request, Memo $memo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memo $memo)
    {
        //
    }
}
