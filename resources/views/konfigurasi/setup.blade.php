@extends('layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Setup Aplikasi </h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                @if (sizeof($setup) == 0)
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button>
                @endif
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
                            <th>Nama Aplikasi</th>
                            <th>Hari Kerja</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($setup as $no => $data)
                        <tr>
                            <td>{{  1 }}</td>
                            <td>{{ $data->nama_aplikasi }}</td>
                            <td>{{ $data->jumlah_hari_kerja }}</td>
                            <td>
                                <a href="#" data-id="{{ $data->id }}" class="badge badge-success btn-edit">Edit</a>
                                {{-- <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('crdelete', $data->id) }}" id="delete{{ $data->id }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                Delete
                                </a> --}}
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
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('setup.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" @error('nama_aplikasi') class="text-danger" @enderror>
                                    Nama Aplikasi
                                    @error('nama_aplikasi')
                                    | {{ $message }}
                                    @enderror
                                </label>
                                <input type="text" value="{{ old('nama_aplikasi') }}" name="nama_aplikasi"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label @error('jumlah_hari_kerja') class="text-danger" @enderror for="">Jumlah Hari
                                    Kerja
                                    | @error('jumlah_hari_kerja')
                                    {{ $message }}
                                    @enderror</label>
                                <input type="text" value="{{ old('jumlah_hari_kerja') }}" name="jumlah_hari_kerja"
                                    class="form-control">
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
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('setup.store') }}" method="post" id="form-edit">
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

    @if($errors->any()) {
    $('#exampleModal').modal('show');
    }
    @endif

    $(".btn-edit").on('click', function () {
        // alert($(this).data('id'))
        // $('#modal-edit').modal('show')
        let id = $(this).data('id');
        $.ajax({
            url: `/konfigurasi/setup/${id}/edit`,
            method: 'get',
            success: function(data){
                $('#modal-edit').find('.modal-body').html(data);
                $('#modal-edit').modal('show');
            },
            error: function(error){
                alert(error);
            }
        })
    })

    $('.btn-update').on('click', function(){
        let id = $('#form-edit').find('#id_data').val();
        let formData = $('#form-edit').serialize();
        // alert(id);
        $.ajax({
            url: `/konfigurasi/setup/${id}`,
            method: 'patch',
            data: formData,
            success: function(data){
                $('#modal-edit').modal('hide');
                window.location.assign('/konfigurasi/setup')
            },
            error:function(err){
                // console.log(err.responseJSON.errors.jumlah_hari_kerja);
                console.log(err.responseJSON);
                let err_log = err.responseJSON.errors;
                if(err.status == 422){
                    if(typeof(err_log.nama_aplikasi) !== 'undefined'){
                        $('#modal-edit').find('[name="nama_aplikasi"]').prev().html('<span style="color:red">Nama Aplikasi | ' + err_log.nama_aplikasi[0]+'</span>');
                    }else {
                        $('#modal-edit').find('[name="nama_aplikasi"]').prev().html('<span >Nama Aplikasi </span>');
                    }

                    if(typeof(err_log.jumlah_hari_kerja) !== 'undefined'){
                        $('#modal-edit').find('[name="jumlah_hari_kerja"]').prev().html('<span style="color:red">Jumlah Hari Kerja | ' +err_log.jumlah_hari_kerja[0]+'</span>');
                    }else{
                        $('#modal-edit').find('[name="jumlah_hari_kerja"]').prev().html('<span>Jumlah Hari Kerja </span>');
                    }
                }
            }
        })
    })

</script>
@endpush

@section('title', 'Setup Aplikasi')
{{-- @endsection --}}
