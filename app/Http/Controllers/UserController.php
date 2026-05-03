<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() { return User::with('role')->get(); }

    public function show($id) { return User::with('role')->findOrFail($id); }

    public function update(Request $r,$id)
    {
        $u = User::findOrFail($id);
        $u->update($r->all());
        return $u;
    }

    public function destroy($id) { User::destroy($id); }
}