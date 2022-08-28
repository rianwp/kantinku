<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/font.css' ?></style>
    <title>Profile</title>
</head>
<body>
    <?php require 'components/kios/navbar.php' ?>
    <?php require 'components/kios/sidebar.php' ?>
    <?php
    $id_kios = $_SESSION['id_kios'];
    $sqlprofile = "SELECT email_kios, nama_kios FROM kios WHERE id_kios='$id_kios'";
    $resultprofile = mysqli_query($conn, $sqlprofile);
    while($profile = mysqli_fetch_assoc($resultprofile)){
      $email = $profile['email_kios'];
      $nama = $profile['nama_kios'];
    }
    ?>
    <main>
        <div class="container-fluid mx-auto p-3">
          <h1 class="fw-bold">Profile</h1>
          <div class="row py-3">
            <div class="col-12">
              <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama</label>
                <div class="row">
                  <div class="col-lg-11 mb-3">
                    <input type="text" class="form-control" id="nama_pelanggan" value="<?= $nama ?>" disabled>
                  </div>
                  <div class="col-1">
                    <button class="btn btn-success text-white rounded" data-bs-toggle="modal" data-bs-target="#edit-nama">Edit</button>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="email_pelanggan" class="form-label">Email</label>
                <div class="row">
                  <div class="col-lg-11 mb-3">
                    <input type="email" class="form-control" id="email_pelanggan" value="<?= $email ?>" disabled>
                  </div>
                  <div class="col-1">
                    <button class="btn btn-success text-white rounded" data-bs-toggle="modal" data-bs-target="#edit-email">Edit</button>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="password_pelanggan" class="form-label">Password</label>
                <div class="row">
                  <div class="col-lg-11 mb-3">
                    <input type="password" class="form-control" id="password_pelanggan" value="****" disabled>
                  </div>
                  <div class="col-1">
                    <button class="btn btn-success text-white rounded" data-bs-toggle="modal" data-bs-target="#edit-password">Edit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Nama-->
        <div class="modal fade" id="edit-nama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Nama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-1">
                  <label for="nama" class="form-label">Nama Baru</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukan Nama...">
                  <p id="nama-error" class="text-danger m-0"></p>
                </div>
                <div>
                  <label for="konfirmasi-nama" class="form-label">Password</label>
                  <input type="password" class="form-control" id="konfirmasi-nama" placeholder="Masukan Password Untuk Konfirmasi...">
                  <p id="konfirmasi-error" class="text-danger m-0"></p>
                </div>
              </div>
              <div class="modal-footer">
                <button onclick="editNama()" class="btn btn-primary">Edit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Email-->
        <div class="modal fade" id="edit-email" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-1">
                  <label for="email" class="form-label">Email Baru</label>
                  <input type="email" class="form-control" id="email" placeholder="Masukan Email...">
                  <p id="email-error" class="text-danger m-0"></p>
                </div>
                <div>
                  <label for="konfirmasi-email" class="form-label">Password</label>
                  <input type="password" class="form-control" id="konfirmasi-email" placeholder="Masukan Password Untuk Konfirmasi...">
                  <p id="konfirmasi-error" class="text-danger m-0"></p>
                </div>
              </div>
              <div class="modal-footer">
                <button onclick="editEmail()" class="btn btn-primary">Edit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Password-->
        <div class="modal fade" id="edit-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-1">
                  <label for="password" class="form-label">Password Baru</label>
                  <input type="password" class="form-control" id="password" placeholder="Masukan Password...">
                  <p id="password-error" class="text-danger m-0"></p>
                </div>
                <div>
                  <label for="konfirmasi-password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="konfirmasi-password" placeholder="Masukan Password Untuk Konfirmasi...">
                  <p id="konfirmasi-error" class="text-danger m-0"></p>
                </div>
              </div>
              <div class="modal-footer">
                <button onclick="editPassword()" class="btn btn-primary">Edit</button>
              </div>
            </div>
          </div>
        </div>
    </main>
    <script src="script/kios/profile.js"></script>
</body>
</html>