@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Omset</h2>
    <form action="{{ route('omsets.update', $omset->id_omset) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $omset->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Klien</label>
            <input type="text" name="nama_klien" class="form-control" value="{{ $omset->nama_klien }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $omset->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>Project</label>
            <input type="text" name="project" class="form-control" value="{{ $omset->project }}" required>
        </div>
        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" value="{{ $omset->nominal }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('omsets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
