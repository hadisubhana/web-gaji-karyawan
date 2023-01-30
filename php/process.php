<?php

include "../core/Database.php";

class Status {
    const OK = "ok";
    const NO = "no";
    const EXIST = "exist";
}

class Enum {
    const TDK = "tambah-data-karyawan";
    const TEDK = "tambah-edit-data-karyawan";
}

if($_GET) {

    $pdo = (new Database)->conn();

    if($_GET['name'] == Enum::TDK) {

        $nik      = $_POST["nik"];
        $nama     = $_POST["nama"];
        $alamat   = $_POST["alamat"];
        $rekening = $_POST["rekening"];
        $posisi   = $_POST["posisi"];
        $status   = "";
        $message  = "";

        if(!empty($nik) && !empty($nama) && !empty($alamat) && !empty($rekening) && !empty($posisi)) {

            $stmt5 = $pdo->prepare("SELECT * FROM tbl_karyawan WHERE kode_karyawan = ?");
            $stmt5->execute([$nik]);

            if($stmt5->rowCount() == 0) {
                $stmt = $pdo->prepare("INSERT INTO tbl_karyawan VALUES (:nik, :nama, :alamat, :rekening, :jabatan)");
                $stmt->bindParam(":nik", $nik, PDO::PARAM_INT);
                $stmt->bindParam(":nama", $nama, PDO::PARAM_STR);
                $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
                $stmt->bindParam(":rekening", $rekening, PDO::PARAM_STR);
                $stmt->bindParam(":jabatan", $posisi, PDO::PARAM_STR);
                $stmt->execute();

                $stmt2 = $pdo->prepare("INSERT INTO tbl_gaji VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt2->execute([NULL, NULL, $nik, NULL, NULL, NULL, NULL, NULL]);


                if($stmt->rowCount() > 0 && $stmt2->rowCount() > 0) {
                    $status = Status::OK;
                    $message = "Submitted successfully";
                }
            } else {
                $status = Status::EXIST;
                $message = "Data Sudah Ada!";
            }
        } else {
            $status = Status::NO;
            $message = "Field tidak boleh kosong!";
        }
        echo json_encode(['status' => $status, 'message' => $message]);
    }

    else if($_GET['name'] == Enum::TEDK) {
        $nik              = $_POST['nik'];
        $jam_lembur       = $_POST['jam_lembur'];
        $uang_lembur      = $_POST['uang_lembur'];
        $gaji             = $_POST['gaji'];
        $tanggal_transfer = $_POST['tanggal_transfer'];
        $jam_transfer     = $_POST['jam_transfer'];
        

        if(!empty($nik)) {

            $stmt4 = $pdo->prepare("SELECT * FROM tbl_gaji WHERE kode_karyawan = ?");
            $stmt4->execute([$nik]);

            if($stmt4->rowCount() > 0) {
                $status = Status::EXIST;
                $message = "Data Sudah Ada!";
            } else {
                
                $stmt6 = $pdo->prepare("SELECT * FROM tbl_karyawan WHERE kode_karyawan = ?");
                $stmt6->execute([$nik]);

                if($stmt6->rowCount() > 0) {
                    $stmt3 = $pdo->prepare("INSERT INTO tbl_gaji VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt3->execute([NULL, NULL, $nik, $jam_lembur, $uang_lembur, $gaji, $tanggal_transfer, $jam_transfer]);
                    
                    if($stmt3->rowCount() > 0) {
                        $status = Status::OK;
                        $message = "Submitted successfully";
                    }
                } else {
                    $status = Status::NO;
                    $message = "Data Karyawan Tidak Ada!";
                }
            }
        } else {
            $status = Status::NO;
            $message = "NIK tidak boleh kosong!";
        }
        echo json_encode(['status' => $status, 'message' => $message]);
    }
}