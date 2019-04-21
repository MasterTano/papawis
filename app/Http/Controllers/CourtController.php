<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Court\CreateCourtService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCourtRequest;
use App\Services\Court\GetCourtService;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Court list';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourtRequest $request, CreateCourtService $action)
    {
        return DB::transaction(function () use ($request, $action) {
            $action->execute($request->all());
            return 'Success';
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, GetCourtService $getCourt)
    {
        return $getCourt->execute(['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'updating court';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'deleting court';
    }
}
