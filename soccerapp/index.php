<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SOCCERAPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Partidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Equipos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <section id="lista">
            <h5>Listado equipos</h5>
            <hr>
            <div>
                <button type="button" class="btn btn-primary">Nuevo</button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbody"> </tbody>
            </table>
        </section>

        <section id="form">
            <h5>Formulario equipo</h5>
            <hr>
            <form>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="email" class="form-control" id="nombre" value="" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="reset" class="btn btn-danger" id="volver">Volver</button>
                </div>
            </form>
        </section>
    </div>
    <footer class="footer py-3 my-4">
        <hr>
        <p class="text-center text-body-secondary">© 2023 Company, Inc</p>
    </footer>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/jquery.min.js"></script>
</body>
</html>