<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "latihanukk";

$koneksi = mysqli_connect($server, $username, $password, $database);


function nowplay($id_film) {
    global $koneksi;
    $id_film = (int) $id_film; // pastikan integer
    $query = "UPDATE film SET filter = 'now playing film' WHERE id_film = $id_film";
    
    mysqli_query($koneksi, $query);
    
    return mysqli_affected_rows($koneksi);
}

function upcom($id_film) {
    global $koneksi;
    $id_film = (int) $id_film; // pastikan integer
    $query = "UPDATE film SET filter = 'upcoming film' WHERE id_film = $id_film";
    
    mysqli_query($koneksi, $query);
    
    return mysqli_affected_rows($koneksi);
}

?>