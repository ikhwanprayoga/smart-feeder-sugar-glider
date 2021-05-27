<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $datas = User::where('id', '!=', 1)->get();

        return view('admin.pengguna.index', compact('datas'));
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user = User::create($input);

        alert()->success('Pengguna berhasil ditambahkan', 'Sukses');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (isset($request->password)) {
            $input['password'] = bcrypt($request->password);
        }

        $user = User::where('id', $id)->update($input);

        alert()->success('Pengguna berhasil diperbaharui', 'Sukses');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        alert()->success('Pengguna berhasil dihapus', 'Sukses');
        return redirect()->back();
    }
}
