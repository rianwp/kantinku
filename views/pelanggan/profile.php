<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/pelanggan/profile.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Kantinku</title>
</head>
<body>
    <?php require 'components/pelanggan/navbar.php' ?>
    <?php 
    if (!isset($_SESSION['isLoggedIn_pelanggan'])){
      header('Location: /');
    } else{
      require 'process/connect.php';
      $id_pelanggan = $_SESSION['id_pelanggan'];
      $sqlprofile = "SELECT email_pelanggan, nama_pelanggan, foto_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
      $resultprofile = mysqli_query($conn, $sqlprofile);
      while($profile = mysqli_fetch_assoc($resultprofile)){
        $email = $profile['email_pelanggan'];
        $nama = $profile['nama_pelanggan'];
        $foto = $profile['foto_pelanggan'];
      }
    }
    ?>
    <div class="container my-5 mx-auto">
      <h1 class="text-center">Profile</h1>
      <div class="row py-5">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="mb-3 text-center">
            <label class="form-label">Foto Profile</label>
            <div class="wrapper-foto-profile mx-auto rounded-circle">
              <div class="button-foto-profile mx-auto rounded-circle">
                <div>
                  <label for="file-foto" class="btn btn-success text-white rounded">Edit</label>
                  <input class="file" type="file" name="file-foto" id="file-foto" onchange="editFoto()" />
                </div>
              </div>
              <img src="data:image/jpeg;base64,<?= base64_encode($foto) ?>" class="rounded-circle foto-profile-utama">
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-6 col-12">
          <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama</label>
            <div class="row">
              <div class="col-lg-11 col-md-9 mb-3">
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
              <div class="col-lg-11 col-md-9 mb-3">
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
              <div class="col-lg-11 col-md-9 mb-3">
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
            <div class="mb-1">
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
            <div class="mb-1">
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
            <div class="mb-1">
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
    <?php require 'components/pelanggan/footer.php' ?>
    <script src="script/pelanggan/profile.js"></script>
</body>
</html>