<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RT - List Laporan</title>
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
			<form class="form-group" action="<?= base_url('Rt/List_Laporan') ?>" method="post">
				<h5 class="pb-2">Filter Data Lab Laporan</h5>
				<div class="row">
					<div class="col-6">
						<select name="filter" class="form-control">
							<?php if($fil == 'all'){ ?>
								<option>Semua Lab</option>
								<?php foreach ($lab as $r){ ?>
									<option value="<?= $r->id ?>" ><?= $r->nama_lab ?></option>
								<?php } ?>
							<?php } else { ?>
								<option value="<?= $fil ?>" ><?= $fil_n ?></option>
								<?php foreach ($lab as $r){ ?>
									<?php if($fil != $r->id){ ?>
									<option value="<?= $r->id ?>" ><?= $r->nama_lab ?></option>
									<?php } ?>
								<?php } ?>
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
						<td>Mulai Tanggal :</td>
						<td><input type="text" id="min" name="min" class="form-control"></td>
					</tr>
					<tr>
						<td><br></td>
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
						<th>Nama Lab</th>
						<th>Nama Properti</th>
						<th>Nama Teknisi</th>
						<th>Nama Pelapor</th>
						<th>NPM Pelapor</th>
						<th>Masalah</th>
						<th>Tanggal</th>
						<th>Foto Bukti</th>
					</tr>
				</thead>
				<tbody id="show_data">
					<?php 
			$i = 0;
			foreach ($laporan as $row){ 
			$i++;
			?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row->nama_lab; ?></td>
						<td><?php echo $row->nama_prop; ?></td>
						<td><?php echo $row->nama; ?></td>
						<td><?php echo $row->nama_pelapor; ?></td>
						<td><?php echo $row->npm; ?></td>
						<td><?php echo $row->masalah; ?></td>
						<td><?php echo date('Y-m-d', strtotime($row->tgl_laporan)); ?></td>
						<td><img src="<?= base_url('assets/foto/'. $row->foto_bukti) ?>" alt="" srcset=""></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Page Content -->
	</div>
	
	<?php  
	if($kalab != null){
		foreach ($kalab as $row){ 
	?>
	<input type="hidden" id="nama_kaleb" value="<?= $row->nama ?>">
	<input type="hidden" id="nip_kaleb" value="<?= $row->NIP ?>">
	<input type="hidden" id="nama_user" value="<?= $this->session->userdata('nama_user') ?>">
	<input type="hidden" id="nip_user" value="<?= $this->session->userdata('nip_user') ?>">
	<?php 
		} 
	}
	?>

</body>

</html>

<?php if($fil != 'all'){ ?>
<script>
	var minDate, maxDate;

	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function (settings, data, dataIndex) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date(data[7]);

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
		var bases = $('#baseurl').value;
		var sel = false;
			
		$.get('http://localhost/PengaduanApp/assets/template/surat_berita_acara.html', function(data){
			temp = data;
		});	

		$.get('http://localhost/PengaduanApp/assets/template/footer_surat_berita_acara.html', function(data){
			tempFooter = data;
		});	

		// DataTables initialisation
		var table = $('#example').DataTable({
			dom: '<"toolbar">Bfrtip',
			buttons: [{
				extend: 'print',
				title: '',
				exportOptions: {
					stripHtml: false,
					columns: [0, 1, 2, 3, 4, 5, 6, 7]
					//specify which column you want to print
				},
				customize: function ( win ) {

					const date = new Date();
			
					let day = date.getDate();
					let month = date.getMonth() + 1;
					let year = date.getFullYear();
						
					let currentDate = `${day}-${month}-${year}`;

					var res = temp.replace("<span id='tgl'></span>", "<span id='tgl'>" + currentDate + "</span>");

					var res = res.replace("<span id='nama_user'></span>", "<span id='nama_user'>"+ $('#nama_user').val() +"</span>");

					var res = res.replace("<span id='nip_user'></span>", "<span id='nip_user'>"+ $('#nip_user').val() +"</span>");

					var res = res.replace("<span id='nama_kaleb'></span>", "<span id='nama_kaleb'>"+ $('#nama_kaleb').val() +"</span>");

					var res = res.replace("<span id='nip_kaleb'></span>", "<span id='nip_kaleb'>"+ $('#nip_kaleb').val() +"</span>");

                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            res
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );

						var tempFooters = tempFooter.replace("<span id='nama_rt'></span>", "<span id='nama_rt'>"+ $('#nama_user').val() +"</span>");

						var tempFooters = tempFooters.replace("<span id='nip_rt'></span>", "<span id='nip_rt'>"+ $('#nip_user').val() +"</span>");

						var tempFooters = tempFooters.replace("<span id='nama_kaleb'></span>", "<span id='nama_kaleb'>"+ $('#nama_kaleb').val() +"</span>");

						var tempFooters = tempFooters.replace("<span id='nip_kaleb'></span>", "<span id='nip_kaleb'>"+ $('#nip_kaleb').val() +"</span>");

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
<?php }else{ ?>
<script>
	var minDate, maxDate;

	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function (settings, data, dataIndex) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date(data[7]);

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
		var bases = $('#baseurl').value;
		var sel = false;
		
		if(sel == false){
			
			$.get('http://localhost/PengaduanApp/assets/template/surat_kerusakan.html', function(data){
				temp = data;
			});	
			
		}

		// DataTables initialisation
		var table = $('#example').DataTable();

		// Refilter the table
		$('#min, #max').on('change', function () {
			table.draw();
		});
	});

</script>
<?php } ?>