<?php
include "koneksi.php";

$id_film = $_GET['id_film'];

$sql = "DELETE FROM film WHERE id_film = '$id_film'";
$query = mysqli_query($koneksi, $sql);

if($query){
    header("location:index.php?hapus=berhasil");
}else{
    header("location:index.php?hapus=gagal");
}
?>