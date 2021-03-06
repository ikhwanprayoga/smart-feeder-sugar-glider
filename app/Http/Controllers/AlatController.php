<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Kendali;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        return view('kendali');
    }

    public function store(Request $request)
    {
        Alat::create([
            'nama' => $request->nama
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $data = Alat::where('id', $id)->first();

        return view('kendali', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Alat::where('id', $id)->first();
        $data->update([
            'nama' => $request->nama
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = Alat::where('id', $id)->first();
        $data->delete();

        return redirect()->back();
    }

    public function kendali_store(Request $request, $id)
    {
        Kendali::create([
            'alat_id' => $id,
            'waktu' => $request->waktu
        ]);

        return redirect()->back();
    }

    public function kendali_destroy($id)
    {
        $data = Kendali::where('id', $id)->first();
        $data->delete();

        return redirect()->back();
    }
}
