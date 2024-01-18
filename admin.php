<!-- panggil header -->
<?php include"header.php"; ?>

<!-- simnpan input -->
<?php 
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['nama'], ENT_QUOTES));
    $nope = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['nope'], ENT_QUOTES));
    $alamat = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['alamat'], ENT_QUOTES));
    $tujuan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['tujuan'], ENT_QUOTES));

    // Pengecekan apakah file telah diunggah
    if (isset($_FILES['webcamImage']) && $_FILES['webcamImage']['error'] === UPLOAD_ERR_OK) {
        // Mengambil konten gambar
        $webcamimage_content = file_get_contents($_FILES['webcamImage']['tmp_name']);
        
        // Mengonversi konten gambar ke dalam format yang sesuai untuk kolom BLOB
        $webcamimage = mysqli_real_escape_string($koneksi, $webcamimage_content);
    } else {
        // Jika file tidak diunggah, dapatkan nilai default atau sesuaikan kebutuhan
        $webcamimage = null;
    }

    $simpan = mysqli_query($koneksi, "INSERT INTO tyaya VALUES ('', '$tgl', '$nama', '$nope', '$alamat', '$tujuan', '$webcamimage')");

    if($simpan) {
        echo "<script>alert('Simpan Data Sukses!!!');
            document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data Gagal!!!. Error: " . mysqli_error($koneksi) . "');</script>";
    }
}

?>

<div class="head text-center mt-3">
    <h2 class="text"> <br> </h2>
</div>

<div class="row mt-4">
<!-- col lg 7 -->
    <div class="col-lg-7 mb-1">
        <div class="card shadow bg-gradient-light">
            <div class="card-body">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-3" style="font-family: 'Abhaya Libre Extrabold', serif;">Data Tamu</h1>
                    </div>
                    <form class="user" method="post" action="" enctype="multipart/form-data">
                    <div class="gambar_form shadow-sm p-3 mb-5 rounded-bottom">
                        <i class="close" data-toggle="tooltip" title="Hapus gambar" id="hapus_gambar" style="color:grey;font-size:18px">&times;</i>
                        <span id="gambar_form" ><img id="avatar" src="assets/img/image_placeholder_2.png" style="width:75%" alt="..." class="rounded" data-toggle="tooltip" title="Klik Buka Kamera untuk berfoto !"></span>
                        <canvas id="c" width="320" height="240"></canvas>
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#myModal" id="buka_kamera"><i class="fa fa-camera"></i>&nbsp;Buka Kamera</button>		  
                        <div class="alert alert-danger" id="tooltip1" style="font-size:10px;padding: 2px;margin:0 auto;width:200px;text-align:center;">
                            Klik<strong> Buka Kamera</strong> untuk berfoto
                        </div>
                    </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Tamu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nope" placeholder="No. Handphone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan" required>
                            </div>

                            <button type="submit"  name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan dan Ambil Gambar</button>
                            <!-- <label type="submit" name="bsimpan" for="webcamImage" class="btn btn-primary btn-user btn-block">Simpan dan Ambil Gambar</label> -->
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="https://www.instagram.com/anangarif_h?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Pengadilan Negeri Pekanbaru | 2024 - <?=date('Y')?></a>
                    </div>
                </div>  
            </div>
    <!-- end card body -->
        </div>
    </div>
    <!-- end col lg 7 -->

    <!-- col lg 5 -->
    <div class="col-lg-5 mb-1" style="width: 30%;">
        <div class="card shadow bg-gradient-light">
            <!-- card body -->
            <div class="head text-center text-gray-900 mb-2 mt-3">
                <img src="assets/img/logo_pn.png" width="110">
                <h2 class="text" style="font-family: 'Abhaya Libre Extrabold', serif;">PENGADILAN NEGERI<br> PEKANBARU </h2>
            </div>
            <hr>
            <div class="col-lg-12 mb-4">
                <div class="card shadow">
            <!-- card body -->
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="h6 text-gray-900" style="font-family: 'Abhaya Libre Extrabold', serif;" >Statistik Tamu</h5>
                        </div>
                        <?php
                            $tgl_sekarang = date('Y-m-d');
                            $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                            $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
                            $sekarang = date('Y-m-d h:i:s');
                            $bulan_ini = date('m');

                            $tgl_sekarang = mysqli_fetch_array (mysqli_query(
                                $koneksi, "SELECT COUNT(*) FROM tyaya where tanggal like '%$tgl_sekarang%'")
                            );

                            $kemarin = mysqli_fetch_array (mysqli_query(
                                $koneksi, "SELECT COUNT(*) FROM tyaya where tanggal like '%$kemarin%'")
                            );

                            $seminggu = mysqli_fetch_array (mysqli_query(
                                $koneksi, "SELECT COUNT(*) FROM tyaya where tanggal BETWEEN '$seminggu' and '$sekarang'")
                            );

                            $sebulan = mysqli_fetch_array (mysqli_query(
                                $koneksi, "SELECT COUNT(*) FROM tyaya where month(tanggal)= '$bulan_ini'")
                            );

                            $keseluruhan = mysqli_fetch_array (mysqli_query(
                                $koneksi, "SELECT COUNT(*) FROM tyaya ")
                            );
                        ?>
                        <table class="table table-bordered" width="80%" cellspacing="-1">
                            <tr>
                                <th>Hari Ini</th>
                                <td><?=$tgl_sekarang[0]?></td>
                            </tr>
                            <tr>
                                <th>Kemarin</th>
                                <td><?=$kemarin[0]?></td>
                            </tr>
                            <tr>
                                <th>Minggu Ini</th>
                                <td><?=$seminggu[0]?></td>
                            </tr>
                            <tr>
                                <th>Bulan Ini</th>
                                <td><?=$sebulan[0]?></td>
                            </tr>
                            <tr>
                                <th>Keseluruhan</th>
                                <td><?=$keseluruhan[0]?></td>
                            </tr>
                        </table>
                    </div>
            <!-- end card body -->
                </div>
            </div>
            <!-- end card body -->
            <hr>
            <div class="text-center">
                <a href="datatamu.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Data Tamu Hari Ini </a>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<!-- Modal form kamera -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      <form class="temp_foto" action="">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Foto Selfie</h4>
          <button type="button" class="close" data-dismiss="modal" id="tutup_kamera">&times;</button>
        </div>
        
        <!-- Modal body -->
		
		<div class="modal-body" align="center">
          
		  
		    <div id="#my_camera" class="rounded"></div> 
          <br />
		  <button type="button" class="btn btn-secondary btn-sm" id="ambil_foto">Capture</button>
		  <button type="button" data-dismiss="modal" class="btn btn-success btn-sm" id="simpan_gambar">Simpan gambar</button>
		  <button type="button" class="btn btn-secondary btn-sm" id="batal_simpan">Batal</button>
		  
        </div>
		
        <!-- Modal footer -->
        <div class="modal-footer">
		  
        
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- panggil footer -->
<?php include"footer.php"; ?>       