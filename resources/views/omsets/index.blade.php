@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Omset</h2>
    <a href="{{ route('omsets.create') }}" class="btn btn-primary mb-3">Tambah Omset</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Klien</th>
                <th>Alamat</th>
                <th>Project</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($omsets as $omset)
            <tr>
                <td>{{ $omset->tanggal }}</td>
                <td>{{ $omset->nama_klien }}</td>
                <td>{{ $omset->alamat }}</td>
                <td>{{ $omset->project }}</td>
                <td>Rp {{ number_format($omset->nominal, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('omsets.edit', $omset->id_omset) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('omsets.destroy', $omset->id_omset) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
