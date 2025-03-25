<?php
include 'koneksi.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "SELECT * FROM siswa WHERE nis = '$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
        exit;
    }
}

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $sql = "UPDATE siswa SET 
                nama_siswa='$nama_siswa', 
                jenis_kelamin='$jenis_kelamin',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir='$tanggal_lahir',
                id_kelas='$id_kelas',
                id_wali='$id_wali'
            WHERE nis='$nis'";

    if(mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$wali = mysqli_query($koneksi, "SELECT * FROM wali_murid");

?>

<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Data Siswa</h1>
    <a href="index.php">Kembali</a>

    <form method="post">
        <input type="hidden" name="nis" value="<?= $data['nis'] ?>">
        <label>Nama Siswa:</label>
        <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" required>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="L" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select>

        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>" required>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required>

        <label>Kelas:</label>
        <select name="id_kelas" required>
            <?php while ($row = mysqli_fetch_assoc($kelas)) : ?>
                <option value="<?= $row['id_kelas'] ?>" <?= ($row['id_kelas'] == $data['id_kelas']) ? 'selected' : '' ?>>
                    <?= $row['nama_kelas'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Wali Murid:</label>
        <select name="id_wali" required>
            <?php while ($row = mysqli_fetch_assoc($wali)) : ?>
                <option value="<?= $row['id_wali'] ?>" <?= ($row['id_wali'] == $data['id_wali']) ? 'selected' : '' ?>>
                    <?= $row['nama_wali'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
</body>
</html>
