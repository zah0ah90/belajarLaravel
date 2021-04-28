@extends('layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blank Page</h1>
        </div>
        <div class="section-body">
            {{ Auth::user()->email }}
            <x-alert type="danger" judul="informasi" :isipesan="$isipesan" />
        </div>
    </section>
@endsection
@section('title', 'Halaman Awal')
