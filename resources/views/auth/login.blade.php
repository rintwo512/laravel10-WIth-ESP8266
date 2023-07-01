<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    <title>{{ $title }}</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/error/login-img.jpeg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title">Sign In</h5>
                                    <p class="card-text mb-5">See your growth and get consulting support!</p>
                                    <div class="flashError" data-error="{{ session('loginError') }}"></div>
                                    <form method="POST" action="{{ url('/auth') }}" class="form-body">
                                        @csrf
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('assets/images/logo-form.png') }}" alt="">
                                        </div>
                                        <div class="login-separater text-center mb-4"> <span>myApp</span>
                                            <hr>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="hidden" name="lat" id="lat">
                                                <input type="hidden" name="long" id="long">
                                                <label for="nik" class="form-label">NIK</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control radius-30 ps-5 @error('nik') is-invalid @enderror"
                                                        id="nik" placeholder="Enter NIK" name="nik"
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        value="{{ old('nik') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                    </div>
                                                    <input type="password"
                                                        class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                                        id="password" placeholder="Enter Password" name="password">
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">Sign
                                                        In</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0">Don't have an account yet? <a href="javascript:void(0)" id="btnSignUp">Sign up here</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        console.log(window.location.href);
       function getLocation() {
         if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(showPosition);
         } else {
           alert('fdf');
         }
       }

       function showPosition(position) {
         document.querySelector('#lat').value = position.coords.latitude;
         document.querySelector('#long').value = position.coords.longitude;

       }

       document.addEventListener('load', getLocation());


     </script>

      <script>
          const flash = document.querySelector('.flashError');
          const message = flash.dataset.error;
          if(message){
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               html: message
               })
          }

          const btnSignUp = document.querySelector('#btnSignUp');

          btnSignUp.addEventListener('click', function() {
           Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Please contact admin!'
             });
          });

          const togglePassword = document.querySelector("#togglePassword");
          const password = document.querySelector("#password");

           togglePassword.addEventListener("click", function () {
               // toggle the type attribute
               const type = password.getAttribute("type") === "password" ? "text" : "password";
               password.setAttribute("type", type);

               // toggle the icon
               this.classList.toggle("bi-eye");
           });

      </script>

   <script>

     const password1 = document.querySelector('#password');
     const message1 = document.querySelector('#message1');

   password1.addEventListener('keyup', function (e) {
     if (e.getModifierState('CapsLock')) {
         message1.textContent = 'Caps lock is on';
     } else {
         message1.textContent = '';
     }
   });
   </script>

   <script>

     $('#nik').on('keypress', function() {

       var checknumber = $('#nik').val();
       if(jQuery.isNumeric(checknumber) == true){
         $('#nik').removeClass('is-invalid');
       }else{
         $('#nik').addClass('is-valid');

       }


     });
     $('#password').on('keyup', function() {
       $('#password').removeClass('is-invalid');
       $('#password').addClass('is-valid');
     });

   </script>



</body>

</html>
