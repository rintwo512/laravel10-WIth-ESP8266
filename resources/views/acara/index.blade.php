@extends('layout.main')


@section('content')
    <style>
        .tb-ac tbody tr:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }

        html.dark-theme body .tb-ac tbody tr:hover {
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .custom-button {
            width: 37px;
            /* Ubah sesuai kebutuhan */
            height: 37px;
            /* Ubah sesuai kebutuhan */
            margin-top: 16px;
        }
    </style>
    @php
        use Illuminate\Support\Carbon;

    @endphp




    <div class="flash-success" data-success="{{ session('success') }}"></div>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-table" style="color:#7b378e"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Event</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="d-flex">
                <button class="mb-0 text-uppercase btn btn-primary me-3 custom-button" data-bs-toggle="modal"
                    data-bs-target="#modalAddEvent">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <div class="col-md-5 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control input-range-event" name="rangeEvent"
                            placeholder="Cari data Event">
                        <button class="btn btn-info text-white" type="button" id="btnRangeEvent">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered tb-ac" style="width:100%">

                    <thead>
                        <tr>
                            <th>Penyelenggara</th>
                            <th>Tema Acara</th>
                            <th>Lokasi Acara</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Durasi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $event)
                            @php
                                $mulai = Carbon::parse($event->waktu_mulai);
                                $selesai = Carbon::parse($event->waktu_berakhir);
                                $selisih = $mulai->diff($selesai);
                                $durasi = $selisih->format('%d Hari %H jam %i menit');
                            @endphp
                            <tr>
                                <td>{{ $event->penyelenggara }}</td>
                                <td>{{ $event->tema_acara }}</td>
                                <td>{{ $event->lokasi_acara }}</td>
                                <td>{{ $event->waktu_mulai }}</td>
                                <td>{{ $event->waktu_berakhir }}</td>
                                <td>{{ $durasi }}</td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-1 fs-6">
                                        <button id="btnDetailEvent" class="text-primary border-0 bg-transparent btnku"
                                            data-bs-toggle="modal" data-bs-target="#modalDetailEvent"
                                            data-keterangan="{{ $event->keterangan }}"><i
                                                class="bi bi-eye-fill"></i></button>

                                        <button id="btnEditEvent" class="text-warning text-primary border-0 bg-transparent"
                                            data-bs-toggle="modal" data-bs-target="#modalEditEvent" title="Edit"
                                            data-id="{{ $event->id }}" data-penyelenggara="{{ $event->penyelenggara }}" data-temaacara="{{ $event->tema_acara }}"
                                            data-lokasiacara="{{ $event->lokasi_acara }}"
                                            data-waktumulai="{{ $event->waktu_mulai }}"
                                            data-waktuberakhir="{{ $event->waktu_berakhir }}"
                                            data-keterangan="{{ $event->keterangan }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        @can('admin')
                                            <form id="formDeleteEvent"
                                                action="{{ route('event.destroy', ['event' => $event->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" id="btnDeleteEvent"
                                                    class="text-danger border-0 bg-transparent" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Delete"><i
                                                        class="bi bi-x-circle-fill"></i></button>
                                            </form>
                                        @endcan
                                </td>
            </div>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Penyelenggara</th>
                    <th>Tema Acara</th>
                    <th>Lokasi Acara</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Durasi</th>
                    <th>Opsi</th>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
    </div>

    {{-- MODAL DETAIL EVENT --}}

    <div class="col">
        <div class="modal fade" id="modalDetailEvent" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keterangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="eventKeterangan">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum quos
                            dignissimos corrupti,
                            voluptatibus repellat earum amet consequuntur maiores modi quidem suscipit cumque obcaecati
                            nihil minima ex fugiat quaerat dolor? Pariatur!</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- END MODAL DETAIL EVENT --}}




    {{-- MODAL ADD EVENT --}}
    <div class="modal fade" id="modalAddEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/event') }}" class="row g-3 needs-validation" method="post">
                        @csrf

                        <div class="col-md-12">
                            <label for="penyelenggara" class="form-label">Penyelenggara </label>
                            <input class="form-control" id="penyelenggara" name="penyelenggara">
                        </div>
                        <div class="col-md-12">
                            <label for="tema_acara" class="form-label">Tema Event </label>
                            <input class="form-control" id="tema_acara" name="tema_acara">
                        </div>
                        <div class="col-md-12">
                            <label for="lokasi_acara" class="form-label">Lokasi Event </label>
                            <input class="form-control" id="lokasi_acara" name="lokasi_acara">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai </label>
                            <input class="form-control" id="date-time" name="waktu_mulai">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu_berakhir" class="form-label">Waktu Selesai </label>
                            <input class="form-control" id="date-time2" name="waktu_berakhir">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Keterangan <small>(optional)</small></label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" cols="4"
                                placeholder="Masukan keterangan jika ada!"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- END MODAL ADD EVENT --}}


    {{-- MODAL EDIT EVENT --}}

    <div class="modal fade" id="modalEditEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-edit-event">
                    <form action="{{ url('/event/update') }}" class="row g-3 needs-validation" method="post">
                        @csrf
                        <input type="hidden" id="IDEditEvent" name="id_edit_event">
                        <div class="col-md-12">
                            <label for="penyelenggara" class="form-label">Penyelenggara </label>
                            <input class="form-control penyelenggara" id="penyelenggara" name="penyelenggara">
                        </div>
                        <div class="col-md-12">
                            <label for="tema_acara" class="form-label">Tema Event </label>
                            <input class="form-control tema_acara" id="tema_acara" name="tema_acara">
                        </div>
                        <div class="col-md-12">
                            <label for="lokasi_acara" class="form-label">Lokasi Event </label>
                            <input class="form-control lokasi_acara" id="lokasi_acara" name="lokasi_acara">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai </label>
                            <input class="form-control waktu_mulai" id="date-time3" name="waktu_mulai">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu_berakhir" class="form-label">Waktu Selesai </label>
                            <input class="form-control waktu_berakhir" id="date-time4" name="waktu_berakhir">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Keterangan <small>(optional)</small></label>
                            <textarea class="form-control keterangan" name="keterangan" id="keterangan" rows="4" cols="4"
                                placeholder="Masukan keterangan jika ada!"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- END MODAL EDIT EVENT --}}

    {{-- MODAL RANGE EVENT --}}

    <div class="modal fade" id="modalRangeEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rangeTitleEvent">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Penyelenggara</th>
                                    <th scope="col">Tema Acara</th>
                                    <th scope="col">Lokasi Acara</th>
                                    <th scope="col">Waktu Mulai</th>
                                    <th scope="col">Waktu Selesai</th>
                                    <th scope="col">Durasi</th>
                                    <th scope="col">Ket</th>
                                </tr>
                            </thead>
                            <tbody id="rangeDataEvent">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- END MODAL RANGE EVENT --}}



    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/plugins/flickity/flickity.pkgd.min.js') }}"></script>



    <script>
        const flashSuccess = document.querySelector('.flash-success');
        const flashNotif = flashSuccess.dataset.success;
        if (flashNotif) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: flashNotif,
                showConfirmButton: false,
                timer: 4000
            });
        }


        $(document).on('click', '#btnDeleteEvent', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formDeleteEvent").submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        });
    </script>

    <script>
        $(document).on("click", "#btnDetailEvent", function() {
            $keterangan = $(this).data('keterangan');

            $("#eventKeterangan").text($keterangan);
        });
    </script>


    <script>
        $(document).on("click", "#btnEditEvent", function() {
            $id = $(this).data('id');
            $penyelenggara = $(this).data('penyelenggara');
            $tema = $(this).data('temaacara');
            $lokasi = $(this).data('lokasiacara');
            $mulai = $(this).data('waktumulai');
            $selesai = $(this).data('waktuberakhir');
            $ket = $(this).data('keterangan');


            $(".modal-edit-event #IDEditEvent").val($id);
            $(".modal-edit-event .penyelenggara").val($penyelenggara);
            $(".modal-edit-event .tema_acara").val($tema);
            $(".modal-edit-event .lokasi_acara").val($lokasi);
            $(".modal-edit-event .waktu_mulai").val($mulai);
            $(".modal-edit-event .waktu_berakhir").val($selesai);
            $(".modal-edit-event .keterangan").val($ket);

        });
    </script>

    <script type="text/javascript">
        $(function() {

            $('input[name="rangeEvent"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="rangeEvent"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="rangeEvent"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>

    {{-- **************************************************** --}}

    <script>
        $(document).on('click', '#btnRangeEvent', function() {
            const data = $('.input-range-event').val();
            const start = data.slice(0, 11).split('-').join('/');
            const end = data.slice(13, 23).split('-').join('/');

            $.ajax({
                url: "{{ url('/event/datarangeevent') }}" + "/" + data,
                type: "GET",
                success: result => {
                    let card = '';
                    const count = result.count;
                    const data = result.data;
                    data.forEach(e => {
                        $('#modalRangeEvent').modal('show');
                        $("#rangeTitleEvent").text(
                            `${start} - ${end} | Total : ${count} Event`);
                        card += updateCardEvent(e);
                    });
                    $("#rangeDataEvent").html(card);
                }
            });
        });


        function updateCardEvent(e) {
    const dataID = e.id;
    const start = new Date(e.waktu_mulai);
    const end = new Date(e.waktu_berakhir);

    // Menghitung selisih waktu dalam milidetik
    const timeDiff = end - start;

    // Menghitung selisih hari
    const dayDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

    // Mengonversi selisih waktu ke dalam format yang diinginkan
    const hoursDiff = Math.floor(timeDiff / (1000 * 60 * 60) % 24);
    const minutesDiff = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

    return `<tr>
        <td>${e.penyelenggara}</td>
        <td>${e.tema_acara}</td>
        <td>${e.lokasi_acara}</td>
        <td>${e.waktu_mulai}</td>
        <td>${e.waktu_berakhir}</td>
        <td>${dayDiff} hari ${hoursDiff} jam ${minutesDiff} menit</td>
        <td>${e.keterangan}</td>
    </tr>`;
}

    </script>
@endsection
