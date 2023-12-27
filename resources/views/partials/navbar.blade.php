<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="{{ url('/home') }}">Home</a>
        <a class="nav-link" href="{{ url('/dokter') }}">Dokter</a>
        <a class="nav-link" href="{{ url('/pasien') }}">Pasien</a>
        <a class="nav-link" href="{{ url('/obat') }}">Daftar Obat</a>
        <a class="nav-link" href="{{ url('/poli') }}">Poli</a>


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

      @auth('admin')
      <form action="{{ url('/logoutAdmin') }}" method="post">
        @csrf
        <button type="submit" class="nav-link">Logout</button>
      </form>
      @endauth

      @auth('dokter')
      <form action="{{ url('/logoutDokter') }}" method="post">
        @csrf
        <button type="submit" class="nav-link">Logout</button>
      </form>
      @endauth

      



      </div>
    </div>
  </div>
</nav>