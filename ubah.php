<?php 
require 'functions.php';
//ambil id
$id = $_GET["id"];
$gambar = $_GET["gambar"];
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];


// jika tombol submit di tekan
if( isset($_POST["submit"]) ){
    if ( ubah($_POST) > 0 ){
        echo "
        <script> 
            alert('Data berhasil diubah!')
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script> 
            alert('Data gagal diubah!')
            document.location.href = 'index.php';
        </script>";
    }
}

?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align:center;">Ubah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="gambarLama" value="<?= $gambar; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <table style="margin-left:auto; margin-right:auto; margin-top:10px;">
        <tr>
            <td><label for="nama">Nama</label></td>
            <td>:</td>
            <td><input type="text" name="nama" id="nama" required value="<?=$siswa["nama"];?>"></td>
        </tr>
        <tr>
            <td><label for="nim">NIM</label></td>
            <td>:</td>
            <td><input type="text" name="nim" id="nim" maxlength="10" max="10" required value="<?= $siswa["nim"]; ?>"></td>
        </tr>
        <tr>
            <td><label for="jurusan">Jurusan</label></td>
            <td>:</td>
            <td><input type="text" name="jurusan" id="jurusan" required value="<?= $siswa["jurusan"]; ?>"></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td>:</td>
            <td><input type="text" name="email" id="email" required value="<?= $siswa["email"]; ?> "></td>
        </tr>
        <tr>
            <td><label for="gambar">Gambar</label></td>
            <td><img src="img/<?= $gambar; ?>" style="width: 50px;" alt="broke"></td>   
            <td><input type="file" name="gambar" id="gambar"></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">Tambah data!</button></td>
            <td><button><a href="index.php">Kembali</a></button></td>
        </tr>
    </table>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah data</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Bootsrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"> -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Form Edit Mahasiswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Form Edit Mahasiswa</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Mahasiswa</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="gambarLama" value="<?= $gambar; ?>">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama"
                                                placeholder="Masukan nama" value="<?=$siswa["nama"];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <input type="text" name="nim" class="form-control" id="nim"
                                                placeholder="Masukan NIM" maxlength="10" max="10" value="<?=$siswa["nim"];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan</label>
                                            <input type="text" name="jurusan" class="form-control" id="jurusan"
                                                placeholder="Masukan jurusan" value="<?=$siswa["jurusan"];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" class="form-control" id="email"
                                                placeholder="Masukan email" value="<?=$siswa["email"];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file mb-2">
                                                    <img src="img/<?= $gambar; ?>" style="width: 60px;" alt="broke">  
                                                </div>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="gambar" id="gambar">
                                                    <label class="input-group-text" name="gambar" for="gambar">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-success">Edit data</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include "footer.php"; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
</body>

</html>