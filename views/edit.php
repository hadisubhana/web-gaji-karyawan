<?php
    $kode = $_GET['kode'];
    $pdo = (new Database)->conn();

    $query = "SELECT k.kode_karyawan AS nik, k.nama_karyawan AS nama, k.alamat, k.no_rekening, k.jabatan, g.total_gaji as gaji FROM tbl_karyawan k LEFT JOIN tbl_gaji g ON k.kode_karyawan = g.kode_karyawan WHERE k.kode_karyawan = ?";
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
                        <h3 class="text-left font-weight-light my-4">Edit Data Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNik" name="nik" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->nik; ?>" readonly />
                            <label for="inputNik">NIK</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputNamaKaryawan" name="nama" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->nama; ?>" />
                            <label for="inputNamaKaryawan">Nama Karyawan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="inputAlamat" name="alamat" autocomplete="off" placeholder=" " /><?php echo $row->alamat; ?></textarea>
                            <label for="inputAlamat">Alamat</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inptNoRekening" name="rekening" autocomplete="off" type="text" placeholder=" " value="<?php echo $row->no_rekening; ?>" />
                            <label for="inptNoRekening">No. Rekening</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="posisi">
                                <option value="" hidden>-- Choise One --</option>
                                <option value="direktur" <?php echo (strtolower($row->jabatan) == 'direktur') ? 'selected' : ''; ?>>Direktur</option>
                                <option value="manager" <?php echo (strtolower($row->jabatan) == 'manager') ? 'selected' : ''; ?>>Manager</option>
                                <option value="supervisor" <?php echo (strtolower($row->jabatan) == 'supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                                <option value="operator" <?php echo (strtolower($row->jabatan) == 'operator') ? 'selected' : ''; ?>>Operator</option>
                            </select>
                            <label for="inputPosisi">Posisi</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="btn btn-success" style="min-width: 10em" href="index.php">Batal</a>
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
    $alamat = $_POST['alamat'];
    $rekening = $_POST['rekening'];
    $jabatan = $_POST['posisi'];

    $stmt2 = $pdo->prepare("UPDATE tbl_karyawan SET nama_karyawan = ?, alamat = ?, no_rekening = ?, jabatan = ? WHERE kode_karyawan = ?");
    $stmt2->execute([$nama, $alamat, $rekening, $jabatan, $kode]);

    if($stmt2->rowCount() > 0) echo "<script>window.location='index.php';</script>";
}
?>