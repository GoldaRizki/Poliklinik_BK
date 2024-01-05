<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">Poliklinik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">


        <li class="nav-item">
          <a class="nav-link" href="{{ url('/home') }}">Home</a>
        </li>
        

        @if(Auth::guard('admin')->guest() && Auth::guard('dokter')->guest())
          <li class="nav-item">  
            <a class="nav-link" href="{{ url('/daftarpoli') }}">Daftar Poli</a>
          </li>
        @endif

        
        @auth('dokter')
        <li class="nav-item">  
        <a class="nav-link" href="{{ url('/inputJadwal') }}">Input Jadwal</a>
        </li>

        <li class="nav-item">  
        <a class="nav-link" href="{{ url('/antrian') }}">Antrian</a>
        </li>
        @endauth
    
      @auth('admin')
      <li class="nav-item">  
      <a class="nav-link" href="{{ url('/dokter') }}">Dokter</a>
      </li>

      <li class="nav-item">  
      <a class="nav-link" href="{{ url('/pasien') }}">Pasien</a>
      </li>

      <li class="nav-item">  
      <a class="nav-link" href="{{ url('/obat') }}">Daftar Obat</a>
      </li>

      <li class="nav-item">  
      <a class="nav-link" href="{{ url('/poli') }}">Poli</a>
      </li>
      @endauth


      <div>
      @guest('admin')
      @guest('dokter')
      
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('/loginDokter') }}">Sebagai Dokter</a></li>
            <li><a class="dropdown-item" href="{{ url('/loginAdmin') }}">Sebagai Admin</a></li>
          </ul>
        </div>
      @endguest
      @endguest

      </ul>


      
      @auth('admin')
      <span class="navbar-text px-3">
        {{ Auth::guard('admin')->user()->nama }} (Admin)
      </span>

      <form action="{{ url('/logoutAdmin') }}" method="post">
        @csrf
        <button type="submit" class="nav-link">Logout</button>
      </form>
      @endauth

      @auth('dokter')
      <span class="navbar-text px-3">
        {{ Auth::guard('dokter')->user()->nama }} (Dokter)
      </span>

      <form action="{{ url('/logoutDokter') }}" method="post" style="display: inline;">
        @csrf
        <button type="submit" class="nav-link">Logout</button>
      </form>


      @endauth


    </div>
  </div>
</nav>