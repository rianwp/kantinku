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
              <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                  <span><i class="me-2 bi bi-table"></i></span>
                  <span class="fw-bold">Menu</span>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-menu">Tambah <i class="bi bi-plus"></i></button>
                <div class="modal fade text-start" id="tambah-menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="tambahnama" class="form-label">Nama Menu</label>
                          <input type="text" class="form-control" id="tambahnama" placeholder="Masukan Nama Menu...">
                          <p id="nama-error" class="text-danger"></p>
                        </div>
                        <div class="mb-3">
                          <label for="tambahharga" class="form-label">Harga Menu</label>
                          <input type="number" class="form-control" id="tambahharga" placeholder="Masukan Harga Menu...">
                          <p id="harga-error" class="text-danger"></p>
                        </div>
                        <div>
                          <label for="tambahfoto" class="form-label">Foto Menu</label>
                          <input type="file" class="form-control" id="tambahfoto">
                          <p id="foto-error" class="text-danger"></p>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button onclick="tambahMenu()" class="btn btn-primary">Tambah</button>
                      </div>
                    </div>
                  </div>
                </div>
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
                          <div class="wrapper-foto-menu rounded mx-auto">
                            <div class="button-foto-menu rounded">
                              <div>
                                <label for="foto-<?= $menu['id_menu'] ?>" class="btn btn-success text-white rounded">Edit</label>
                                <input class="file" type="file" id="foto-<?= $menu['id_menu'] ?>" onchange="editFoto('<?= $menu['id_menu'] ?>')"/>
                              </div>
                            </div>
                              <img src="data:image/jpeg;base64,<?= base64_encode($menu['foto_menu']) ?>" class="rounded foto-menu-edit">
                          </div>
                        </td>
                        <td class="align-middle fw-normal">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-menu-<?= $menu['id_menu'] ?>"><i class="bi bi-pencil-fill"></i></button>
                            <div class="modal fade text-start" id="edit-menu-<?= $menu['id_menu'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="mb-3">
                                      <label for="nama-<?= $menu['id_menu'] ?>" class="form-label">Nama Menu</label>
                                      <input type="text" class="form-control" id="nama-<?= $menu['id_menu'] ?>" placeholder="Masukan Nama Menu...">
                                    </div>
                                    <div>
                                      <label for="harga-<?= $menu['id_menu'] ?>" class="form-label">Harga Menu</label>
                                      <input type="number" class="form-control" id="harga-<?= $menu['id_menu'] ?>" placeholder="Masukan Harga Menu...">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button onclick="editMenu('<?= $menu['id_menu'] ?>')" class="btn btn-primary">Edit</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button type="button" onclick="hapusMenu('<?= $menu['id_menu'] ?>')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
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
    <script src="script/kios/menu.js"></script>
</body>
</html>