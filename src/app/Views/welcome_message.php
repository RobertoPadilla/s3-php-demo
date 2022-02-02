<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title>Subir contenido a AWS S3</title>
</head>
<body>
	<div class="container" id="errors">
		<div class="row justify-content-center">
			<div class="col-9">
				<?php foreach ($errors as $error): ?>
					<div class="alert d-flex alert-warning alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
						<div>
							 <?= esc($error) ?>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>

	<div class="container mt-5">
		<div class="row">
			<div class="col text-center">
				<h1>Sube tu archivo</h1>
			</div>
		</div>
		<div class="row mt-5 justify-content-center">
			<div class="col-6">
				<div class="mb-3">
					<form method="post" action="index.php/upload" enctype="multipart/form-data">
						<label for="formFileMultiple" class="form-label">Selecciona los archivos a subir</label>
						<input class="form-control" type="file" name="userfile" size="20 " id="formFileMultiple" multiple>
						
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-success btn-block mt-5" value="upload">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>