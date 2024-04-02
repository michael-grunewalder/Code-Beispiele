<?php

namespace Modules\Warengruppen\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Warengruppen\App\Http\Requests\WarengruppenRequest;
use Modules\Warengruppen\App\Models\Warengruppe;

class WarengruppenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('warengruppen::index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarengruppenRequest $request): RedirectResponse
    {
        $warengruppe = new Warengruppe($request->all());
        $warengruppe->kunde_id = getClientId();
        $warengruppe->save();
        toastr()->success('Neue Warengruppe angelegt');
        return redirect()->route('warengruppen.index');
    }

    public function edit($id)
    {
        return view('warengruppen::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
