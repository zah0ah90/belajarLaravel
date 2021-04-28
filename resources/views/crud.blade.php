@extends('layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Crud Page</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <a class="btn btn-icon icon-left btn-primary" href="{{ route('crtambah') }}">Tambah Bang </a>
                    <hr>
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span></span>
                                </button>
                                {{ session('message') }}
                            </div>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_barang as $no => $data)
                                <tr>
                                    <td>{{ $data_barang->firstItem() + $no }}</td>
                                    <td>{{ $data->kode_barang }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>
                                        <a href="{{ route('credit', $data->id) }}" class="badge badge-success">Edit</a>
                                        <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                            <form action="{{ route('crdelete', $data->id) }}"
                                                id="delete{{ $data->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data_barang->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-script')
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush
@push('after-script')
    <script>
        $(".swal-confirm").click(function(e) {
            id = e.target.dataset.id;
            swal({
                    title: 'Are you sure?' + id,
                    text: 'Once deleted, you will not be able to recover this imaginary file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal('Poof! Your imaginary file has been deleted!', {
                            icon: 'success',
                        });
                        $(`#delete${id}`).submit();
                    } else {
                        swal('Your imaginary file is safe!');
                    }
                });
        });

    </script>
@endpush

@section('title', 'Crud')
    {{-- @endsection --}}
