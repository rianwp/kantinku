<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/kios/menu.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Menu</title>
</head>
<body>
    <?php require 'components/kios/navbar.php' ?>
    <?php require 'components/kios/sidebar.php' ?>
    <main>
      <div class="container-fluid mx-auto p-3">
        <h1 class="fw-bold">Menu</h1>
        <div class="row py-3">
          <div class="col-12">
            <div class="card text-black bg-light mb-3 card-height shadow border-0 overflow-auto">
              <div class="card-header">
                <span><i class="me-2 bi bi-table"></i></span>
                <span class="fw-bold">Menu</span>
              </div>
              <div class="card-body p-0">
                <div class="card-text fs-6 fw-bold">
                  <table class="table m-0 text-center">
                    <thead class="table-dark">
                      <tr>
                        <th class="thead-font" scope="col">No</th>
                        <th class="thead-font" scope="col">Nama Menu</th>
                        <th class="thead-font" scope="col">Harga</th>
                        <th class="thead-font" scope="col">Foto</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require 'process/config.php';
                        $count = 0;
                        $id_kios = $_SESSION['id_kios'];
                        $sqlmenu = "SELECT * FROM menu WHERE id_kios='$id_kios'";;
                        $resultmenu = mysqli_query($conn, $sqlmenu);
                        foreach($resultmenu as $menu){
                          $count += 1;
                      ?>
                      <tr>
                        <td class="align-middle fw-normal"><?= $count ?></td>
                        <td class="align-middle fw-normal"><?= $menu['nama_menu'] ?></td>
                        <td class="align-middle fw-normal">Rp<?= $menu['harga_menu'] ?></td>
                        <td class="align-middle fw-normal">
                          <img src="data:image/jpeg;base64,<?= base64_encode($menu['gambar_menu']) ?>" class="rounded foto-menu">
                        </td>
                        <td class="align-middle fw-normal">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-menu-<?= $menu['id_menu'] ?>"><i class="bi bi-pencil-fill"></i></button>
                            <div class="modal fade" id="edit-menu-<?= $menu['id_menu'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="mb-1">
                                      <label for="nama-<?= $menu['id_menu'] ?>" class="form-label">Nama Menu</label>
                                      <input type="text" class="form-control" id="nama-<?= $menu['id_menu'] ?>" placeholder="Masukan Nama...">
                                      <p id="nama-error" class="text-danger m-0"></p>
                                    </div>
                                    <div class="mb-1">
                                      <label for="harga-<?= $menu['id_menu'] ?>" class="form-label">Harga Menu</label>
                                      <input type="number" class="form-control" id="harga-<?= $menu['id_menu'] ?>" placeholder="Masukan Harga...">
                                      <p id="harga-error" class="text-danger m-0"></p>
                                    </div>
                                    <div class="mb-1">
                                      <label for="harga-<?= $menu['id_menu'] ?>" class="form-label">Harga Menu</label>
                                      <input type="number" class="form-control" id="harga-<?= $menu['id_menu'] ?>" placeholder="Masukan Harga...">
                                      <p id="harga-error" class="text-danger m-0"></p>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button onclick="editMenu()" class="btn btn-primary">Edit</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button type="button" onclick="deletePesanan()" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>