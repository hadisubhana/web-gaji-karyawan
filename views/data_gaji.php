<h1 class="mt-4">Data Karyawan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-chart-bar me-1"></i>
        Data gaji Karyawan
    </div>
    <style>
        td {
            word-break: break-all;
            word-wrap: break-word;
        }
    </style>
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
                    <th>No Rekening</th>
                    <th>Uang Lembur</th>
                    <th>Gaji</th>
                    <th>Jam Lembur</th>
                    <th>Tanggal Transfer</th>
                    <th>Jam Transfer</th>
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
                    <th>No Rekening</th>
                    <th>Uang Lembur</th>
                    <th>Gaji</th>
                    <th>Jam Lembur</th>
                    <th>Tanggal Transfer</th>
                    <th>Jam Transfer</th>
                    <?php if($_SESSION['user']['level'] == 'admin'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $pdo = (new Database)->conn();
                $query = "SELECT k.kode_karyawan AS kode, k.nama_karyawan AS nama, k.no_rekening AS rekening, g.uang_lembur, g.jam_lembur, g.total_gaji AS gaji, g.tgl_transfer, g.jam_transfer FROM tbl_karyawan k INNER JOIN tbl_gaji g ON k.kode_karyawan = g.kode_karyawan";
                $stmt = $pdo->query($query);

                $no = 0;
                while ($row = $stmt->fetchObject()) :
                ?>
                    <tr>
                        <td><?php echo $no = $no + 1; ?></td>
                        <td><?php echo $row->kode; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td><?php echo $row->rekening; ?></td>
                        <td><?php echo rupiah($row->uang_lembur); ?></td>
                        <td><?php echo rupiah($row->gaji); ?></td>
                        <td><?php echo $row->jam_lembur; ?></td>
                        <td><?php echo $row->tgl_transfer; ?></td>
                        <td><?php echo date("H:i", strtotime($row->jam_transfer)); ?></td>
                        <?php if($_SESSION['user']['level'] == 'admin'): ?>
                        <td>
                            <a class="btn btn-warning" href="index.php?view=edit-gaji&kode=<?php echo $row->kode; ?>">Edit</a>
                            <a class="btn btn-danger" onclick="" href="php/hapus.php?action=data-gaji&kode=<?php echo $row->kode; ?>">Hapus</a>
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
            <form name="tambah-edit-data-karyawan" id="form1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gaji Karyawan</h5>
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
                                        <input class="form-control" id="inputUangLembur" name="uang_lembur" autocomplete="off" type="text" placeholder=" " minlength="1" />
                                        <label for="inputUangLembur">Uang Lembur</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputGaji" name="gaji" autocomplete="off" type="text" placeholder=" " minlength="1" />
                                        <label for="inputGaji">Gaji</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputJamLembur" name="jam_lembur" autocomplete="off" type="number" placeholder=" " minlength="1" />
                                        <label for="inputJamLembur">Jam Lembur</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputTanggalTransfer" name="tanggal_transfer" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" type="date" placeholder=" " minlength="1" />
                                        <label for="inputTanggalTransfer">Tanggal Transfer</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputJamTransfer" name="jam_transfer" value="<?php echo date('H:i'); ?>" autocomplete="off" type="time" placeholder=" " minlength="1" />
                                        <label for="inputJamTransfer">Jam Transfer</label>
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