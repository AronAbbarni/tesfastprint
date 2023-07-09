<html>
    <head>
        <title>Form Edit Data</title>

        <!-- link folder lokal css bootstrap 4.6.2 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- akhir link -->
        <!-- link folder lokal js bootstrap 4.6.2 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- akhir link -->
    </head>
    <body>
        <?php
            // pengambilan data dari database
            include "koneksi.php";
            $sql=mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$_GET[id]'");
            $data=mysqli_fetch_array($sql);
        ?>
            <div class="container mt-2">
                <h2 class="text-center">EDIT DATA PRODUK</h2>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Id Produk:</label>
                                <input type="number" name="id_produk" min="1" max="99" class="form-control" placeholder="Masukkan Id Produk..." value="<?php echo $data['id_produk']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Produk:</label>
                                <input type="text" name="nama_produk" class="form-control" maxlength="105" required placeholder="Masukkan Nama Produk..." value="<?php echo $data['nama_produk']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kategori:</label>
                                <input type="text" name="kategori" class="form-control" maxlength="40" placeholder="Masukkan Kategori..." value="<?php echo $data['kategori']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga:</label>
                                <input type="number" name="harga" onkeypress="return hanyaAngka(event)" min="1" max="99999" class="form-control" value="<?php echo $data['harga']; ?>" placeholder="Masukkan Harga...">
                                <!-- onkeypress diatas berfungsi untuk mengaktifkan javascript jika kolom input dikilk -->
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pilih Status</label>
                            <select class="form-control" name="status">
                                <option disabled>Pilih...</option>
                                <option value="0" <?php if ($data['status'] == 0) { ?> selected <?php }?>>tidak bisa dijual</option>
                                <option value="1" <?php if ($data['status'] == 1) { ?> selected <?php }?>>bisa dijual</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="btn btn-primary px-4 py-2" type="submit" value="Simpan" name="proses">
                            <a href="tampilandata.php" class="btn btn-secondary px-4 py-2">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>

            <?php
            include "koneksi.php";
            // kondisi jika tombol simpan diklik
            if(isset($_POST['proses'])){ 
                // filter input
                $nama_produk = filter_input(INPUT_POST, 'nama_produk', FILTER_SANITIZE_STRING);
                $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING); 
                $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING); 
                // akhir filter
                // kondisi jika nama produk tidak diisi  
                if(empty($_POST["nama_produk"])){
                    echo"<script>
                        alert('Mohon Isi Kolom Nama Produk');
                        window.location.href='formedit.php?id=$_GET[id]';
                    </script>";
                // akhir kondisi
                // kondisi jika nama produk diisi
                } else {
                    mysqli_query($koneksi,"UPDATE produk SET
                    id_produk  = '$_POST[id_produk]', nama_produk = '$nama_produk', kategori = '$kategori', harga = '$harga', status = '$_POST[status]' WHERE id_produk  = '$_GET[id]'");
                        echo"<script>
                            alert('Data Berhasil diEdit');
                            window.location.href='tampilandata.php';
                        </script>";
                } 
                // akhir kondisi
            }
            // akhir kondisi 
            ?>

        <!-- script input harga agar data yang bisa dimasukkan hanya berupa angka -->
        <script>
            function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            }
        </script>
        <!-- akhir script -->
    </body>
</html>