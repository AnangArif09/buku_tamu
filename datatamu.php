<?php include "header.php";?>
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Tamu Hari Ini [<?=date('d-m-y')?>]</h6>
    </div>
    <div class="card-body">
        <div class="float-left">
            <a href="admin.php" class="btn btn-danger mb-3"><i class="fa fa-backward"></i> Kembali</a>
        </div>
        <div class="float-right">
            <a href="rekap.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Tamu </a>
        </div>
        <div class="text-center mt-5">
            <h1 class="h4 text-gray-900 mb-4">Data Tamu</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Tamu</th>
                        <th>No. Handphone</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tgl = date('Y-m-d');
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tyaya where tanggal like '%$tgl%' order by id desc");
                    $no = 1;
                    while($data = mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['nope'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['tujuan'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "footer.php"?>
