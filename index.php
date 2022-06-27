<?php 
session_start();

if (!isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

require "functions.php";

$mahasiswa = query("SELECT * FROM siswa");

if (isset($_POST["cari"]) ){
    $mahasiswa = cari($_POST["keyword"]);
    // echo "<a href='index.php'>Kembali ke halaman tabel</a>";
}

?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL</title>
</head>
<body>
    <a href="logout.php">&#8226; Logout</a>
    <h1 style="text-align:center">Halaman Mahasiswa</h1>
    <div style="display:inline-block; margin-left:500px; padding-right:10px;">
        <button> <a style="text-decoration: none"; target="_blank" href="tambah.php?nama=<?= $mhs["nama"]; ?>">Tambah data mahasiswa</a> </button>
    </div>
        
    <div style="position:absolute; display:inline;">
        <form action="" method="post">
            <input type="text" name="keyword" size="30" autofocus placeholder="masukan keyword pencarian..." autocomplete="off">
            <button type="submit" name="cari">cari!</button>
        </form>    
    </div>


    <br>
    <table style="margin-left:auto; margin-right:auto; margin-top:30px;" border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td style="text-align:center">No.</td>
            <td style="text-align:center">Aksi</td>
            <td style="text-align:center">Gambar</td>
            <td style="text-align:center">Nama</td>
            <td style="text-align:center">NIM</td>
            <td style="text-align:center">Jurusan</td>
            <td style="text-align:center">Email</td>
        </tr>

        <?php $i=1; ?>
        <?php foreach( $mahasiswa as $mhs ) :?>
        <tr>
            <td style="text-align:center"><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $mhs["id"] ?>&gambar=<?= $mhs["gambar"]; ?>">ubah |</a>
                <a href="hapus.php?id=<?= $mhs["id"] ?>&nama=<?= $mhs["nama"]; ?> " onclick="return confirm('yakin ingin menghapus <?= $mhs['nama']; ?> ?')">hapus</a>
            </td>
            <td><img src="img/<?= $mhs["gambar"]; ?>" alt="broke" width="50"></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= $mhs["jurusan"]; ?></td>
            <td><?= $mhs["email"]; ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD++</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Table Page</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header col-12">
                  <h3 class="card-title">
                    <a class="text-success" href="tambah.php?nama=<?= $mhs["nama"]; ?>">
                      <span class="fas fa-plus"></span> Tambah Mahasiswa
                    </a>
                  </h3>
                </div>
                <div class="card-header col-12">
                <a data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline" action="" method="post">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" name="keyword" type="text" placeholder="Masukan keyword pencarian..."
                                aria-label="Search" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" name="cari" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>        
              </div>
              <!-- /.table -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">JURUSAN</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      <?php foreach( $mahasiswa as $mhs ) :?>
                      <tr>
                        <td style="text-align:center"><?= $i; ?></td>
                        <td class="text-center"><img src="img/<?= $mhs["gambar"]; ?>" alt="broke" width="50"></td>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["nim"]; ?></td>
                        <td><?= $mhs["jurusan"]; ?></td>
                        <td><?= $mhs["email"]; ?></td>
                        <td>
                          <a href="ubah.php?id=<?= $mhs["id"] ?>&gambar=<?= $mhs["gambar"]; ?>"><span
                              class="fas fa-edit"></a>
                          <a href="hapus.php?id=<?= $mhs["id"] ?>&nama=<?= $mhs["nama"]; ?> "
                            onclick="return confirm('yakin ingin menghapus <?= $mhs['nama']; ?> ?')"><span
                              class="ps-2 fas fa-trash"></a>
                        </td>
                      </tr>
                      <?php $i++ ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include 'footer.php'; ?>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>