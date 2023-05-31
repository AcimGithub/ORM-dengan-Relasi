<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pegination
        $mahasiswas = Mahasiswa::with('kelas')->get(); //Mengambil semua isi tabel
        $paginate = Mahasiswa::orderBy('Nim','asc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswas, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $validate = $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'kelas_id' => 'required',
            'Jurusan' => 'required',
            'Hp' => 'required',
            'Email' => 'required',
            'TTL' => 'required'
        ]);

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($validate);
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get("Nim");
        $mahasiswa->nama = $request->get("Nama");
        $mahasiswa->kelas_id = $request->get("kelas_id");
        $mahasiswa->jurusan = $request->get("Jurusan");
        $mahasiswa->hp = $request->get("Hp");
        $mahasiswa->email = $request->get("Email");
        $mahasiswa->ttl = $request->get("TTL");
        $mahasiswa->save();

        // $kelas = new Kelas;
        // $kelas->id = $request->get('kelas_id');

        // $mahasiswa->kelas()->associate($kelas);
        // $mahasiswa->save();
        

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
    {
        //menpilkan detail data
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'kelas_id' => 'required',
                'Jurusan' => 'required',
                'Hp' => 'required',
                'Email' => 'required',
                'TTL' => 'required'
            ]);
        //fungsi eloquent untuk mengupdate
            // Mahasiswa::find($Nim)->update($request->all());
            $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
            $mahasiswa->nim = $request->get("Nim");
            $mahasiswa->nama = $request->get("Nama");
            $mahasiswa->kelas_id = $request->get("kelas_id");
            $mahasiswa->jurusan = $request->get("Jurusan");
            $mahasiswa->hp = $request->get("Hp");
            $mahasiswa->email = $request->get("Email");
            $mahasiswa->ttl = $request->get("TTL");
            $mahasiswa->save();

        //jika data berhasil diupdate, kembali to halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        //fungsi qloquent menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request) 
    {
        $data = $request->search;
        $mahasiswas = Mahasiswa::where('nama', 'like', '%' . $data . '%')->paginate(6);
        return view('mahasiswa.index', compact('mahasiswas'));
    }
}
