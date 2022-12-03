<?php

namespace App\Http\Controllers;

use App\Models\dataMou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $dataMou = dataMou::orderBy('id', 'DESC')->get();
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


    public function store(Request $request)
    {

        $pesan = [
            'required' => 'attribute wajib diisi',
            'mimes' => 'File harus berupa file pdf,docx,doc',
        ];

        $this->validate($request, [

            'tahun' => 'required',
            'judul_mou' => 'required',
            'bidang_kerjasama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'file_pdf' => 'mimes:pdf,docx,doc',
        ], $pesan);



        $dokumen = $request->file('file_pdf');
        $nama_file = $dokumen->getClientOriginalName();
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




    public function edit($id)
    {
        $dataMou = dataMou::select('*')->where('id', $id)->get();
        return view('content.editData', [
            'dataMou' => $dataMou,
        ]);
    }


    public function update(Request $request)
    {
        $this->validate($request, [

            'tahun' => 'required',
            'judul_mou' => 'required',
            'bidang_kerjasama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'file_pdf' => 'mimes:pdf',
        ]);

        if ($request->file('file_pdf') == "") {
            $nama_file = $request->file_lama;
        } else {
            $dokumen = $request->file('file_pdf');
            $nama_file = $dokumen->getClientOriginalName();
            $dokumen->move('doc/', $nama_file);
        }


        dataMou::where('id', $request->id)->update([
            'tahun' => $request->tahun,
            'judul_mou' => $request->judul_mou,
            'bidang_kerjasama' => $request->bidang_kerjasama,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => $request->status,
            'file_pdf' => $nama_file,

        ]);
        return redirect('/tabel-informasi')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = dataMou::findOrFail($id);
        $file_path = public_path('doc/' . $file->file_pdf);
        File::delete($file_path);
        $file->delete();

        return redirect('/tabel-informasi')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
