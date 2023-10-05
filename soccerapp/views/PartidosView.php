<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <?php include "fragments/navbar.php"; ?>
        <section id="lista">
            <h5>Listado partidos</h5>
            <hr>
            <div>
                <button type="button" class="btn btn-primary">Nuevo</button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jornada</th>
                        <th scope="col">Local</th>
                        <th scope="col">Visitante</th>
                        <th scope="col">Goles</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbody"> </tbody>
            </table>
        </section>

        <section id="form">
            <h5>Formulario equipo</h5>
            <hr>
            <form id="formulario">
                <div class="mb-3">
                    <label for="jornada" class="form-label">Jornada</label>
                    <input type="date" class="form-control" id="jornada" value="" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="idLocal">
                        <option selected>Selecciona equipo local</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="idVisitante">
                        <option selected>Selecciona equipo visitante</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="golesLocal" class="form-label">Goles local</label>
                    <input type="date" class="form-control" id="golesLocal" value="" required>
                </div>
                <div class="mb-3">
                    <label for="golesVisitante" class="form-label">Goles Visitante</label>
                    <input type="date" class="form-control" id="golesVisitante" value="" required>
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
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/jquery.min.js"></script>
</body>
</html>