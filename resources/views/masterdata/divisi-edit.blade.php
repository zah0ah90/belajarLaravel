<div class="form-group">
  <input type="hidden" name="id" id="id_data" value="{{$data->id }}">
  <label for="" @error('nama') class="text-danger" @enderror>
    Nama Divisi
    @error('nama')
    | {{ $message }}
    @enderror
  </label>
  <input type="text" value="{{ $data->nama }}" name="nama" class="form-control">
</div>
