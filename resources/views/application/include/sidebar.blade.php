<!-- {{ $menuActive = strtolower($menuActive) }} -->
<ul class="nav">
  <li class="nav-item {{ ($menuActive == 'dataparkir')?'active':'non-active' }} ">
    <a class="nav-link" href="{{route('viewDataParkir')}}">
      <i class="material-icons">list</i>
      <p> Data Parkir </p>
    </a>
  </li>
  @if(session('role') == 'admin')
  <li class="nav-item {{ ($menuActive == 'daftarkendaraan')?'active':'non-active' }}">
    <a class="nav-link" href="{{route('viewKendaraan')}}">
      <i class="material-icons">list</i>
      <p> Kendaraan </p>
    </a>
  </li>
  <li class="nav-item {{ ($menuActive == 'daftaruser')?'active':'non-active' }}">
    <a class="nav-link" href="{{route('viewUser')}}">
      <i class="material-icons">list</i>
      <p> User </p>
    </a>
  </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal10">
        <i class="material-icons">power_settings_new</i>
        <p> Keluar </p>
      </button>
    </a>
  </li>
</ul>
