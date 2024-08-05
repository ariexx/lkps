<?php

namespace App\Http\Controllers;

use App\Http\Requests\EWMPRequest;
use App\Models\EWMP;

class EWMPController extends Controller
{
    public function index()
    {
        return EWMP::all();
    }

    public function store(EWMPRequest $request)
    {
        return EWMP::create($request->validated());
    }

    public function show(EWMP $eWMP)
    {
        return $eWMP;
    }

    public function update(EWMPRequest $request, EWMP $eWMP)
    {
        $eWMP->update($request->validated());

        return $eWMP;
    }

    public function destroy(EWMP $eWMP)
    {
        $eWMP->delete();

        return response()->json();
    }
}
