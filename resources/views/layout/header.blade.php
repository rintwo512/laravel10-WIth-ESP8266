@php
  use App\Models\User;
  use Illuminate\Support\Carbon;
  $users = User::all();
  $online = User::where('status_login', 'online')->get()->count();

@endphp
<style>
  html.dark-theme .text-online{
    color:rgb(7, 226, 7) !important;
  }
</style>
<header class="top-header">
    <nav class="navbar navbar-expand">
      <div class="mobile-toggle-icon d-xl-none">
          <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar d-none d-xl-block">

        </div>
        <div class="top-navbar-right ms-auto">
          <ul class="navbar-nav align-items-center">
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="user-setting d-flex align-items-center gap-1">
                @if (auth()->user()->image != 'default.png')
                <img src="{{ asset('storage/' . auth()->user()->image) }}" class="user-img" alt="">
                @else
                <img src="{{ asset ('assets/images/avatars/' . auth()->user()->image) }}" class="user-img" alt="">
                @endif
                <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                    @if (auth()->user()->image != 'default.png')
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" class="user-img" alt="">
                    @else
                    <img src="{{ asset('assets/images/avatars/' . auth()->user()->image) }}" class="user-img" alt="">
                    @endif
                      <div class="ms-3">
                        @if(auth()->user()->role == "1")
                        <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}, Anda login sebagai Admin</h6>
                        @else
                        <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}, Anda login sebagai Member</h6>
                        @endif
                      </div>
                   </div>
                 </a>
               </li>
               <li><hr class="dropdown-divider"></li>
               <li>
                  <a class="dropdown-item" href="{{ url('/usersetting') }}">
                     <div class="d-flex align-items-center">
                       <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                       <div class="setting-text ms-3"><span>Profile</span></div>
                     </div>
                   </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ url('logout/' . auth()->user()->id) }}" method="post" id="autoLogout">
                    @csrf
                    <button type="button" class="dropdown-item" id="btnLog">
                      <div class="d-flex align-items-center">
                        <div class="setting-icon"><i class="bi bi-box-arrow-right"></i></div>

                        <div class="setting-text ms-3"><span>Logout</span></div>

                      </div>
                    </button>
                  </form>
                </li>
            </ul>
          </li>
          <li class="nav-item dropdown dropdown-large">
            <button style="background: transparent" class="border-0 nav-link dropdown-toggle dropdown-toggle-nocaret" onclick="setDark()">
              <div class="projects">
                <i class="bi bi-moon-fill"></i>
              </div>
            </button>
          </li>
          <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="messages">
                <span class="notify-badge">{{ $online }}</span>
                <i class="bi bi-bell-fill"></i>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0">
              <div class="p-2 border-bottom m-2">
                  <h5 class="h5 mb-0">Notification</h5>
              </div>
             <div class="header-message-list p-2">
               @if (auth()->user()->role === 1)

               <a class="dropdown-item" href="{{ url('/home/users') }}">
               @endif
                 @foreach ($users as $user )
                 <div class="d-flex align-items-center">

                   @if(Cache::has('user-is-online-' . $user->id))

                     @if (auth()->user()->name != $user->name)
                        @if ($user->image != 'default.png')
                        <img src="{{ asset('storage/' . $user->image) }}" alt="" class="rounded-circle" width="52" height="52">
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">{{ $user->name }}</h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center text-success text-online">Online {{ Carbon::parse($user->is_login)->locale('id')->diffForHumans() }}</small>
                        </div>
                        @else
                        <img src="{{ asset('assets/images/avatars/' . $user->image) }}" alt="" class="rounded-circle" width="52" height="52">
                      <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0 dropdown-msg-user">{{ $user->name }}</h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center text-success text-online">Online {{ Carbon::parse($user->is_login)->locale('id')->diffForHumans() }}</small>
                        </div>
                        @endif

                     @endif

                    @endif
                  </div>
                 @endforeach
               </a>
           </div>

           </div>
          </li>

          </ul>
          </div>
    </nav>
  </header>
  <script src="{{ asset ('assets/js/jquery.min.js ') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>


// $(document).ready(function () {
//     const timeout = 1800000;  // 1800000 ms = 30 minutes
//     var idleTimer = null;
//     $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
//         clearTimeout(idleTimer);

//         idleTimer = setTimeout(function () {
//             document.getElementById('autoLogout').submit();
//         }, timeout);
//     });
//     $("body").trigger("mousemove");
// });

  const btnLog = document.querySelector('#btnLog');
  btnLog.addEventListener('click', function() {
    if(confirm('Are you sure?')){

      btnLog.removeAttribute('type');
    }
  });


  </script>

<script>
    document.addEventListener('keydown', function (event) {
  if (event.key === 'Escape') {
        if(confirm('Are you sure?')){

            document.getElementById('autoLogout').submit();
        }

  }
});
  </script>

  <script>

var logoutTimer;

function startLogoutTimer() {
  logoutTimer = setTimeout(logout, 30 * 60 * 1000); // Mengatur timeout selama 29 menit (29 * 60 * 1000 ms)
}

function resetLogoutTimer() {
  clearTimeout(logoutTimer);
  startLogoutTimer();
}

function logout() {

    Swal.fire({
        title: 'Logout otomatis karena tidak ada aktivitas!',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
        });
        setTimeout(function() {

            document.getElementById('autoLogout').submit();
        }, 15000);

}

// Event listener untuk mendeteksi aktivitas pengguna
document.addEventListener('mousemove', resetLogoutTimer);
document.addEventListener('keydown', resetLogoutTimer);
document.addEventListener('click', resetLogoutTimer);
document.addEventListener('scroll', resetLogoutTimer);

// Memulai timer saat halaman dimuat
startLogoutTimer();


  </script>
