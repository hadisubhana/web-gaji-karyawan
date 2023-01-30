<?php

    include "core/Helper.php";
    include "core/Database.php";
    
    if(@$_SESSION['user']) header('Location: index.php');

    if($_POST) {
        if(!empty(post()->fullname) && !empty(post()->nik) && !empty(post()->email) && !empty(post()->password) && !empty(post()->confirmPassword)) {
            if(post()->password == post()->confirmPassword) {
                $pdo = (new Database)->conn();

                $stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE email = ?");
                $stmt->execute([post()->email]);

                if($stmt->rowCount() > 0) {alert('Email sudah digunakan!'); }
                else {
                    // $stmt2 = $pdo->prepare("INSERT")
                    $stmt2 = $pdo->prepare("SELECT * FROM tbl_karyawan WHERE kode_karyawan = ?");
                    $stmt2->execute([post()->nik]);

                    if($stmt2->rowCount() > 0) {
                        $stmt3 = $pdo->prepare("INSERT INTO tbl_user VALUES(?, ?, ?, ?, ?)");
                        $stmt3->execute([NULL, post()->email, post()->password, post()->fullname, "karyawan"]);

                        $stmt4 = $pdo->prepare("UPDATE tbl_gaji SET user_id = ? WHERE kode_karyawan = ?");
                        $stmt4->execute([$pdo->lastInsertId('user_id'), post()->nik]);

                        if($stmt3->rowCount() > 0) {
                            alert('Register berhasil');
                            header('Location: login.php');
                        } else {
                            alert('Gagal register');
                        }
                    } else { alert('NIK tidak ditemukan!'); }
                }
            } else {
                alert('Password dan Confirm password tidak sama!');
            }
        } else {
            alert('Field tidak boleh kosong!');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - App Karyawan</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style="margin-bottom: 2em;">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputFirstName" type="text" name="fullname" placeholder="Enter your first name" />
                                                <label for="inputFirstName">Fullname</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputNik" type="text" name="nik" placeholder="Enter your NIK" />
                                                <label for="inputNik">Nomor Induk Karyawan</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="confirmPassword" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Create Account" /></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            // STATUS INTERNET
            function showStatus(online) {

                if (!online) {
                    // window.removeEventListener('load');
                    window.location = 'views/template/401.html';
                }
            }

            window.addEventListener('load', () => {
                navigator.onLine ? showStatus(true) : showStatus(false);
            });
        </script>
    </body>
</html>
