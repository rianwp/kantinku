<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style><?php require 'style/pelanggan/pesan.css' ?></style>
    <style><?php require 'style/font.css' ?></style>
    <title>Kantinku</title>
</head>
<body>
    <?php require 'components/pelanggan/navbar.php' ?>
    <?php 
    if(!isset($_SESSION['isLoggedIn_pelanggan'])){
      header('Location: /');
    }
    ?>
    <div class="container py-5 mx-auto">
      <h1 class="text-center">Pesan Makanan</h1>
      <div class="row mt-4">
        <div class="col-12 col-lg-7 col-md-6">
          <div class="mb-3">
            <label class="form-label">Pilih Menu</label>
            <input type="hidden" id="id_menu" value="">
            <input type="hidden" id="id_kios" value="">
            <input type="hidden" id="nama_menu" value="">
            <input type="hidden" id="harga_menu" value="">
            <div class="pilih-menu p-3 card">
              <?php 
                require 'process/config.php';
                $id_pelanggan = $_SESSION['id_pelanggan'];
                $sqlnama = "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
                $resultnama = mysqli_query($conn, $sqlnama);
                $nama = mysqli_fetch_assoc($resultnama)['nama_pelanggan'];
                $sqlmenu = 'SELECT menu.*,kios.nama_kios,kios.id_kios FROM menu INNER JOIN kios ON menu.id_kios=kios.id_kios';
                $resultmenu = mysqli_query($conn, $sqlmenu);
                foreach($resultmenu as $menu){
              ?>
                <div class="text-center mx-3 menu">
                  <button onclick="changeMenu('<?= $menu['id_menu'] ?>', '<?= $menu['nama_menu'] ?>', '<?= $menu['harga_menu'] ?>', '<?= $menu['id_kios'] ?>')" class="clickable-menu">
                    <label class="form-check-label" for="radio_<?= $menu['id_menu'] ?>">
                    <?php if($menu['foto_menu'] == ""){ ?>
                      <img src="../assets/makanan.jpg" class="foto-menu rounded-circle" alt="Foto <?= $menu['nama_menu'] ?>">
                    <?php } else{ ?>
                      <img src="data:image/jpeg;base64,<?= base64_encode($menu['foto_menu']) ?>" class="foto-menu rounded-circle" alt="Foto <?= $menu['nama_menu'] ?>">
                    <?php } ?>
                    </label>
                  </button>
                  <input onclick="changeMenu('<?= $menu['id_menu'] ?>', '<?= $menu['nama_menu'] ?>', '<?= $menu['harga_menu'] ?>', '<?= $menu['id_kios'] ?>')" class="form-check-input mt-1" type="radio" name="radiomenu" id="radio_<?= $menu['id_menu'] ?>" value="<?= $menu['id_menu'] ?>">
                  <p class="mt-2 mb-0"><?= $menu['nama_menu'] ?></p>
                  <p class="mb-0 fw-light"><?= $menu['nama_kios'] ?></p>
                  <p class="mt-2 mb-0">Rp<?= $menu['harga_menu'] ?></p>
                </div>
              <?php }?>
            </div>
            <p id="pilih-error" class="text-danger"></p>
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" placeholder="Masukan Jumlah Pesanan...">
            <p id="jumlah-error" class="text-danger"></p>
          </div>
          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" placeholder="Masukan Detail Pesanan..." rows="3"></textarea>
          </div>
          <div class="text-center mt-4">
            <button onclick="getPesanan()" class="btn btn-success text-white rounded-pill px-4 py-2">Tambahkan</button>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5 mt-md-0 mt-5">
          <label class="form-label">Pesanan</label>
          <div class="overflow-auto card">
            <table class="table m-0 text-center">
              <thead class="table-dark">
                <tr>
                  <th class="thead-font" scope="col">Pesanan</th>
                  <th class="thead-font" scope="col">Jml</th>
                  <th class="thead-font" scope="col">Harga</th>
                  <th class="thead-font" scope="col">Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tabel-pesanan"></tbody>
            </table>
            <div class="d-flex justify-content-between px-2 mt-2">
              <h6 class="fw-bold">Total</h6>
              <h6 id="total_harga" class="fw-bold">Rp0</h6>
            </div>
          </div>
          <p id="pesanan-error" class="text-danger"></p>
        </div>
        <div class="col-12 mt-5">
          <div class="mb-3">
            <label for="atas_nama" class="form-label">Atas Nama</label>
            <input type="text" class="form-control" id="atas_nama" value="<?= $nama ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="no_meja" class="form-label">Nomer Meja</label>
            <input type="number" class="form-control" id="no_meja" placeholder="Masukan No Meja...">
            <p id="no_meja-error" class="text-danger"></p>
          </div>
          <div class="text-center mt-4">
            <button onclick="getPesananRecap()" class="btn btn-success text-white rounded-pill px-4 py-2">Pesan</button>
          </div>
        </div>
      </div>
    </div>
    <?php require 'components/pelanggan/footer.php' ?>
    <script src="script/pelanggan/pesan.js"></script>
</body>
</html>