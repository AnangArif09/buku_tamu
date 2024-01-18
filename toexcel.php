<?php
include "koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Tamu.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
    <thead>
        <tr>
            <th colspan="6">Rekap Data Tamu</th>
        </tr>
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
        $tgl1 = isset($_POST['tanggal1']) ? $_POST['tanggal1'] : '';
        $tgl2 = isset($_POST['tanggal2']) ? $_POST['tanggal2'] : '';
        
        $tampil = mysqli_query($koneksi, "SELECT * FROM tyaya where tanggal BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal ASC");
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
