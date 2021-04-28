<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('akses_divisi', Divisi::class);
        if (!Gate::allows('akses')) {
            return redirect()->route('dashboard');
        }
        $data = Divisi::get();
        // $data_barang = DB::table('data_barang')->paginate(5);
        return view('masterdata.divisi', ['data' => $data]);
    }

    function _validate(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|max:100',
            ],
            [
                'nama.required' => 'Harus diisi',
                'nama.max' => 'jangan melibihi 100 digit',
                // 'nama.min' => 'jangan kurang 3 digit',
            ]
        );
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
        $this->_validate($request);
        Divisi::create($request->all());
        return redirect()->back();
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
        $data = Divisi::find($id);
        return view('masterdata.divisi-edit', ['data' => $data]);
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
        Divisi::where('id', $id)->update(['nama' => $request->nama]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Divisi::destroy($id);
        return redirect()->route('divisi.index');
    }
}