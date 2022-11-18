  <header>
    <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand" href="../menuprincipal/index.php">
        <img src="../img/logos/logos formato-08-A.png" alt="Logo" width="150px" height="50px" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../pedidos/pedidos.php">Pedidos</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="../menuprincipal/index.php" role="button" aria-expanded="false">Productos</a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../php/rellenos/menurelleno.php">Rellenos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../php/sabores/menusabor.php">Sabores</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../php/coberturas/menucobertura.php">Coberturas</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../php/tamanos/menutamano.php">Tamaños</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/cliente/menucliente.php">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/menuempleado.php">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../agenda/index.php">Agenda</a>
            </li>
        </ul>
        </div>
        <form action="../php/logout.php" class="frmut">
        <div class="text-end margenLgOut">
            <button type="submit" class="btn btn-primary" >Logout</button>
        </div>
        </form>
    </div>
    </nav>
  </header>