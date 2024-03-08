@extends('layouts.app')
<!-- START FORM -->
@section('content') 

<form action='{{ url('students/'.$data->std_number) }}' method='post'>
@csrf 
@method('PUT')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href='{{ url('students') }}' class="btn btn-secondary"><< kembali</a>
    <div class="mb-3 row">
        <label for="std_number" class="col-sm-2 col-form-label">NIM</label>
        <div class="col-sm-10">
            {{ $data->std_number }}
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='name' value="{{ $data->name }}" id="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="department" class="col-sm-2 col-form-label">Jurusan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='department' value="{{ $data->department }}" id="department">
        </div>
    </div>
    <div class="mb-3 row">
        {{-- <label for="jurusan" class="col-sm-2 col-form-label"></label> --}}
        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
    </div>
</div>
</form>
<!-- AKHIR FORM -->
@endsection