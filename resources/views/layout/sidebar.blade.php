@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Menu;
    use App\Models\Submenu;
    use App\Models\User;

    $user = auth()->user();

    $menus = Menu::all();
    $submenus = Submenu::all();

@endphp

<aside class="sidebar-wrapper">
    <div class="iconmenu">
        <div class="nav-toggle-box">
            <div class="nav-toggle-icon" onclick="setWrapper()"><i class="bi bi-list"></i></div>
        </div>
        <ul class="nav nav-pills flex-column">
            @foreach ($menus as $menu)
                @if ($user->role == 1 || in_array($menu->id, $user->menus->pluck('id')->toArray()))

                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $menu->name }}">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="{{ $menu->data_target }}"
                            type="button"><i class="{{ $menu->icon }}"></i></button>
                    </li>
                @endif
            @endforeach

            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Log Out" id="logSidebar">
                <form action="{{ url('logout/' . auth()->user()->id) }}" method="post">
                    @csrf
                    <button type="button" id="btnLog1" class="nav-link"><i
                            class="bi bi-box-arrow-in-right"></i></button>
                </form>
            </li>
        </ul>
    </div>
    <div class="textmenu">
        <div class="brand-logo">
            @if (auth()->user()->role == 1)                
            <a href="{{ url('/home') }}">
            <img src="{{ asset('assets/images/enerlog.png') }}" style="margin-left: 10px" width="160"
                alt="" />
            </a>
            @else
            <a href="{{ url('/ac') }}">
                <img src="{{ asset('assets/images/enerlog.png') }}" style="margin-left: 10px" width="160"
                    alt="" />
                </a>
            @endif
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="pills-dashboards">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Dashboard</h5>
                        </div>
                    </div>
                    <a href="{{ url('/home') }}"
                        class="list-group-item {{ Request::is('/home*') ? 'active' : '' }}"><i
                            class="bi bi-server"></i> Home</a>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-todolist">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Catatan</h5>
                        </div>
                    </div>
                    <a href="{{ url('/todolist') }}"
                        class="list-group-item {{ Request::is('/todolist*') ? 'active' : '' }}"><i
                            class="bi bi-server"></i> Todolist</a>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-application">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Database</h5>
                        </div>
                    </div>
                    <a href="{{ url('/ac') }}"
                        class="list-group-item {{ Request::is('/ac*') ? 'active' : '' }}"><i
                            class="bi bi-server"></i> Data AC</a>
                    <a href="{{ url('/event') }}"
                        class="list-group-item {{ Request::is('/event*') ? 'active' : '' }}"><i
                            class="bi bi-server"></i> Data Event</a>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-adminMenu">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Menu Admin</h5>
                        </div>
                    </div>
                    <a href="{{ url('/members') }}"
                        class="list-group-item {{ Request::is('/members*') ? 'active' : '' }}"><i
                            class="bi bi-person-lines-fill"></i> Data Users</a>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-charts">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Update Chart</h5>
                        </div>
                    </div>
                    <a href="{{ url('/chart/search') }}"
                        class="list-group-item {{ Request::is('/chart/search*') ? 'active' : '' }}"><i
                            class="bi bi-bar-chart-fill"></i> Chart AC</a>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-chatbot">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">AI</h5>
                        </div>
                    </div>
                    <a href="{{ url('/chatbot') }}"
                        class="list-group-item {{ Request::is('/chatbot*') ? 'active' : '' }}"><i
                            class="bi bi-person-lines-fill"></i> Chatbot</a>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-settings">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Settings</h5>
                        </div>
                    </div>
                    <a href="{{ url('/usersetting') }}"
                        class="list-group-item {{ Request::is('/usersetting*') ? 'active' : '' }}"><i
                            class="bi bi-person-lines-fill"></i> Profile</a>
                    <a href="{{ url('/usersetting/create') }}"
                        class="list-group-item list-group-item {{ Request::is('settings/changepassword*') ? 'active' : '' }}"><i
                            class="bi bi-lock"></i> Change Password</a>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-tools">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Tools</h5>
                        </div>
                    </div>

                    <a href="{{ url('/tools/cosine') }}"
                        class="list-group-item {{ Request::is('/tools/cosine*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> CosPI Kalkulator</a>

                    <a href="{{ url('/tools/ampertova') }}"
                        class="list-group-item {{ Request::is('/tools/ampertova*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Amper - VA</a>

                    <a href="{{ url('/tools/watttoamper') }}"
                        class="list-group-item {{ Request::is('/tools/watttoamper*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Watt - Amper</a>

                    <a href="{{ url('/tools/ampertowatt') }}"
                        class="list-group-item {{ Request::is('/tools/ampertowatt*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Amper - Watt</a>

                    <a href="{{ url('/tools/watttova') }}"
                        class="list-group-item {{ Request::is('/tools/watttova*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Watt - VA</a>

                    <a href="{{ url('/tools/kalkulatorenergi') }}"
                        class="list-group-item {{ Request::is('/tools/kalkulatorenergi*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Kalkulator Energi</a>

                    <a href="{{ url('/tools/ohmlaw') }}"
                        class="list-group-item {{ Request::is('/tools/ohmlaw*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Ohm Law</a>

                    <a href="{{ url('/tools/voltdivider') }}"
                        class="list-group-item {{ Request::is('/tools/voltdivider*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Volt Divider</a>

                    <a href="{{ url('/tools/celfah') }}"
                        class="list-group-item {{ Request::is('/tools/celfah*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i>Celcius - Fahrenheit</a>

                    <a href="{{ url('/tools/btuTopk') }}"
                        class="list-group-item {{ Request::is('/tools/btuTopk*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Btu - PK</a>

                    <a href="{{ url('/tools/wattTobtu') }}"
                        class="list-group-item {{ Request::is('/tools/wattTobtu*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Watt - Btu/h</a>

                    <a href="{{ url('/tools/btuTowatt') }}"
                        class="list-group-item {{ Request::is('/tools/btuTowatt*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Btu/h - Watt</a>

                    <a href="{{ url('/tools/wattTokwh') }}"
                        class="list-group-item {{ Request::is('/tools/wattTokwh*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Konversi Watts - kWh</a>

                    <a href="{{ url('/tools/joulesTowatt') }}"
                        class="list-group-item {{ Request::is('/tools/joulesTowatt*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Joules - Watt</a>

                    <a href="{{ url('/tools/scrapeLinks') }}"
                        class="list-group-item {{ Request::is('/tools/scrapeLinks*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Scrapping Links</a>

                    <a href="{{ url('/tools/json') }}"
                        class="list-group-item {{ Request::is('/tools/json*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Convert Json</a>

                    <a href="{{ url('/tools/json2') }}"
                        class="list-group-item {{ Request::is('/tools/json2*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Convert Json 2</a>


                    <a href="{{ url('/tools/colorpick') }}"
                        class="list-group-item {{ Request::is('/tools/colorpick*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Color Picker</a>

                    <a href="{{ url('/tools/cropimage') }}"
                        class="list-group-item {{ Request::is('/tools/cropimage*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Cropping Image</a>

                    <a href="{{ url('/tools/rgbcolor') }}"
                        class="list-group-item {{ Request::is('/tools/rgbcolor*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> RGB Color Generator</a>

                    <a href="{{ url('/tools/jwt') }}"
                        class="list-group-item {{ Request::is('/tools/jwt*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> JWT Generator</a>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-enertrack">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">EnerTrack</h5>
                        </div>
                    </div>
                    <a href="{{ url('/enertrack/monitor') }}"
                        class="list-group-item {{ Request::is('/enertrack/monitor*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Monitoring</a>
                    <a href="{{ url('/enertrack/control') }}"
                        class="list-group-item {{ Request::is('/enertrack/control*') ? 'active' : '' }}"><i
                            class="bi bi-gear-wide"></i> Control</a>
                </div>
            </div>
        </div>
    </div>
</aside>





<script>
    $(document).on("click", "#logSidebar", function() {

        if (confirm('Are you sure?')) {
            $('#btnLog1').removeAttr('type');
        }

    });
</script>
