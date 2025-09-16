<?php
include "koneksi.php";

$judul     = $_POST['judul'];
$genre     = $_POST['genre'];
$sutradara = $_POST['sutradara'];
$durasi    = $_POST['durasi'];
$sinopsis  = $_POST['sinopsis'];

$target_folder = "asset/";
$filename = basename($_FILES["poster"]["name"]);
$target_file = $target_folder . time() . "_" . $filename;

// Cek kalau file beneran gambar
$check = getimagesize($_FILES["poster"]["tmp_name"]);
if($check !== false) {
    if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
        $poster = $target_file;
        $sql = "INSERT INTO film (judul, genre, sutradara, durasi, poster, sinopsis, filter) 
        VALUES ('$judul','$genre','$sutradara','$durasi','$poster','$sinopsis','Upcoming Film')";

        
        if (mysqli_query($koneksi, $sql)) {
            header("location:index.php?tambah=sukses");
        } else {
            header("location:index.php?tambah=gagal");
        }
    } else {
        echo "Gagal upload gambar.";
    }
} else {
    echo "<script>
            alert('File bukan gambar!!');
            document.location.href = 'index.php';
        </script>";
}
?>