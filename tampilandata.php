<html>
  <head>
    <!-- link folder lokal css bootstrap 4.6.2 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- akhir link -->
    <!-- link folder lokal js bootstrap 4.6.2 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- akhir link -->
    <!-- link CDN font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- akhir link -->
  </head>

  <body>
    <!-- tampilan tabel data -->
    <div class="container">
      <div class="row">            
        <div class="col-md-12">
        <h4>Data Produk Yang Bisa Di Jual</h4>
          <a class="btn btn-success btn-xs mb-2" href="formtambah.php"><i class="fa-solid fa-plus"></i></a> Tambah
          <div class="table-responsive">                   
            <table id="mytable" class="table table-bordred table-striped">                   
              <thead>                   
                <th>Id Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Hapus</th>
              </thead>
              <?php
                include 'koneksi.php';
                // disini saya menggunakan fungsi SQL berupa where yang dimana status 1 berarti produk yang bisa dijual
                $data = mysqli_query($koneksi,"SELECT * from produk WHERE status='1'");
                while($d = mysqli_fetch_array($data)){
              ?>
              <tbody>    
                <tr>
                  <td><?php echo $d['id_produk'];?></td>
                  <td><?php echo $d['nama_produk'];?></td>
                  <td><?php echo $d['kategori'];?></td>
                  <td><?php echo $d['harga'];?></td>
                  <td>
                    <?php
                    switch($d['status'])
                    {
                        case "0":
                        echo "tidak bisa dijual";
                        break;
                        case "1":
                        echo "bisa dijual";
                        break;
                    } ;?>
                  </td>
                  <!-- tombol edit -->
                  <td><a href="formedit.php?id=<?php echo $d['id_produk']; ?>"><button class="btn bg-primary text-white btn-xs"><i class="fa-solid fa-pencil"></i></button></a></td>
                  <!-- akhir tombol edit -->
                  <!-- tombol hapus dan konfirmasi hapus-->
                  <form action="" method="POST">
                      <input type="hidden" name="id_produk" value="<?php echo $d['id_produk'];?>">
                      <td><button type="submit" name="hapus" onclick="return confirm('Apa Anda Yakin Ingin Menghapus Data?')" class="btn bg-danger text-white btn-xs"><i class="fa-sharp fa-solid fa-trash"></i></button></td>
                  </form>
                  <!-- akhir tombol hapus dan konfirmasi hapus-->
                  <!-- aksi/operasi tombol hapus -->
                  <?php
                      if (isset($_POST['hapus'])) {
                          include 'koneksi.php';
                          $id_produk = $_POST['id_produk'];
                          // hapus data dari database
                          mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$id_produk'");
                          echo"<script>
                                  alert('Data Berhasil diHapus');
                                  window.location.href='tampilandata.php';
                          </script>";
                      }
                  ?>
                  <!-- akhir aksi/operasi tombol hapus-->
                </tr>
              </tbody>
              <?php
                }
              ?>          
            </table>
          </div>
      </div>
    </div>
    <!-- akhir tampilan data -->
  </body>
</html>