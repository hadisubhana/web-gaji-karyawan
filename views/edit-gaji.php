<?php
    $kode = @$_GET['kode'];
    $pdo = (new Database)->conn();

    $query = "SELECT k.kode_karyawan AS kode, k.nama_karyawan AS nama, k.no_rekening AS rekening, g.uang_lembur, g.jam_lembur, g.total_gaji AS gaji, g.tgl_transfer, g.jam_transfer FROM tbl_karyawan k INNER JOIN tbl_gaji g ON k.kode_karyawan = g.kode_karyawan WHERE k.kode_karyawan = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$kode]);

    $row = $stmt->fetchObject();

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-left font-weight-light my-4">Edit Data Gaji Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNik" name="nik" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->kode; ?>" readonly />
                            <label for="inputNik">NIK</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNamaKaryawan" name="nama" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->nama; ?>" />
                            <label for="inputNamaKaryawan">Nama Karyawan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inpitNoRekening" name="rekening" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->rekening; ?>" />
                            <label for="inpitNoRekening">No. Rekening</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputGaji" name="gaji" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->gaji; ?>"/>
                            <label for="inputGaji">Gaji</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inptUangLembur" name="uang_lembur" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->uang_lembur; ?>" />
                            <label for="inptUangLembur">Uang Lembur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputJamLembur" name="jam_lembur" autocomplete="off" type="number" placeholder=" " value="<?php echo $row->jam_lembur; ?>" />
                            <label for="inputJamLembur">Jam Lembur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputTanggalTransfer" name="tanggal_transfer" autocomplete="off" type="date" placeholder=" " value="<?php echo $row->tgl_transfer; ?>" />
                            <label for="inputTanggalTransfer">Tanggal Transfer</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputJamTransfer" name="jam_transfer" autocomplete="off" type="time" placeholder=" " value="<?php echo $row->jam_transfer; ?>" />
                            <label for="inputJamTransfer">Jam Transfer</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="btn btn-success" style="min-width: 10em" href="index.php?view=dataGaji">Batal</a>
                            <input type="submit" class="btn btn-primary" style="min-width: 10em" value="Update">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if($_POST) {
    $kode = $_POST['nik'];
    $nama = $_POST['nama'];
    $rekening = $_POST['rekening'];
    $uang_lembur = $_POST['uang_lembur'];
    $gaji = $_POST['gaji'];
    $jam_lembur = $_POST['jam_lembur'];
    $tanggal_transfer = $_POST['tanggal_transfer'];
    $jam_transfer = $_POST['jam_transfer'];

    $stmt2 = $pdo->prepare("UPDATE tbl_karyawan SET nama_karyawan = ?, no_rekening = ? WHERE kode_karyawan = ?");
    $stmt2->execute([$nama, $rekening, $kode]);

    $stmt3 = $pdo->prepare("UPDATE tbl_gaji SET jam_lembur = ?, uang_lembur = ?, total_gaji = ?, tgl_transfer = ?, jam_transfer = ? WHERE kode_karyawan = ?");
    $stmt3->execute([$jam_lembur, $uang_lembur, $gaji, $tanggal_transfer, $jam_transfer, $kode]);

    if(($stmt2->rowCount() > 0) || ($stmt3->rowCount() > 0)) echo "<script>window.location='index.php?view=dataGaji';</script>";
}
?>