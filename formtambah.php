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
            <div class="container mt-2">
                <h2 class="text-center">TAMBAH DATA PRODUK</h2>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Id Produk:</label>
                                <input type="number" name="id_produk" min="1" max="99" class="form-control" placeholder="Masukkan Id Produk...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Produk:</label>
                                <input type="text" name="nama_produk" class="form-control" maxlength="105" required placeholder="Masukkan Nama Produk...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kategori:</label>
                                <input type="text" name="kategori" class="form-control" maxlength="40" placeholder="Masukkan Kategori...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga:</label>
                                <input type="number" name="harga" onkeypress="return hanyaAngka(event)" min="1" max="99999" class="form-control" placeholder="Masukkan Harga...">
                                <!-- onkeypress diatas berfungsi untuk mengaktifkan javascript jika kolom input dikilk -->
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pilih Status</label>
                            <select class="form-control" name="status">
                                <option disabled>Pilih...</option>
                                <option value="0">tidak bisa dijual</option>
                                <option value="1">bisa dijual</option>
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
                $id_produk = filter_input(INPUT_POST, 'id_produk', FILTER_SANITIZE_STRING);
                $nama_produk = filter_input(INPUT_POST, 'nama_produk', FILTER_SANITIZE_STRING);
                $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING); 
                $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING); 
                // akhir filter
                $status = $_POST['status'];
                // kondisi jika nama produk tidak diisi  
                if(empty($_POST["nama_produk"])){
                    echo"<script>
                        alert('Mohon Isi Kolom Nama Produk');
                        window.location.href='formtambah.php';
                    </script>";
                // akhir kondisi
                // kondisi jika nama produk diisi
                } else {
                    $tambah="INSERT INTO produk (id_produk,nama_produk,kategori,harga,status) VALUES ('".$id_produk."', '".$nama_produk."', '".$kategori."', '".$harga."', '".$status."')";
                        mysqli_query($koneksi,$tambah);
                        echo"<script>
                            alert('Data Berhasil diTambah');
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