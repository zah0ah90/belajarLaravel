@extends('layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Divisi </h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                {{-- @can('tambah_data') --}}
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
                    {{-- {{SiteHelpers::cek_akses()}} --}}
                {{-- @endcan --}}
                {{-- @can('tambah_divisi', \App\Models\Divisi::class)
<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
    @endcan --}}

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
                            <th>Nama Divisi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $no => $dt)
                        <tr>
                            <td>{{  $no+1 }}</td>
                            <td>{{ $dt->nama }}</td>

                            <td>
                                <a href="#" data-id="{{ $dt->id }}" class="badge badge-success btn-edit">Edit</a>
                                @can('delete_divisi', \App\Models\Divisi::class)
                                <a href="#" data-id="{{ $dt->id }}" class="badge badge-danger swal-confirm">
                                    <form action="{{ route('divisi.destroy', $dt->id) }}" id="delete{{ $dt->id }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    Delete
                                </a>
                                @endcan

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $setup->links() }} --}}
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('divisi.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" @error('nama') class="text-danger" @enderror>
                                    Nama Divisi
                                    @error('nama')
                                    | {{ $message }}
                                    @enderror
                                </label>
                                <input type="text" value="{{ old('nama') }}" name="nama" class="form-control">
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('divisi.store') }}" method="post" id="form-edit">
                        @csrf
                        <div class="modal-body">
                        </div>
                </div>

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-update" type="button">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('page-script')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@endpush
@push('after-script')
<script>
    $(".swal-confirm").click(function (e) {
        id = e.target.dataset.id;
        swal({
                title: 'Are you sure?',
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

    // 

    $(".btn-edit").on('click', function () {
        // alert($(this).data('id'))
        // $('#modal-edit').modal('show')
        let id = $(this).data('id');
        $.ajax({
            url: `/master-data/divisi/${id}/edit`,
            method: 'get',
            success: function (data) {
                $('#modal-edit').find('.modal-body').html(data);
                $('#modal-edit').modal('show');
            },
            error: function (error) {
                alert(error);
            }
        })
    })

    @if($errors-> any()) {
        $('#exampleModal').modal('show');
    }
    @endif

    $('.btn-update').on('click', function () {
        let id = $('#form-edit').find('#id_data').val();
        let formData = $('#form-edit').serialize();
        // alert(id);
        $.ajax({
            url: `/master-data/divisi/${id}`,
            method: 'patch',
            data: formData,
            success: function (data) {
                $('#modal-edit').modal('hide');
                window.location.assign('/master-data/divisi')
            },
            error: function (err) {
                // console.log(err.responseJSON.errors.jumlah_hari_kerja);
                console.log(err.responseJSON);
                let err_log = err.responseJSON.errors;
                if (err.status == 422) {
                    if (typeof (err_log.nama) !== 'undefined') {
                        $('#modal-edit').find('[name="nama"]').prev().html(
                            '<span style="color:red">Nama Aplikasi | ' + err_log.nama[
                                0] + '</span>');
                    } else {
                        $('#modal-edit').find('[name="nama"]').prev().html(
                            '<span >Nama Aplikasi </span>');
                    }


                }
            }
        })
    })

</script>
@endpush

@section('title', 'Setup Aplikasi')
{{-- @endsection --}}
