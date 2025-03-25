<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_wali = $_POST['nama_wali'];
    $kontak = $_POST['kontak'];
    $sql = "INSERT INTO wali_murid (nama_wali, kontak) VALUES ('$nama_wali','$kontak')";
    mysqli_query($koneksi, $sql);
}

if (isset($_GET['hapus'])) {
    $id_wali = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM wali_murid WHERE id_wali = $id_wali");
}

if (isset($_POST['update'])) {
    $id_wali = $_POST['id_wali'];
    $nama_wali = $_POST['nama_wali'];
    $kontak = $_POST['kontak'];
    mysqli_query($koneksi, "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = $id_wali");
    header("Location: kelola_wali.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM wali_murid");

$wali_edit = null;
if (isset($_GET['edit'])) {
    $id_wali = $_GET['edit'];
    $result_edit = mysqli_query($koneksi, "SELECT * FROM wali_murid WHERE id_wali = $id_wali");
    $wali_edit = mysqli_fetch_assoc($result_edit);
}

?>

<html>
<head>
    <title>Kelola Wali Murid</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kelola Wali Murid</h1>
    <a href="index.php">Kembali</a>

    <form method="post">
        <input type="hidden" name="id_wali" value="<?= $wali_edit['id_wali'] ?? '' ?>">
        <input type="text" name="nama_wali" placeholder="Nama Wali Murid" required value="<?= $wali_edit['nama_wali'] ?? '' ?>">
        <input type="text" name="kontak" placeholder="Kontak" required value="<?= $wali_edit['kontak'] ?? '' ?>">
        <?php if ($wali_edit) : ?>
            <button type="submit" name="update">Perbarui</button>
        <?php else : ?>
            <button type="submit" name="tambah">Tambah</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Wali Murid</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $i = 1; 
        while ($data = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $data['nama_wali'] ?></td>
            <td><?= $data['kontak'] ?></td>
            <td>
                <a class="edit btn-primary" href="?edit=<?= $data['id_wali'] ?>">Edit</a>
                <a class="btn-danger" href="?hapus=<?= $data['id_wali'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
