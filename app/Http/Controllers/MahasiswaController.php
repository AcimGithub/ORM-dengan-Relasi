<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'foto' => 'required',
            'kelas_id' => 'required',
            'Jurusan' => 'required',
            'Hp' => 'required',
            'Email' => 'required',
            'TTL' => 'required'
        ]);

        if ($request->file('foto')) {
            $nama_foto = $request->file('foto')->store('fotoMahasiswa', 'public');
        } else {
            dd('foto kosong');
        }

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($validate);
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get("Nim");
        $mahasiswa->nama = $request->get("Nama");
        $mahasiswa->foto = $nama_foto;
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
                'foto' => 'required',
                'kelas_id' => 'required',
                'Jurusan' => 'required',
                'Hp' => 'required',
                'Email' => 'required',
                'TTL' => 'required'
            ]);

            $mhs = Mahasiswa::find($Nim);

            if ($mhs->foto && file_exists(storage_path('app/public/' . $mhs->foto))) {
                Storage::delete('public/' . $mhs->foto);
            }

            $nama_foto = $request->file('foto')->store('fotoMahasiswa', 'public');

        //fungsi eloquent untuk mengupdate
            // Mahasiswa::find($Nim)->update($request->all());
            $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
            $mahasiswa->nim = $request->get("Nim");
            $mahasiswa->nama = $request->get("Nama");
            $mahasiswa->foto = $nama_foto;
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

    public function khs(Mahasiswa $mahasiswa)
    {
        $matkuls = $mahasiswa->MataKuliah;

        return view('mahasiswa.nilai', [
            'matkuls' => $matkuls,
            'mahasiswa' => $mahasiswa
        ]);
        // dd($matkuls);

        // $role = Mahasiswa::where('Nim', '2141720039')->first();

        // dd($role->matakuliahs);


        // dd($data);
    }

    public function cetak_khs(Mahasiswa $mahasiswa)
    {
        $matkuls = $mahasiswa->MataKuliah;
        $pdf = Pdf::loadview('mahasiswa.cetak_nilai', [
            'matkuls' => $matkuls,
            'mahasiswa' => $mahasiswa,
        ]);
        return $pdf->stream();
    }

}
