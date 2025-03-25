<?php
include 'koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $sql = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali)
        VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali')";

    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('Data siswa berhasil disimpan'); window.location='index.php'</script>";    
    } else {
        echo "<script>alert('Data siswa gagal disimpan');</script>";
    }
}

$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
$wali = mysqli_query($koneksi, "SELECT * FROM wali_murid");

?>

<html>
    <head>
        <title>Tambah Siswa</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Tambah Siswa</h2>
        <form method="POST">
            <label>NIS:</label>
            <input type="text" name="nis" required><br/> 
            
            <label>Nama Siswa:</label>
            <input type="text" name="nama_siswa" required><br/>
            
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select><br/>
            
            <label>Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" required><br/>
            
            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" required><br/>

            <label>Kelas:</label>
            <select name="id_kelas" required>
                <?php while($data = mysqli_fetch_assoc($kelas)): ?>
                    <option value="<?php echo $data['id_kelas']?>"><?php echo $data['nama_kelas']?></option>
                <?php endwhile; ?>
            </select><br/>

            <label>Wali Murid:</label>
            <select name="id_wali" required>
                <?php while($data = mysqli_fetch_assoc($wali)): ?>
                    <option value="<?php echo $data['id_wali']?>"><?php echo $data['nama_wali']?></option>
                <?php endwhile; ?>
            </select><br/>

            <input type="submit" name="simpan" value="Simpan">
            <a href="index.php">Batal</a>
        </form>
    </body>
</html>