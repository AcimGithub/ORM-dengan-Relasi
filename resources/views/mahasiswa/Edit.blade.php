@extends('mahasiswa.layout')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Mahasiswa
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your i
                            nput.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('mahasiswas.update', $Mahasiswa->Nim) }}" id="myForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nim">Nim</label>
                            <input type="text" name="Nim" class="formcontrol" id="Nim"
                                value="{{ $Mahasiswa->Nim }}" ariadescribedby="Nim">
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama</label>
                            <input type="text" name="Nama" class="formcontrol" id="Nama"
                                value="{{ $Mahasiswa->Nama }}" ariadescribedby="Nama">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto"
                                value="{{ $Mahasiswa->foto }}" ariadescribedby="foto" accept="image/*">
                            <div class="mt-3">
                                <img width="100px" src="{{ asset('storage/' . $Mahasiswa->foto) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Kelas">Kelas</label>
                            <select class="form-control" name="kelas_id">
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}"
                                        {{ $Mahasiswa->kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- <input type="Kelas" name="Kelas" class="formcontrol" id="Kelas" aria-describedby="password" > -->
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Jurusan</label>
                            <input type="Jurusan" name="Jurusan" class="formcontrol" id="Jurusan"
                                value="{{ $Mahasiswa->Jurusan }}" ariadescribedby="Jurusan">
                        </div>
                        <div class="form-group">
                            <label for="Hp">Hp</label>

                            <input type="Hp" name="Hp" class="formcontrol" id="Hp"
                                value="{{ $Mahasiswa->Hp }}" ariadescribedby="Hp">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>

                            <input type="Email" name="Email" class="formcontrol" id="Email"
                                value="{{ $Mahasiswa->Email }}" ariadescribedby="Email">
                        </div>
                        <div class="form-group">
                            <label for="TTL">TTL</label>

                            <input type="Date" name="TTL" class="formcontrol" id="TTL"
                                value="{{ $Mahasiswa->TTL }}" ariadescribedby="TTL">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
