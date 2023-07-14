@extends('layout.main')


@section('content')
<?php use Illuminate\Support\Carbon; ?>
<div class="flash-success" data-success="{{ session('success') }}"></div>
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-user' style="color:#fff"></i></a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">User profile</li>
                </ol>
            </nav>
            </div>
        </div>
        <div class="profile-cover bg-dark"></div>


        <div class="row">
            <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">My Account</h5>
                    <hr>
                    <div class="card shadow-none border">
                    <div class="card-header">
                        <h6 class="mb-0">USER INFORMATION</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('usersetting/' . auth()->user()->id) }}" method="post" enctype="multipart/form-data" class="row g-3">
                            @method('put')
                            @csrf
                        <div class="col-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control" value="{{ auth()->user()->nik }}" readonly>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Whatsapp</label>
                            <input type="text" name="no_wa" class="form-control" value="{{ auth()->user()->no_wa }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ auth()->user()->tempat_lahir }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="text" name="tanggal_lahir" id="date" class="form-control" value="{{ date('Y-m-d', strtotime(auth()->user()->tanggal_lahir)) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Picture</label>
                            <input type="hidden" name="oldImg" value="{{ auth()->user()->image }}">
                                @if (auth()->user()->image)

                                @if (auth()->user()->image != 'default.png')
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" style="width: 120px;height:120px">
                                @else
                                <img src="{{ asset('/assets/images/avatars/' . auth()->user()->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" style="width: 120px;height:120px">
                                @endif

                                @else

                                <img class="img-preview img-fluid mb-3 col-sm-5">

                                @endif
                                <input class="form-control @error('img') is-invalid @enderror" type="file" id="img" name="image" onchange="previewImage()">
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-purple px-4">Save Changes</button>
                            </div>
                        </form>
                    </div>
                    </div>

                </div>
            </div>
            </div>
            <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                    @if (auth()->user()->image != 'default.png')
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" class="rounded-circle shadow" width="120" height="120" alt="">
                    @else
                    <img src="{{ asset('assets/images/avatars/' . auth()->user()->image) }}" class="rounded-circle shadow" width="120" height="120" alt="">
                    @endif
                    </div>
                    <div class="text-center mt-4">
                    <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                    <p class="mb-0 text-secondary">{{ auth()->user()->nik }}</p>
                    <div class="mt-4"></div>
                    <h6 class="mb-1">Member Since - {{ auth()->user()->created_at->year }}</h6>
                    <p class="mb-0 text-secondary">Reg 7</p>
                    </div>
                </div>
            </div>
            </div>
        </div><!--end row-->

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('')}}/assets/js/flash-notif.js"></script>

        <script>          

            document.addEventListener('trix-file-accept', function(e) {
                    e.preventDefault();
                });

            function previewImage()
                {
                    const img = document.querySelector('#img');
                    const imgPre = document.querySelector('.img-preview');
                    imgPre.style.display = 'block';
                    const ofReader = new FileReader();
                    ofReader.readAsDataURL(img.files[0]);
                    ofReader.onload = function(oFREvent){
                        imgPre.src = oFREvent.target.result;
                    }
                }

        </script>

@endsection
