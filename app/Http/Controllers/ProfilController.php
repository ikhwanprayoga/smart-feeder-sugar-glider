<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $input = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (isset($request->password)) {
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);

        alert()->success('Data Profil berhasil diperbaharui', 'Sukses');
        
        return redirect()->back();
    }
}
