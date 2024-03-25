<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard Template</title>
	<!-- Incluir CSS de Bootstrap -->
	<link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
</head>

<body>
	<main>
		<header>
			<div class="px-3 py-2 text-bg-dark border-bottom">
				<div class="container">
					<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
						<a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
							<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z" fill="#ffffff" />
								<path d="M15.4991 10.1301C16.5374 10.1301 17.3791 9.28841 17.3791 8.25012C17.3791 7.21182 16.5374 6.37012 15.4991 6.37012C14.4608 6.37012 13.6191 7.21182 13.6191 8.25012C13.6191 9.28841 14.4608 10.1301 15.4991 10.1301Z" fill="#cccccc" />
								<path d="M8.49914 10.1301C9.53744 10.1301 10.3791 9.28841 10.3791 8.25012C10.3791 7.21182 9.53744 6.37012 8.49914 6.37012C7.46085 6.37012 6.61914 7.21182 6.61914 8.25012C6.61914 9.28841 7.46085 10.1301 8.49914 10.1301Z" fill="#cccccc" />
								<path d="M15.6009 12.9199H8.40086C7.70086 12.9199 7.13086 13.4899 7.13086 14.1999C7.13086 16.8899 9.32086 19.0799 12.0109 19.0799C14.7009 19.0799 16.8909 16.8899 16.8909 14.1999C16.8809 13.4999 16.3009 12.9199 15.6009 12.9199Z" fill="#cccccc" />
							</svg>
						</a>

						<ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
							<li>
								<a href="#" class="nav-link text-secondary">
									Home
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<?= $_SESSION['usernamme'] ?>
								</a>
							</li>
							<li>
								<a href="../functions/cerrar-sesion.php" class="nav-link text-white">
									Cerrar sesion
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<main>
			<section class="py-5 text-center container">
				<div class="row py-lg-5">
					<div class="col-lg-6 col-md-8 mx-auto">
						<h1 class="fw-light">Sistema administrativo de alumnos</h1>
						<p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
						<p>
							<a href="#" class="btn btn-primary my-2">Crear alumno</a>
						</p>
					</div>
				</div>
			</section>

			<div class="container">
				<div class="row">
					<?php
					// Incluir el archivo de conexión a la base de datos
					include_once '../includes/connection.php';

					// Realizar la consulta para obtener los estudiantes
					$sql = "SELECT id, name, first_last_name, second_last_name, , grade, serial FROM students";
					$resultado = $conn->query($sql);

					// Verificar si hay resultados
					if ($resultado->num_rows > 0) {
						// Mostrar la tabla HTML con los datos de los estudiantes
						echo "<table id='miTabla'>
							<thead><tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Matricula</th>
								<th>Grupo</th>
							</tr></thead><tbody>";

						// Iterar sobre cada fila de resultados
						while ($fila = $resultado->fetch_assoc()) {
							echo "<tr>
								<td>" . $fila['id'] . "</td>
								<td>" . $fila['name'] . ' ' . $fila['first_last_name'] . ' ' . $fila['second_last_name'] . "</td>
								<td>" . $fila['serial'] . "</td>
								<td>" . $fila['grade'] . "</td>
							</tr>";
						}
						echo "</tbody></table>";
					} else {
						echo "<h3>No se encontraron estudiantes registrados.</h3>";
					}
					// Cerrar la conexión a la base de datos
					$conn->close();
					?>
				</div>
			</div>

		</main>
	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Incluir DataTables después de jQuery -->
	<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

	<!-- Tu script personalizado -->
	<script>
		$(document).ready(function() {
			let table = $('#miTabla').DataTable({
				language: {
					url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
				},
				buttons: [
					'copy', 'excel', 'pdf'
				]
			});

			table.buttons().container()
				.appendTo($('.col-sm-6:eq(0)', table.table().container()));
		});
	</script>
</body>

</html>