<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    //
    function index()
    {
        $data_barang = DB::table('data_barang')->paginate(5);
        return view('crud', ['data_barang' => $data_barang]);
    }
    function tambah()
    {
        return view('crudtambah');
        // return 'Bambangiin';
    }
    function _validate(Request $request)
    {
        $request->validate(
            [
                'kode_barang' => 'required|max:10|min:3',
                'nama_barang' => 'required|max:100|min:3'
            ],
            [
                'kode_barang.required' => 'Harus diisi',
                'kode_barang.max' => 'jangan melibihi 10 digit',
                'kode_barang.min' => 'jangan kurang 3 digit',
                'nama_barang.required' => 'Harus disii'
            ]
        );
    }

    function simpan(Request $request)
    {
        // var dump nya laravel
        // dd($request->all());
        // query biasa
        // DB::insert('insert into data_barang (kode_barang, nama_barang) values (?, ?)', [$request->kode_barang, $request->nama_barang]);

        // validate


        // query builder
        DB::table('data_barang')->insert([
            ['kode_barang' => $request->kode_barang, 'nama_barang' => $request->nama_barang],
            // ['email' => 'dayle@example.com', 'votes' => 0],
        ]);
        return redirect()->route('crud')->with('message', 'Data berhasil disimpan');
    }

    function delete($id)
    {
        DB::table('data_barang')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Data Berhasil di Hapus');
    }

    function edit($id)
    {
        $data_barang = DB::table('data_barang')->where('id', $id)->first();
        return view('crudedit', ['data' => $data_barang]);
    }

    function update(Request $request, $id)
    {
        $this->_validate($request);
        DB::table('data_barang')->where('id', $id)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang
        ]);
        return redirect()->route('crud')->with('message', 'Data Berhasil diupdate');
    }
}