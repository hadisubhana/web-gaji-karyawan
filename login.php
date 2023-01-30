<?php

    include "core/Helper.php";
    include "core/Database.php";
    
    if(@$_SESSION['user']) header('Location: index.php');

    if($_POST) {
        // var_dump($_POST);

        if(!empty(post()->email) && !empty(post()->password)) {
            $pdo = (new Database)->conn();

            $stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE email = ? AND password = ?");
            $stmt->execute([post()->email, post()->password]);

            if($stmt->rowCount() > 0) {
                $row = $stmt->fetchObject();

                $stmt2 = $pdo->prepare("SELECT k.* FROM tbl_gaji g, tbl_karyawan k WHERE g.user_id = ?");
                $stmt2->execute([$row->user_id]);

                $row2 = $stmt2->fetchObject();

                $user = [
                    'user_id' => $row->user_id,
                    'email' => $row->email,
                    'password' => $row->password,
                    'fullname' => $row->fullname,
                    'level' => $row->level,
                ];

                $bio = [
                    'nik' => $row2->kode_karyawan,
                    'nama' => $row2->nama_karyawan,
                    'alamat' => $row2->alamat,
                    'rekening' => $row2->no_rekening,
                    'jabatan' => $row2->jabatan
                ];

                
                $_SESSION['biodata'] = $bio;
                $_SESSION['user'] = $user;


                header('Location: index.php');
            }
            else alert('Data belum ada. Jika belum punya akun, silahkan daftar akun terlebih dahulu');
        } else {
            alert("Email / Password tidak boleh kosong!");
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
        <title>Login - APP Karyawan</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input class="btn btn-primary" type="submit" value="Login" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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