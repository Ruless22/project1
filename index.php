<?php
include 'koneksi.php';

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
        LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
        LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
        WHERE siswa.nama_siswa LIKE '%$search%' OR siswa.nis LIKE '%$search%'";
} else {
    $sql = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
        LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
        LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali";
}
$result = mysqli_query($koneksi, $sql);

?>

<html>
    <head>
        <title>Data Siswa</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Data Siswa</h1>
        <a class="edit btn-key" href="kelola_kelas.php">Kelola Kelas</a>
        <a class="edit btn-key" href="kelola_wali.php">Kelola Wali Murid</a>
        <a class="edit btn-primary" href="tambah_siswa.php">Tambah Siswa</a>

        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari siswa..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>

        <table border="1">
            <tread>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Wali Murid</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($data = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $data['nis'] ?></td>   
                    <td><?php echo $data['nama_siswa'] ?></td>
                    <td><?php echo $data['jenis_kelamin'] ?></td>
                    <td><?php echo $data['tempat_lahir'] ?></td>
                    <td><?php echo $data['tanggal_lahir'] ?></td>
                    <td><?php echo $data['nama_kelas'] ?></td>
                    <td><?php echo $data['nama_wali'] ?></td>
                    <td>
                        <a class="edit btn-primary" href="edit_siswa.php?nis=<?= $data['nis'] ?>">Edit</a>
                        <a class="delete btn-danger" href="hapus_siswa.php?nis=<?= $data['nis'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>                       
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </body>
</html>      
                    