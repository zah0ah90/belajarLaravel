@extends('layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crud Tambah</h1>
        </div>
        <br>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('crsimpan') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="" @error('kode_barang') class="text-danger" @enderror>
                                        Kode Barang
                                        @error('kode_barang')
                                            | {{ $message }}
                                        @enderror
                                    </label>
                                    <input type="text" value="{{ old('kode_barang') }}" name="kode_barang"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label @error('nama_barang') class="text-danger" @enderror for="">nama Barang
                                        | @error('nama_barang')
                                            {{ $message }}
                                        @enderror</label>
                                    <input type="text" value="{{ old('nama_barang') }}" name="nama_barang"
                                        class="form-control">
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('title', 'Crud Tambah')
