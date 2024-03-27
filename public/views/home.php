<?php
include_once '../../includes/verifySession.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard Template</title>
	<!-- Incluir CSS de Bootstrap -->
	<link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		#studentsTable_wrapper .dt-search {
			float: right;
		}

		#studentsTable_wrapper .dt-buttons>button {
			color: white;
			background-color: #0d6efd;
			border-color: #0d6efd;
			border-radius: 0.375rem;
		}
	</style>
</head>

<body>
	<main>
		<header>
			<div class="px-3 py-2 text-bg-dark border-bottom">
				<div class="container">
					<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
						<a href="/public/views/home.php" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
							<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z" fill="#ffffff" />
								<path d="M15.4991 10.1301C16.5374 10.1301 17.3791 9.28841 17.3791 8.25012C17.3791 7.21182 16.5374 6.37012 15.4991 6.37012C14.4608 6.37012 13.6191 7.21182 13.6191 8.25012C13.6191 9.28841 14.4608 10.1301 15.4991 10.1301Z" fill="#cccccc" />
								<path d="M8.49914 10.1301C9.53744 10.1301 10.3791 9.28841 10.3791 8.25012C10.3791 7.21182 9.53744 6.37012 8.49914 6.37012C7.46085 6.37012 6.61914 7.21182 6.61914 8.25012C6.61914 9.28841 7.46085 10.1301 8.49914 10.1301Z" fill="#cccccc" />
								<path d="M15.6009 12.9199H8.40086C7.70086 12.9199 7.13086 13.4899 7.13086 14.1999C7.13086 16.8899 9.32086 19.0799 12.0109 19.0799C14.7009 19.0799 16.8909 16.8899 16.8909 14.1999C16.8809 13.4999 16.3009 12.9199 15.6009 12.9199Z" fill="#cccccc" />
							</svg>
						</a>

						<ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
							<li>
								<a href="/public/views/home.php" class="nav-link text-secondary">
									Home
								</a>
							</li>
							<li>
								<a href="#" class="nav-link text-white">
									<?php echo $_SESSION['username']; ?> 
								</a>
							</li>
							<li>
								<a href="../../includes/logout.php" class="nav-link text-white">
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
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="openModal">Open Modal</button>
					</div>
				</div>
			</section>

			<div class="container">
				<div class="row">
					<?php
					// Incluir el archivo de conexión a la base de datos
					include_once '../../includes/connection.php';

					// Realizar la consulta para obtener los estudiantes
					$sql = "SELECT id, name, first_last_name, second_last_name, grade, serial FROM students";
					$result = $conn->query($sql);

					// Verificar si hay resultados
					if ($result->num_rows > 0) {
						// Mostrar la tabla HTML con los datos de los estudiantes
						echo "<table id='studentsTable'>
							<thead><tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Matricula</th>
								<th>Grupo</th>
								<th>Opciones</th>
							</tr></thead><tbody>";

						// Iterar sobre cada fila de resultados
						while ($data = $result->fetch_assoc()) {
							echo "<tr>
								<td>" . $data['id'] . "</td>
								<td>" . $data['name'] . ' ' . $data['first_last_name'] . ' ' . $data['second_last_name'] . "</td>
								<td>" . $data['serial'] . "</td>
								<td>" . $data['grade'] . "</td>
								<td><button class='btn btn-sm btn-warning' id='btn-edit'><i class='bi bi-pencil'></i>Editar</button>
								<button class='btn btn-sm btn-danger' id='btn-destroy' data-id='" . $data['id'] . "'><i class='bi bi-trash'></i>Eliminar</button>
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
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Formulario de registro</h4>
				</div>
				<div class="modal-body">
					<p>Ingrese o actualice la información del estudiante.</p>
					<form id="studentForm">
						<input type="hidden" id="studentId" name="studentId" value="">
						<div class="form-group">
							<label for="name">Nombre:</label>
							<input type="text" class="form-control" id="name" name="name">
						</div>
						<div class="form-group">
							<label for="first_last_name">Apellido Paterno:</label>
							<input type="text" class="form-control" id="first_last_name" name="first_last_name">
						</div>
						<div class="form-group">
							<label for="second_last_name">Apellido Materno:</label>
							<input type="text" class="form-control" id="second_last_name" name="second_last_name">
						</div>
						<div class="form-group">
							<label for="serial">Matrícula:</label>
							<input type="text" class="form-control" id="serial" name="serial">
						</div>
						<div class="form-group">
							<label for="grade">Grupo:</label>
							<input type="text" class="form-control" id="grade" name="grade">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="saveStudent">Guardar</button>
				</div>
			</div>

		</div>
	</div>
	<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/v/dt/dt-2.0.3/b-3.0.1/b-html5-3.0.1/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			const table = $('#studentsTable').DataTable({
				language: {
					url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json'
				},
				dom: 'lBfrtip',
				buttons: ['csv']
			});

			// Abre el modal y carga el formulario en blanco
			$('#openModal').on('click', function() {
				$('#studentForm')[0].reset(); // Limpia el formulario
				$('#studentId').val(''); // Restablece el ID del estudiante a vacío
			});

			$('#studentsTable').on('click', '#btn-edit', function() {
				let studentId = $(this).closest('tr').find('td:first').text();
				$.ajax({
					url: '../../functions/get.php',
					method: 'GET',
					data: {
						id: studentId
					},
					dataType: 'json',
					success: function(response) {
						if (response.success == true) {
							// Llena el formulario con los datos del estudiante
							$('#studentId').val(response.data.id);
							$('#name').val(response.data.name);
							$('#first_last_name').val(response.data.first_last_name);
							$('#second_last_name').val(response.data.second_last_name);
							$('#serial').val(response.data.serial);
							$('#grade').val(response.data.grade);

							$('#myModal').modal('show');
						}
						console.log('Respuesta del servidor:', response);
					},
					error: function(xhr, status, error) {
						alert('Error al obtener los datos del estudiante');
						console.error(error);
					}
				});
			});

			$('#studentsTable').on('click', '#btn-destroy', function() {
				let studentId = $(this).data('id');
				// Realizar solicitud AJAX
				if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
					$.ajax({
						url: '../../functions/destroy.php',
						method: 'POST',
						data: {
							id: studentId
						},
						dataType: 'json',
						success: function(response) {
							if (response.success) alert(response.message);
							console.log('Respuesta del servidor:', response);
						},
						error: function(xhr, status, error) {
							alert('Error al eliminar al estudiante');
							console.error(error);
						}
					});
				}
			});

			// Maneja el envío del formulario
			$('#saveStudent').on('click', function() {
				event.preventDefault();
				let mode = ($('#studentId').val() !== '') ? 'editing' : 'store';
				console.log(`Sending form on ${mode} by ${$('#studentId').val()}`);
				if (mode == 'store') {
					$.ajax({
						url: '../../functions/store.php',
						method: 'POST',
						data: {
							name: $('#name').val(),
							first_last_name: $('#first_last_name').val(),
							second_last_name: $('#second_last_name').val(),
							serial: $('#serial').val(),
							grade: $('#grade').val()
						},
						dataType: 'json',
						success: function (response) {
							if (response.success) alert(response.message)
							console.log('Respuesta del servidor:', response);
							$('#myModal').modal('hide');
						},
						error: function (xhr, status, error) {
							alert('Error al crear al estudiante');
							console.error(error);
						}
					})
				} else {
					$.ajax({
						url: '../../functions/update.php',
						method: 'PATCH',
						data: {
							id: $('#studentId').val(),
							name: $('#name').val(),
							first_last_name: $('#first_last_name').val(),
							second_last_name: $('#second_last_name').val(),
							serial: $('#serial').val(),
							grade: $('#grade').val()
						},
						dataType: 'json',
						success: function (response) {
							if (response.success) alert(response.message)
							console.log('Respuesta del servidor:', response);
							$('#myModal').modal('hide');
						},
						error: function (xhr, status, error) {
							alert('Error al actualizar el estudiante');
							console.error(error);
						}
					})
				}
			});
		});
	</script>
</body>

</html>