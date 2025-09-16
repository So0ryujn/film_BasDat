<?php 
include "koneksi.php";

$sql1 = "SELECT * FROM  film WHERE filter = 'upcoming film' ";
$sql2 = "SELECT * FROM  film WHERE filter = 'now playing film' ";

$query1 = mysqli_query($koneksi, $sql1);
$query2 = mysqli_query($koneksi, $sql2);

if (isset($_GET['nowplay'])) {
    $id = $_GET['nowplay'];
    if (nowplay($id) > 0) {
        echo "<script>
            alert('FILM NOW PLAYING YEAYY');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Yahh gagal nonton');
            document.location.href = 'index.php';
        </script>";
    }
}

if (isset($_GET['upcom'])) {
    $id = $_GET['upcom'];
    if (upcom($id) > 0) {
        echo "<script>
            alert('SABAR DIKIT');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Yahh gagal nonton');
            document.location.href = 'index.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Film App</title>
</head>
<body>
    <div class="container">
        
        <center><h1>Film App</h1></center>
        <div class="search">
            <label for="">Search:</label>
            <input type="search" name="search" placeholder=" Cari Buku ">
        </div><br><br>
        
        <div class="film_app">
            <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
                <label for="">Judul</label><br>
                <input type="text" name="judul" placeholder="Judul" required><br>

                <label for="genre">Genre:</label><br>
                <select name="genre" id="genre" required>
                    <option value="">-- Pilih Genre --</option>
                    <option value="Aksi">Aksi</option>
                    <option value="Drama">Drama</option>
                    <option value="Komedi">Komedi</option>
                    <option value="Horor">Horor</option>
                    <option value="Fantasi">Fantasi</option>
                    <option value="Romantis">Romantis</option>
                    <option value="Petualangan">Petualangan</option>
                    <option value="Dokumenter">Dokumenter</option>
                </select><br>

                <label for="">Sutradara</label><br>
                <input type="text" name="sutradara" placeholder="Sutradara" required><br>

                <label for="">Durasi</label><br>
                <input type="time" name="durasi" id="durasi" step="1" required><br>

                <label for="">Sinopsis</label><br>
                <textarea name="sinopsis" placeholder="Sinopsis"></textarea><br>
                
                <label for="">Poster</label><br>
                <input type="file" name="poster" accept="image/*" required><br>
                <button type="submit">Simpan</button>
            </form>
        </div>
        <hr>
        <center><h1>Upcomming Film</h1></center>

    <div class="upcom">
        <?php while($film = mysqli_fetch_assoc($query1)) { ?>
            <div class="card">
                <img src="<?= $film['poster']?>" alt="<?= $film['judul']?>" />
                <div class="info">
                    <p><b>Judul:</b> <?= $film['judul']?></p>
                    <p><b>Genre:</b> <?= $film['genre']?></p>
                    <p><b>Sutradara:</b> <?= $film['sutradara']?></p>
                    <p><b>Durasi:</b> <?= $film['durasi']?></p>
                    <p><b>Sinopsis:</b> <?= $film['sinopsis']?></p>
                </div>
                <div class="actions">
                    <button class="btn-done">
                        <a href="index.php?nowplay=<?= $film['id_film'] ?>">Now Playing Film</a>
                    </button>
                    <button class="btn-delete">
                        <a href="delete.php?id_film=<?= $film['id_film'] ?>">Hapus</a>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>


        <hr>
        <center><h1>Now Playing Film</h1></center>

        <div class="nowplay">
            <?php while($film = mysqli_fetch_assoc($query2)) { ?>
                <div class="card">
                    <img src="<?= $film['poster']?>" alt="<?= $film['judul']?>" />
                    <div class="info">
                        <p><b>Judul:</b> <?= $film['judul']?></p>
                        <p><b>Genre:</b> <?= $film['genre']?></p>
                        <p><b>Sutradara:</b> <?= $film['sutradara']?></p>
                        <p><b>Durasi:</b> <?= $film['durasi']?></p>
                        <p><b>Sinopsis:</b> <?= $film['sinopsis']?></p>
                    </div>
                    <div class="actions">
                        <button class="btn-done">
                            <a href="index.php?upcom=<?= $film['id_film'] ?>">Upcoming Film</a>
                        </button>
                        <button class="btn-delete">
                            <a href="delete.php?id_film=<?= $film['id_film'] ?>">Hapus</a>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</body>
</html>