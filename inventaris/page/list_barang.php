<h2 class="text-center ">DAFTAR INVENTARIS</h2>

<form class="navbar-form navbar-right" role="search" method="get">
	<div class="form-group">
		<input type="hidden" name="p" value="list_barang">
		<input type="text" class="form-control" placeholder="Cari barang" name="cari">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<a href="?p=tambah_barang" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span></a>

<br><br>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>NO</th>
			<th>KODE INVENTARIS</th>
			<th>NAMA BARANG</th>
			<th>KONDISI</th>
			<th>JUMLAH</th>
			<th>RUANG</th>
			<th>TANGGAL REGISTER</th>
			<th>KETERANGAN</th>
			<th>OPSI</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		@$cari  = $_GET['cari'];
		$q_cari= "";
		if (!empty($cari)) {
			$q_cari .= "and nama like '%".$cari."%'";
		}
		$pembagian = 5;
		$page = isset($_GET['halaman']) ?  (INT)$_GET['halaman'] : 1;
		$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;


		$sql   = "SELECT * FROM inventaris left join ruang on ruang.id_ruang=inventaris.id_ruang where 1=1 $q_cari limit $mulai, $pembagian";
		$query = mysqli_query($koneksi, $sql);
		$cek   = mysqli_num_rows($query);
		// echo $cek;

		$sql_total = "SELECT * FROM inventaris";
		$q_total = mysqli_query($koneksi, $sql_total);
		$total   = mysqli_num_rows($q_total);

		$jumlahHalaman = ceil($total / $pembagian);

		if($cek > 0) {	
			$no = $mulai + 1;
			while($data = mysqli_fetch_array($query)){
				$tgl = $data['tanggal_register']
				?>
				<tr>
					<td><?= $no++?></td>
					<td><?= $data['kode_inventaris']?></td>
					<td><?= $data['nama']?></td>
					<td><?= $data['kondisi']?></td>
					<td><?= $data['jumlah']?></td>
					<td><?= $data['nama_ruang']?></td>
					<td><?= date("d-m-y", strtotime($tgl))?></td>
					<td><?= $data['keterangan']?></td>
					<td>
						<a href="?p=edit_barang&id_inventaris=<?= $data['id_inventaris']?>" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
						<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="page/hapus_barang.php?id_inventaris=<?= $data['id_inventaris']?>" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>
<div class="" style="float: left;"> JUMLAH : <?= $total ?></div>
<div class="" style="float: right;">
	<nav>
		<ul class="pagination">
			<li>
				<a href="?p=list_barang&halaman=<?= $page - 1 ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php 
			for ($i = 1; $i <=$jumlahHalaman; $i++) { 
				?>
				<li class="<? ($i == $_GET['halaman'] ? 'active' : '')?>">
					<a href="?p=list_barang&halaman=<?= $i ?>"><?= $i ?></a>
				</li>
				<?php 
			}
			?>
			<li>
				<a href="?p=list_barang&halaman=<?= $page + 1 ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>	
</div>