<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index() { return Role::with('permissions')->get(); }

    public function store(Request $r)
    {
        $r->validate(['name'=>'required']);
        return Role::create($r->all());
    }

    public function show($id) { return Role::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $role = Role::findOrFail($id);
        $role->update($r->all());
        return $role;
    }

    public function destroy($id) { Role::destroy($id); }
}
