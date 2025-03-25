<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $sql = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
    mysqli_query($koneksi, $sql);
}

if (isset($_GET['hapus'])) {
    $id_kelas = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = $id_kelas");
}

$result = mysqli_query($koneksi, "SELECT * FROM kelas");

if (isset($_POST['update'])) {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    mysqli_query($koneksi, "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = $id_kelas");
    header("Location: kelola_kelas.php");
    exit;
}

$kelas_edit = null;
if (isset($_GET['edit'])) {
    $id_kelas = $_GET['edit'];
    $result_edit = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = $id_kelas");
    $kelas_edit = mysqli_fetch_assoc($result_edit);
}

?>

<html>
<head>
    <title>Kelola Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kelola Kelas</h1>
    <a href="index.php">Kembali</a>
    
    <form method="post">
        <input type="hidden" name="id_kelas" value="<?= $kelas_edit['id_kelas'] ?? '' ?>">
        <input type="text" name="nama_kelas" placeholder="Nama Kelas" required value="<?= $kelas_edit['nama_kelas'] ?? '' ?>">
        <?php if ($kelas_edit) : ?>
            <button type="submit" name="update">Perbarui</button>
        <?php else : ?>
            <button type="submit" name="tambah">Tambah</button>
        <?php endif; ?>
    </form>

    <table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Kelas</th>
        <th>Aksi</th>
    </tr>
    <?php 
    $i = 1; 
    while ($data = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $i++ ?></td>
        <td><?= $data['nama_kelas'] ?></td>
        <td>
            <a class="edit btn-primary" href="?edit=<?= $data['id_kelas'] ?>">Edit</a>
            <a class="btn-danger" href="?hapus=<?= $data['id_kelas'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>