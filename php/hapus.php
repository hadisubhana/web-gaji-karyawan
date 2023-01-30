<?php


include "../core/Database.php";

if ($_GET) {

    $kode = $_GET['kode'];
    $pdo = (new Database)->conn();

    if ($_GET['action'] == 'data-karyawan') {

        $stmt = $pdo->prepare("DELETE FROM tbl_karyawan WHERE kode_karyawan = ?");
        $stmt->execute([$kode]);

        $stmt2 = $pdo->prepare("DELETE FROM tbl_gaji WHERE kode_karyawan = ?");
        $stmt2->execute([$kode]);

        if ($stmt->rowCount() > 0 && $stmt2->rowCount() > 0) header('Location: ../index.php');
    } else if($_GET['action'] == 'data-gaji'){

        $stmt3 = $pdo->prepare("DELETE FROM tbl_gaji WHERE kode_karyawan = ?");
        $stmt3->execute([$kode]);
        
        if ($stmt3->rowCount()) header('Location: ../index.php?view=dataGaji');
    }
}
