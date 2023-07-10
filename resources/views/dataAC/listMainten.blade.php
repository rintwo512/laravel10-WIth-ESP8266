@extends('layout.main')


@section('content')
<style>
  .tb-ac tbody tr:hover{
    cursor: pointer;
    background-color: rgba(0,0,0,0.2);
  }
  html.dark-theme body .tb-ac tbody tr:hover{
    cursor: pointer;
    background-color: rgba(255,255,255,0.2);
  }
</style>
@php
 use Illuminate\Support\Carbon;
//  $date = date('Y-m-d H:i:s');
@endphp


            <div class="flash-success" data-success="{{ session('success') }}"></div>
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-table" style="color:#7b378e"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List Data Maintenance AC</li>
                  </ol>
                </nav>
              </div>
            </div>

            <a href="{{ url('/ac') }}" class="mb-0 text-uppercase btn btn-primary btn-sm"><i class="bi bi-arrow-bar-left"></i> Back</a>


        <hr/>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered tb-ac" style="width:100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Asset</th>
                    <th>ID</th>
                    <th>Wing</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Tgl Mainten</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $ac)
                  <tr id="sid{{ $ac->id }}" style="text-transform: capitalize">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ac->assets }}</td>
                    <td>{{ $ac->label }}</td>
                    <td>{{ $ac->wing }}</td>
                    <td>{{ $ac->lantai }}</td>
                    <td>{{ $ac->ruangan }}</td>
                    <td>{{ $ac->merk }}</td>
                    <td>{{ $ac->type }}</td>
                    @if ($ac->status == 'Rusak')
                    <td class="bg-danger text-white">{{ $ac->status }}</td>
                    @elseif($ac->status == 'Progres')
                    <td class="bg-warning text-white">{{ $ac->status }}</td>
                    @else
                    <td class="bg-info text-white">{{ $ac->status }}</td>
                    @endif
                    @if ($ac->tgl_maintenance == NULL)
                    <td></td>
                    @else
                    <td>{{ Carbon::parse($ac->tgl_maintenance)->diffForHumans() }}</td>
                    @endif
                    <td>
                        <div class="table-actions d-flex align-items-center gap-3 fs-6">

                            <button id="btnDetailAC" class="text-primary border-0 bg-transparent btnku" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal"
                            data-id="{{ $ac->id }}"
                            data-labelac="{{ $ac->label }}"
                            data-assetsac="{{ $ac->assets }}"
                            data-wingac="{{ $ac->wing }}"
                            data-lantaiac="{{ $ac->lantai }}"
                            data-ruanganac="{{ $ac->ruangan }}"
                            data-merkac="{{ $ac->merk }}"
                            data-typeac="{{ $ac->type }}"
                            data-jenisac="{{ $ac->jenis }}"
                            data-kapasitasac="{{ $ac->kapasitas }}" data-refrigerantac="{{ $ac->refrigerant }}" data-productac="{{ $ac->product }}"
                            data-currentac="{{ $ac->current }}"
                            data-voltageac="{{ $ac->voltage }}"
                            data-btuac="{{ $ac->btu }}"
                            data-pipaac="{{ $ac->pipa }}"
                            data-statusac="{{ $ac->status }}"
                            data-seriindoorac="{{ $ac->seri_indoor }}"
                            data-serioutdoorac="{{ $ac->seri_outdoor }}"
                            data-catatanac="{{ $ac->catatan }}"
                            data-keteranganac="{{ $ac->keterangan }}"
                            data-kerusakanac="{{ $ac->kerusakan }}"
                            data-tglpemasanganac="{{ $ac->tgl_pemasangan }}"
                            data-petugasmaintac="{{ $ac->petugas_maint }}"
                            data-petugaspemasanganac="{{ $ac->petugas_pemasangan }}"
                            data-tanggalmaintenanceac="{{ Carbon::parse($ac->tgl_maintenance)->locale('id')->diffForHumans() }}" data-updatedtimeac="{{ $ac->user_updated }}/{{ Carbon::parse($ac->user_updated_time)->diffForHumans() }}">
                            <i class="bi bi-eye-fill"></i>
                            </button>
                          </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Asset</th>
                    <th>ID</th>
                    <th>Wing</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Tgl Mainten</th>
                    <th>Opsi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        {{-- Modal Detail --}}

        <div class="col">
          <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    {{-- <div class="card-body"> --}}
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Di ubah <i class="bi bi-arrow-right"></i> <strong id="detailUpdatedAC"></strong>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Pemasangan <i class="bi bi-arrow-right"></i> <strong id="detailTanggaPemasanganAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Petugas Pemasangan <i class="bi bi-arrow-right"></i> <strong id="detailPetugasPemasanganAC" class="text-capitalize"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Maintenance <i class="bi bi-arrow-right"></i> <strong id="detailTglMaintenanceAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Petugas Maintenance <i class="bi bi-arrow-right"></i> <strong id="detailPetugasMaintAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Label <i class="bi bi-arrow-right"></i> <strong id="detailLabelAC" class="text-capitalize"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Assets <i class="bi bi-arrow-right"></i> <strong id="detailAssetsAC" class="text-capitalize"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Wing <i class="bi bi-arrow-right"></i> <strong id="detailWingAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Lantai <i class="bi bi-arrow-right"></i> <strong id="detailLantaiAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Ruangan <i class="bi bi-arrow-right"></i> <strong id="detailRuanganAC" class="text-capitalize"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Merk <i class="bi bi-arrow-right"></i> <strong id="detailMerkAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Type <i class="bi bi-arrow-right"></i> <strong id="detailTypeAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Jenis <i class="bi bi-arrow-right"></i> <strong id="detailJenisAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Kapasitas <i class="bi bi-arrow-right"></i> <strong id="detailKapasitasAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Refrigerant <i class="bi bi-arrow-right"></i> <strong id="detailRefrigerantAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Product <i class="bi bi-arrow-right"></i> <strong id="detailProductAC" class="text-capitalize"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Amper <i class="bi bi-arrow-right"></i> <strong id="detailAmperAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Voltage <i class="bi bi-arrow-right"></i> <strong id="detailVoltageAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Btu <i class="bi bi-arrow-right"></i> <strong id="detailBtuAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">No Seri Indoor <i class="bi bi-arrow-right"></i> <strong id="detailSeriIndoorAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">No Seri Outdoor <i class="bi bi-arrow-right"></i> <strong id="detailSeriOutdoorAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Pipa Liquid + Gas <i class="bi bi-arrow-right"></i> <strong id="detailPipaAC"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Status <i class="bi bi-arrow-right"></i> <strong id="detailStatusAC"></strong>
                        </li>

                        <div class="accordion-item detail-kerusakan">
                          <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Kerusakan
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <p class="accordion-body" id="detailKerusakanAC">
                            </p>
                          </div>
                        </div>

                        <div class="accordion-item detail-keterangan">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                              Keterangan
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <p class="accordion-body" id="detailKeteranganAC">
                            </p>
                          </div>
                        </div>

                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Catatan
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <p class="accordion-body" id="detailCatatanAC">

                            </p>
                          </div>
                        </div>

                        <div id="btn-ac-error">
                          <li class="list-group-item d-flex justify-content-center align-items-center">
                            <a href="/ac/koderror" class="btn btn-danger btn-sm">Lihat Data Error</a>
                          </li>
                        </div>
                      </ul>
                    {{-- </div> --}}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- end modal detail --}}





        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('assets/plugins/flickity/flickity.pkgd.min.js')}}"></script>


        <script>

          $(document).on('click', '#btnDetailAC', function() {

              const label = $(this).data('labelac');
              const assets = $(this).data('assetsac');
              const wingac = $(this).data('wingac');
              const lantaiac = $(this).data('lantaiac');
              const ruanganac = $(this).data('ruanganac');
              const merkac = $(this).data('merkac');
              const typeac = $(this).data('typeac');
              const jenisac = $(this).data('jenisac');
              const kapasitasac = $(this).data('kapasitasac');
              const refrigerantac = $(this).data('refrigerantac');
              const productac = $(this).data('productac');
              const currentac = $(this).data('currentac');
              const voltageac = $(this).data('voltageac');
              const btuac = $(this).data('btuac');
              const pipaac = $(this).data('pipaac');
              const statusac = $(this).data('statusac');
              const seriIndoor = $(this).data('seriindoorac');
              const seriOutdoor = $(this).data('serioutdoorac');
              const catatanac = $(this).data('catatanac');
              const kerusakanac = $(this).data('kerusakanac');
              const keteranganac = $(this).data('keteranganac');
              const tanggalpemasanganac = $(this).data('tglpemasanganac');
              const petugaspemsanganac = $(this).data('petugaspemasanganac');
              const tanggalmaint = $(this).data('tanggalmaintenanceac');
              const petugasmaintac = $(this).data('petugasmaintac');
              const updatedtimeac = $(this).data('updatedtimeac');

              if(updatedtimeac == '/1 detik yang lalu'){

                $('#detailUpdatedAC').html('');


              }else{

                $('#detailUpdatedAC').html(updatedtimeac);


              }

              if(tanggalmaint == '1 detik yang lalu'){

                $('#detailTglMaintenanceAC').html('');

              }else{


                $('#detailTglMaintenanceAC').html(tanggalmaint);

              }


              $('#detailTanggaPemasanganAC').html(tanggalpemasanganac);
              $('#detailPetugasMaintAC').html(petugasmaintac);
              $('#detailPetugasPemasanganAC').html(petugaspemsanganac);
              $('#detailLabelAC').html(label);
              $('#detailAssetsAC').html(assets);
              $('#detailWingAC').html(wingac);
              $('#detailLantaiAC').html(lantaiac);
              $('#detailRuanganAC').html(ruanganac);
              $('#detailMerkAC').html(merkac);
              $('#detailTypeAC').html(typeac);
              $('#detailJenisAC').html(jenisac);
              $('#detailKapasitasAC').html(kapasitasac);
              $('#detailRefrigerantAC').html(refrigerantac);
              $('#detailProductAC').html(productac);
              $('#detailAmperAC').html(currentac);
              $('#detailVoltageAC').html(voltageac);
              $('#detailBtuAC').html(btuac);
              $('#detailSeriIndoorAC').html(seriIndoor);
              $('#detailSeriOutdoorAC').html(seriOutdoor);
              $('#detailPipaAC').html(pipaac);
              $('#detailStatusAC').html(statusac);
              $('#detailCatatanAC').html(catatanac);
              $('#detailKerusakanAC').html(kerusakanac);
              $('#detailKeteranganAC').html(keteranganac);
          });

        </script>
@endsection
