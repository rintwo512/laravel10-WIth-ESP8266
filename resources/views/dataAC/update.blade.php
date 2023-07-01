@extends('layout.main')


@section('content')

<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<div class="row">
<div class="col-xl-9 mx-auto">
  <a href="{{ url('/ac') }}" class="btn btn-success btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back</a>
  <h6 class="mb-0 text-uppercase">Update Data AC</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="p-4 border rounded">
        <form action="{{url('/ac/update/' . $ac->id) }}" method="post" class="row g-3 needs-validation">
            @csrf
          <div class="col-md-4">
            <label for="tgl_pemasangan" class="form-label">Tanggal Pemasangan</label>
            <input type="text" class="form-control datepicker" name="tgl_pemasangan" id="tgl_pemasangan" value="{{ old('tgl_pemasangan', $ac->tgl_pemasangan) }}">
          </div>
          <div class="col-md-4">
            <label for="petugas_pemasangan" class="form-label">Petugas Pemasangan</label>
            <input type="text" data-role="tagsinput" class="form-control" id="petugas_pemasangan" name="petugas_pemasangan" value="{{ old('petugas_pemasangan', $ac->petugas_pemasangan) }}">
          </div>
          <div class="col-md-4">
            <label for="tgl_maintenance" class="form-label">Tanggal Maintenance</label>
            <input class="result form-control" type="text" name="tgl_maintenance" id="date-time" value="{{ old('tgl_maintenance', $ac->tgl_maintenance) }}">
          </div>
          <div class="col-md-12">
            <label for="petugas_maint" class="form-label">Petugas Maintenance</label>
            <input class="form-control" data-role="tagsinput" type="text" name="petugas_maint" value="{{ old('petugas_maint', $ac->petugas_maint) }}">
          </div>
          <div class="col-md-4">
            <label for="label" class="form-label">ID</label>
            <input type="text" class="form-control @error('label')
            is-invalid @enderror" id="label" name="label" value="{{ old('label', $ac->label) }}">
            @error('label')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-4">
            <label for="assets" class="form-label">Asset</label>
            <input type="text" class="form-control" name="assets" id="assets" value="{{ old('assets', $ac->assets) }}">
          </div>
          <div class="col-md-4">
            <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
            <select class="form-select" id="merk" required name="merk">
                <option value="{{ $ac->merk }}" selected>{{ $ac->merk }}</option>
                <option disabled value="">--Select--</option>
                <option value="Daikin">Daikin</option>
                <option value="General">General</option>
                <option value="Panasonic">Panasonic</option>
                <option value="LG">LG</option>
                <option value="Sharp">Sharp</option>
                <option value="Mitshubisi">Mitshubisi</option>
                <option value="Midea">Midea</option>
                <option value="Polytron">Polytron</option>
                <option value="Toshiba">Toshiba</option>
                <option value="AUX">AUX</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="wing" class="form-label">Wing <span class="text-danger">*</span></label>
            <select class="form-select" id="wing" required name="wing" value="{{ $ac->wing }}">
                <option value="{{ $ac->wing }}" selected>{{ $ac->wing }}</option>
                <option disabled value="">--Select--</option>
                <option value="WA">WA</option>
                <option value="WB">WB</option>
                <option value="WC">WC</option>
                <option value="WD">WD</option>
                <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="lantai" class="form-label">Lantai <span class="text-danger">*</span></label>
            <select class="form-select" id="lantai" required name="lantai">
                <option value="{{ $ac->lantai }}" selected>{{ $ac->lantai }}</option>
                <option disabled value="">--Select--</option>
                <option value="Lt1">Lt1</option>
                <option value="Lt2">Lt2</option>
                <option value="Lt3">Lt3</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" id="ruangan" value="{{ old('ruangan', $ac->ruangan) }}" required>
          </div>
          <div class="col-md-4">
            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
            <select class="form-select" id="type" required name="type">
                <option value="{{ $ac->type }}" selected>{{ $ac->type }}</option>
                <option disabled value="">--Select--</option>
                <option value="Cassete">Cassete</option>
                <option value="Wall Mounted">Wall Mounted</option>
                <option value="Standing floor">Standing Floor</option>
                <option value="Central">Central</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="kapasitas" class="form-label">Kapasitas <span class="text-danger">*</span></label>
            <select class="form-select" id="kapasitas" required name="kapasitas">
                <option value="{{ $ac->kapasitas }}" selected>{{ $ac->kapasitas }}</option>
                <option disabled value="">--Select--</option>
                <option value="1/2pk">1/2pk</option>
                <option value="3/4pk">3/4pk</option>
                <option value="1pk">1pk</option>
                <option value="1,5pk">1,5pk</option>
                <option value="2pk">2pk</option>
                <option value="2,5pk">2,5pk</option>
                <option value="3pk">3pk</option>
                <option value="5pk">5pk</option>
                <option value="8pk">8pk</option>
                <option value="10pk">10pk</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
            <select class="form-select" id="jenis" required name="jenis">
                <option value="{{ $ac->jenis }}" selected>{{ $ac->jenis }}</option>
                <option disabled value="">--Select--</option>
                <option value="Inverter">Inverter</option>
                <option value="Non-inverter">Non-Inverter</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="refrigerant" class="form-label">Refrigerant <span class="text-danger">*</span></label>
            <select class="form-select" id="refrigerant" required name="refrigerant">
                <option value="{{ $ac->refrigerant }}" selected>{{ $ac->refrigerant }}</option>
                <option disabled value="">--Select--</option>
                <option value="R22">R22</option>
                <option value="R32">R32</option>
                <option value="R410">R410</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="product" class="form-label">Product</label>
            <input type="text" class="form-control" name="product" id="product" value="{{ old('product', $ac->product) }}">
          </div>
          <div class="col-md-4">
            <label for="current" class="form-label">Amper</label>
            <input type="text" class="form-control" name="current" id="current" value="{{ old('current', $ac->current) }}">
          </div>
          <div class="col-md-3">
            <label for="voltage" class="form-label">Voltage <span class="text-danger">*</span></label>
            <select class="form-select" id="voltage" required name="voltage">
                <option value="{{ $ac->voltage }}" selected>{{ $ac->voltage }}</option>
                <option disabled value="">--Select--</option>
                <option value="220Volt">220Volt</option>
                <option value="380Volt">380Volt</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="btu" class="form-label">Btu</label>
            <input type="text" class="form-control" name="btu" id="btu" value="{{ old('btu', $ac->btu) }}">
          </div>
          <div class="col-md-3">
            <label for="pipa" class="form-label">Pipa <small>(Liquid + Gas)</small></label>
            <select class="form-select" id="pipa" name="pipa">
              <option value="{{ $ac->pipa }}" selected>{{ $ac->pipa }}</option>
              <option disabled value="">--Select--</option>
              <option value="1/4 + 3/8">1/4 + 3/8</option>
              <option value="1/4 + 1/2">1/4 + 1/2</option>
              <option value="1/4 + 5/8">1/4 + 5/8</option>
              <option value="3/8 + 5/8">3/8 + 5/8</option>
              <option value="3/8 + 3/4">3/8 + 3/4</option>
              <option value="1/2 + 3/4">1/2 + 3/4</option>
              <option value="1/2 + 7/8">1/2 + 7/8</option>
              <option value="1/2 + 1 1/2">1/2 + 1 1/2</option>
          </select>
          </div>
          <div class="col-md-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" id="status" required name="status">
                <option value="{{ $ac->status }}" selected>{{ $ac->status }}</option>
                <option disabled value="">--Select--</option>
                <option value="Normal">Normal</option>
                <option value="Rusak">Rusak</option>
                <option value="Progres">Progres</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="seriIndoor" class="form-label">No Seri Indoor <small>(optional)</small></label>
            <input type="text" class="form-control @error('seri_indoor')
              is-invalid
            @enderror" name="seri_indoor" id="seriIndoor" value="{{ old('seri_indoor', $ac->seri_indoor) }}">
            @error('seri_indoor')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="seriOutdoor" class="form-label">No Seri Outdoor <small>(optional)</small></label>
            <input type="text" class="form-control @error('seri_outdoor') is-invalid @enderror" name="seri_outdoor" id="seriOutdoor" value="{{ old('seri_outdoor', $ac->seri_outdoor) }}">
            @error('seri_outdoor')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-6">
            <label class="form-label" id="labelKeteranganUpdate">Kerusakan</label>
            <textarea class="form-control" name="kerusakan" id="kerusakan" rows="4" cols="4" placeholder="Masukan kerusakan jika ada!">{{ old('kerusakan', $ac->kerusakan) }}</textarea>
          </div>
          <div class="col-6" id="colKeteranganUpdate">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" cols="4" value="" placeholder="Masukan keterangan jika ada!">{{ old('keterangan', $ac->keterangan) }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Catatan</label>
            <textarea class="form-control" name="catatan" id="catatan" rows="4" cols="4" value="" placeholder="Masukan catatan jika ada!">{{ old('catatan', $ac->catatan) }}</textarea>
          </div>
          <div class="col-12">
              <div class="d-grid">
              <button class="btn btn-purple" type="submit">Submit form</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</div>
<!--end row-->

        {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script>


    addEventListener('change', function(){
        const stValue = document.querySelector('#status').value;
        const ctt = document.querySelector('#kerusakan');
        const note = document.querySelector('#catatan');

        if(stValue == 'Rusak'){
            document.querySelector('#kerusakan').required = true;
            $('#kerusakan').show(1000);
            $('#labelKeteranganUpdate').show(1000);
            $('#colKeteranganUpdate').removeClass('col-12');
            document.querySelector('#catatan').required = false;

          }else if(stValue == 'Progres'){
            $('#kerusakan').show(1000);
            $('#labelKeteranganUpdate').show(1000);
            $('#colKeteranganUpdate').removeClass('col-12');
            document.querySelector('#kerusakan').required = true;
            document.querySelector('#catatan').required = true;

          }else if(stValue == 'Normal'){
            document.querySelector('#catatan').required = false;
            document.querySelector('#kerusakan').required = false;
            $('#kerusakan').hide(1000);
            $('#kerusakan').val("");
            $('#labelKeteranganUpdate').hide(1000);
            $('#colKeteranganUpdate').addClass('col-12');


        }

    });




    const label = document.querySelector('#label');
    setTimeout(() => {
      label.classList.remove('is-invalid');
    }, 10000);


</script>
@endsection
