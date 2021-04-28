<div class="form-group">
  <input type="hidden" name="id" id="id_data" value="{{$setup->id }}">
  <label for="" @error('nama_aplikasi') class="text-danger" @enderror>
    Nama Aplikasi
    @error('nama_aplikasi')
    | {{ $message }}
    @enderror
  </label>
  <input type="text" value="{{ $setup->nama_aplikasi }}" name="nama_aplikasi" class="form-control">
</div>
<div class="form-group">
  <label @error('jumlah_hari_kerja') class="text-danger" @enderror for="">Jumlah Hari
    Kerja
    | @error('jumlah_hari_kerja')
    {{ $message }}
    @enderror</label>
  <input type="text" value="{{ $setup->jumlah_hari_kerja }}" name="jumlah_hari_kerja" class="form-control">
</div>