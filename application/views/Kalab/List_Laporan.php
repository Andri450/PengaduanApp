<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kepala Lab - List Laporan</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
	<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>

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
			<h2>Manajemen Data Laporan</h2>

			<form class="form-group" action="<?= base_url('Kalab/List_Laporan') ?>" method="post">
			<h5 class="pb-2">Status Data Laporan</h5>
			<div class="row">
				<div class="col-6">
				<select name="filter" class="form-control">
					<?php if($fil == 'all'){ ?>
					<option>Semua</option>
					<option>Selesai</option>
					<option>Diproses</option>
					<option>Divalidasi</option>
					<?php } elseif($fil == 'proses') { ?>
					<option>Diproses</option>
					<option>Semua</option>
					<option>Selesai</option>
					<option>Divalidasi</option>
					<?php } elseif($fil == 'end') { ?>
					<option>Selesai</option>
					<option>Diproses</option>
					<option>Semua</option>
					<option>Divalidasi</option>
					<?php } elseif($fil == 'valid') { ?>
					<option>Divalidasi</option>
					<option>Selesai</option>
					<option>Diproses</option>
					<option>Semua</option>
					<?php } ?>
				</select>
				<input type="submit" value="Filter Status" class="btn btn-primary btn-login-custom">
				</div>
			</div>	
			</form>
			<hr class=" mt-5 pb-4">

			<h5 class="pb-2">Periode Tanggal Laporan</h5>

			<table border="0" class="form-group">
				<tbody>
					<tr>
						<td>Mulai Tanggal : </td>
						<td><input type="text" id="min" name="min" class="form-control"></td>
					</tr>
					<tr>
						<td>Sampai Tanggal :&nbsp;</td>
						<td><input type="text" id="max" name="max" class="form-control"></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-striped display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Properti</th>
						<th>Nama Teknisi</th>
						<th>Nama Pelapor</th>
						<th>NPM Pelapor</th>
						<th>Masalah</th>
						<th>Tanggal</th>
						<th>Foto Bukti</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="show_data">
					<?php 
			$i = 0;
			foreach ($laporan as $row){ 
			$i++;
			?>
					<tr <?= ($row->status_laporan == 'divalidasi') ? "class='ok'" : ""; ?>>
						<td><?php echo $i; ?></td>
						<td><?php echo $row->nama_prop; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo $row->nama_pelapor; ?></td>
						<td><?php echo $row->npm; ?></td>
						<td><?php echo $row->masalah; ?></td>
						<td><?php echo date('Y-m-d', strtotime($row->tgl_laporan)); ?></td>
						<td><img src="<?= base_url('assets/foto/'. $row->foto_bukti) ?>" alt="" srcset=""></td>
						<td><?php echo $row->status_laporan; ?></td>
						<td><?php if($row->status_laporan == 'selesai'){ ?> <a href="<?= base_url('Kalab/sys_validasi/'.$row->id_laporan) ?>">Validasi Laporan</a> <?php } ?> </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Page Content -->
	</div>

	<input type="hidden" id="nama_kaleb" value="<?= $this->session->userdata('nama_user') ?>">
	<input type="hidden" id="nip_kaleb" value="<?= $this->session->userdata('nip_user') ?>">
	<input type="hidden" id="nama_rt" value="<?= $rtu[0]->nama ?>">
	<input type="hidden" id="nip_rt" value="<?= $rtu[0]->NIP ?>">
	<input type="hidden" id="nama_lab" value="<?= $this->session->userdata('nama_lab') ?>">

</body>

</html>

<script>
	var minDate, maxDate;

	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function (settings, data, dataIndex) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date(data[6]);

			if (
				(min === null && max === null) ||
				(min === null && date <= max) ||
				(min <= date && max === null) ||
				(min <= date && date <= max)
			) {
				return true;
			}
			return false;
		}
	);

	$(document).ready(function () {
		// Create date inputs
		minDate = new DateTime($('#min'), {
			format: 'MMMM Do YYYY'
		});
		maxDate = new DateTime($('#max'), {
			format: 'MMMM Do YYYY'
		});

		var temp = "";
		var tempFooter = "";

		$.get('http://localhost/PengaduanApp/assets/template/surat_kerusakan.html', function (data) {
			temp = data;
		});

		$.get('http://localhost/PengaduanApp/assets/template/footer_surat_kerusakan.html', function (data) {
			tempFooter = data;
		});

		// DataTables initialisation
		var table = $('#example').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'print',
				title: '',
				exportOptions: {
					stripHtml: false,
					rows: '.ok',
					columns: [0, 1, 2, 3, 4, 5, 6, 8]
				},
				customize: function ( win ) {

					const date = new Date();

					let day = date.getDate();
					let month = date.getMonth() + 1;
					let year = date.getFullYear();
						
					let currentDate = `${day}-${month}-${year}`;

					var res = temp.replace("<span id='tgl'></span>", "<span id='tgl'>" + currentDate + "</span>");

					var res = res.replace("<span id='nama_rt'></span>", "<span id='nama_rt'>"+ $('#nama_rt').val() +"</span>");

					var res = res.replace("<span id='nip_rt'></span>", "<span id='nip_rt'>"+ $('#nip_rt').val() +"</span>");

					var res = res.replace("<span id='nama_kaleb'></span>", "<span id='nama_kaleb'>"+ $('#nama_kaleb').val() +"</span>");

					var res = res.replace("<span id='nip_kaleb'></span>", "<span id='nip_kaleb'>"+ $('#nip_kaleb').val() +"</span>");

					var res = res.replace("<span id='nama_lab'></span>", "<span id='nama_lab'>"+ $('#nama_lab').val() +"</span>");

					$(win.document.body)
						.css( 'font-size', '10pt' )
						.prepend(
							res
						);

					$(win.document.body).find( 'table' )
						.addClass( 'compact' )
						.css( 'font-size', 'inherit' );

					var tempFooters = tempFooter.replace("<span id='nama_kaleb'></span>", "<span id='nama_kaleb'>"+ $('#nama_kaleb').val() +"</span>");

					var tempFooters = tempFooters.replace("<span id='nip_kaleb'></span>", "<span id='nip_kaleb'>"+ $('#nip_kaleb').val() +"</span>");

					var tempFooters = tempFooters.replace("<span id='nama_lab'></span>", "<span id='nama_lab'>"+ $('#nama_lab').val() +"</span>");

					$(win.document.body)
						.css( 'font-size', '10pt' )
						.append(
							tempFooters
						);
						
				}
			}]
		});

		// Refilter the table
		$('#min, #max').on('change', function () {
			table.draw();
		});
	});

</script>
