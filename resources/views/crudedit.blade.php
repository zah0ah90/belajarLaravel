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
                            <form action="{{ route('crupdate', $data->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="" @error('kode_barang') class="text-danger" @enderror>
                                        Kode Barang
                                        @error('kode_barang')
                                            | {{ $message }}
                                        @enderror
                                    </label>
                                    <input type="text" @if (old('kode_barang')) value="{{ old('kode_barang') }}"
                                    @else 
                                                                        value="{{ $data->kode_barang }}" @endif name="kode_barang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label @error('nama_barang') class="text-danger" @enderror for="">nama Barang
                                        | @error('nama_barang')
                                            {{ $message }}
                                        @enderror</label>
                                    <input type="text" @if (old('nama_barang')) value="{{ old('nama_barang') }}"
                                    @else 
                                                                        value="{{ $data->nama_barang }}" @endif name="nama_barang" class="form-control">
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
