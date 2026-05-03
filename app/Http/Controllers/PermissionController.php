<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index() { return Permission::all(); }

    public function store(Request $r)
    {
        return Permission::create($r->validate(['name'=>'required']));
    }

    public function show($id) { return Permission::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $p = Permission::findOrFail($id);
        $p->update($r->all());
        return $p;
    }

    public function destroy($id) { Permission::destroy($id); }
}