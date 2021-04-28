<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\Setup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setup = Setup::get();
        // $data_barang = DB::table('data_barang')->paginate(5);
        return view('konfigurasi/setup', ['setup' => $setup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $setup = new Setup();
        // $setup->jumlah_hari_kerja = $request->jumlah_hari_kerja;
        // $setup->nama_aplikasi = $request->nama_aplikasi;
        // $setup->save();
        $this->_validate($request);
        Setup::create($request->all());
        return redirect()->back();
    }

    function _validate(Request $request)
    {
        $request->validate(
            [
                'nama_aplikasi' => 'required|max:100|min:3',
                'jumlah_hari_kerja' => 'required|max:3|min:1'
            ],
            [
                'nama_aplikasi.required' => 'Harus diisi',
                'nama_aplikasi.max' => 'jangan melibihi 100 digit',
                'nama_aplikasi.min' => 'jangan kurang 3 digit',
                'jumlah_hari_kerja.min' => 'jangan kurang 1 digit',
                'jumlah_hari_kerja.required' => 'Harus disii'
            ]
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setup = Setup::find($id);
        return view('konfigurasi.setup-edit', ['setup' => $setup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->_validate($request);
        Setup::where('id', $id)->update(['nama_aplikasi' => $request->nama_aplikasi, 'jumlah_hari_kerja' => $request->jumlah_hari_kerja]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}