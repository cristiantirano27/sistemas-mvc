<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
  <body>
    <!-- MENU -->
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">APPSOCCER</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Equipos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Partidos</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- LISTA -->
      <section id="lista">
        <h5>Listado de Equipos</h5>
        <hr>
        <div>
          <a class="btn btn-primary" href="#" role="button" id="nuevo">Nuevo</a>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody id="tbody">
          </tbody>
        </table>
      </section>

      <!-- FORMULARIO -->
      <section id="form">
        <h5>Formulario de Equipo</h5>
        <hr>
        <form>
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger" id="volver">Volver</button>
          </div>
        </form>
      </section>
    </div>

    <script src="bootstrap.bundle.min.css"></script>
    <script src="jquery.min.js"></script>
  </body>
</html>