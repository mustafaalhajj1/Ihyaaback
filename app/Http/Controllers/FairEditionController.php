<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FairEditionController extends Controller
{
    public function index() { return FairEdition::all(); }

    public function store(Request $r)
    {
        return FairEdition::create($r->validate(['name'=>'required','year'=>'required']));
    }

    public function show($id) { return FairEdition::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $f = FairEdition::findOrFail($id);
        $f->update($r->all());
        return $f;
    }

    public function destroy($id) { FairEdition::destroy($id); }}