<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #292a2b;">
        <div class="container-fluid">
          <h2 class="text-white">Mastermind Admin</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.empresas')}}">Empresas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.tecnicos')}}">Tecnicos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.ordenes')}}">Ordenes</a>
              </li>
            </ul>
          </div>
      </nav>
</header>