<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/kios/auth.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Login</title>
</head>
<body>
  <div class="bg">
    <div class="row">
      <div class="card col-lg-4 col-10 mx-auto py-1 px-2">
        <div class="card-body">
          <h1 class="text-center">Login</h1>
          <div class="row mt-3">
            <form id="form-login" class="col-12">
              <div class="mb-1">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Masukan Email Anda...">
                <p id="email-error" class="text-danger m-0"></p>
              </div>
              <div class="mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Masukan Password Anda...">
                <p id="password-error" class="text-danger m-0"></p>
              </div>
              <div class="text-center mt-3">
                <a href="/signupkios" class="text-decoration-none text-success">Belum punya akun? Sign Up</a>
              </div>
              <div class="text-center mt-2">
                <button type="submit" name="submit" class="btn btn-success text-white rounded-pill px-4 py-2">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <a href="/dashboardkios" class="text-center mt-3 text-white text-shadow h5">KiosKantinku</a>
    </div>
  </div>
  <script src="script/kios/login.js"></script>
</body>
</html>