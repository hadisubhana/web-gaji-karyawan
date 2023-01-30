<h1 class="mt-4">Data Karyawan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<?php if($_SESSION['user']['level'] == 'admin'): ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Direktur</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Manager</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Supervisor</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Operator</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-tachometer-alt me-1"></i>
        Data Karyawan
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <?php if($_SESSION['user']['level'] == 'admin'): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btn-tambah-data-karyawan" style="margin: 0 0 1em 0;">Tambah Data</button>
        <?php endif; ?>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>No Rekening</th>
                    <th>Gaji</th>
                    <th>Posisi</th>
                    <?php if($_SESSION['user']['level'] == 'admin'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>No Rekening</th>
                    <th>Gaji</th>
                    <th>Posisi</th>
                    <?php if($_SESSION['user']['level'] == 'admin'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $pdo = (new Database)->conn();
                $query = "SELECT k.*, g.total_gaji as gaji FROM tbl_karyawan k LEFT JOIN tbl_gaji g ON k.kode_karyawan = g.kode_karyawan";
                $stmt = $pdo->query($query);

                $no = 0;
                while ($row = $stmt->fetchObject()) :
                ?>
                    <tr>
                        <td><?php echo $no = $no + 1; ?></td>
                        <td><?php echo $row->kode_karyawan; ?></td>
                        <td><?php echo $row->nama_karyawan; ?></td>
                        <td><?php echo $row->alamat; ?></td>
                        <td><?php echo $row->no_rekening; ?></td>
                        <td><?php echo rupiah($row->gaji); ?></td>
                        <td><?php echo $row->jabatan; ?></td>
                        <?php if($_SESSION['user']['level'] == 'admin'): ?>
                        <td>
                            <a class="btn btn-warning" href="index.php?view=edit&action=data-karyawan&kode=<?php echo $row->kode_karyawan; ?>">Edit</a>
                            <a class="btn btn-danger" onclick="" href="php/hapus.php?action=data-karyawan&kode=<?php echo $row->kode_karyawan; ?>">Hapus</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="tambah-data-karyawan" id="form1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="card-body">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputNik" name="nik" autocomplete="off" type="text" placeholder=" " minlength="1" maxlength="11" />
                                        <label for="inputNik">NIK</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputNamaKaryawan" name="nama" autocomplete="off" type="text" placeholder=" " minlength="1" maxlength="50" />
                                        <label for="inputNamaKaryawan">Nama Karyawan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="inputAlamat" name="alamat" autocomplete="off" placeholder=" " minlength="1" /></textarea>
                                        <label for="inputAlamat">Alamat</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inptNoRekening" name="rekening" autocomplete="off" type="text" placeholder=" " minlength="1" />
                                        <label for="inptNoRekening">No. Rekening</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="posisi">
                                            <option value="" hidden>-- Choise One --</option>
                                            <option value="direktur">Direktur</option>
                                            <option value="manager">Manager</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="operator">Operator</option>
                                        </select>
                                        <label for="inputPosisi">Posisi</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" value="Close"/>
                        <input type="submit" class="btn btn-primary" onclick="insert(getValue(this))" value="Save changes"/>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>