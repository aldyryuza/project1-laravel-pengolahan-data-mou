<?php

namespace App\Http\Controllers;

use App\Models\dataMou;
use Illuminate\Http\Request;


class dataMouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dataMou = DB::table('data_mous')->orderByDesc('id')->get();
        // return view('content.tabelInformasi', [
        //     'dataMou' => $dataMou,
        // ]);
        $dataMou = dataMou::all();
        return view('content.tabelInformasi', [
            'dataMou' => $dataMou,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //memanggil view tambah
        // return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'tahun' => 'required',
            'judul_mou' => 'required',
            'bidang_kerjasama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'file_pdf' => 'mimes:pdf',
        ]);

        $dokumen = $request->file('file_pdf');
        $nama_file = $dokumen->getClientOriginalName();
        $extension = $dokumen->getClientOriginalExtension();
        $dokumen->move('doc/', $nama_file);


        dataMou::create([
            'tahun' => $request->tahun,
            'judul_mou' => $request->judul_mou,
            'bidang_kerjasama' => $request->bidang_kerjasama,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => $request->status,
            'file_pdf' => $nama_file,

        ]);
        return redirect('/tabel-informasi')->with(['success' => 'Data Berhasil Ditambahkan']);
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
        //
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
        //
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
