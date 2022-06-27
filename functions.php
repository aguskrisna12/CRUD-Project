<?php 
//koneksi ke database
$connectSQL = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
    global $connectSQL;
    $result = mysqli_query($connectSQL, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows; // hasil fetch menjadi array[]
};



function tambah($data){
    
    global $connectSQL;
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambar = uplod();
    if( !$gambar ){
        return false;
    }

    $query = "INSERT INTO siswa VALUES (NULL, '$nama', '$nim', '$jurusan', '$email', '$gambar')";
    mysqli_query($connectSQL, $query); // untuk menambahkan data ke mysql
    return mysqli_affected_rows($connectSQL); // mengembalikan angka 1 / -1 jika angka 1 muncul data berhasil ditambah dan sebaliknya 
}

function uplod(){
    
    $nameFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];
    // var_dump($tmpName); die;

    // jika user tidak menambah gambar
    if( $error === 4 ){
        echo "
        <script> 
            alert('Pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    // jika user tidak menambah gambar sesuai format gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.' , $nameFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // var_dump($ekstensiGambar);

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "
        <script> 
            alert('File yang anda pilih bukan gambar!');
        </script>";
        return false;
    }

    // jika user menambahkan gambar lebih dari 2mb
    if( $ukuranFile > 2000000 ){
        echo "
        <script> 
            alert('File gambar terlalu besar!');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;  

    // menguplod gambar
    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id){
    
    global $connectSQL;
    $sql = "DELETE FROM `siswa` WHERE `siswa`.`id` = $id;";
    mysqli_query($connectSQL, $sql);
    
    return mysqli_affected_rows($connectSQL);
}


function ubah($data){

    global $connectSQL;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // jika user tidak mengubah gambar
    if( $_FILES["gambar"]["error"] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = uplod();
    }
    
    $queryUbah = "UPDATE siswa SET 
                nama = '$nama',
                nim = '$nim',
                jurusan = '$jurusan',
                email = '$email',
                gambar = '$gambar' 
                WHERE id = $id";
    mysqli_query($connectSQL, $queryUbah); // untuk menambahkan data ke mysql
    return mysqli_affected_rows($connectSQL); // mengembalikan angka 1 / -1 jika angka 1 muncul data berhasil ditambah dan sebaliknya     
}


function cari ($keyword){
    $query = "SELECT * FROM siswa 
            WHERE nama LIKE '%$keyword%' OR 
            nim LIKE '%$keyword%'OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";
    return query($query);
}


function registrasi ($data){
    global $connectSQL;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connectSQL, $data["password"]);
    $password2 = mysqli_real_escape_string($connectSQL, $data["password2"]); 

    $result = mysqli_query($connectSQL, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result) ){
        echo "<script>
        alert('username yang pilih sudah terdaftar') 
        </script>";
        return false;
    }
    
    //mengecek jika password dan konfirmasi password tidak sama
    if ( $password != $password2 ){
        echo "
        <script> 
            alert('Konfirmasi password salah!');
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //masukan data ke database
    mysqli_query($connectSQL, "INSERT INTO user VALUES(NULL, '$username', '$password')");

    return mysqli_affected_rows($connectSQL);


}




?>