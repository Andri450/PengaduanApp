<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RT - Tambah TTD</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">
	<?php include_once "menu.php";?>

	<!-- Page Content  -->
	<div id="content">

		<div class="container-fluid">

			<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>

			</button>
			<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<i class="fas fa-align-justify"></i>
			</button>
		</div>
		<div class="container-fluid pt-4">
			<h2>Tambah Data Laporan - Tanda Tangan</h2>
			<form action="<?= base_url('Rt/sys_tambah_TTD') ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-8 col-12 pb-4">
						<h6>Pesan Data Laporan : </h6>
						<input type="text" name="pesan" class="form-control">
					</div>
					<div class="col-md-4 col-12 pb-4">
						<h6>Tempat Data Laporan : </h6>
						<select name="idlab" class="form-control">
							<?php foreach($lab as $l){ ?>
							<option value="<?php echo $l->id; ?>"><?php echo $l->nama_lab; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				<br>
				<label>File Surat</label><br>
				<input type="file" name="file">
				<br>
				<input type="submit" value="Tambah Data" class="btn btn-primary btn-login-custom">
			</form>
		</div>
	</div>
	<!-- Page Content -->
	</div>



</body>

</html>
