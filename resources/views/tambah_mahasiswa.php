<?php include 'layout/header.php'; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
    </ol>
</nav>
<form method="POST" action="" class="card">
    <div class="card-header">
        Form Mahasiswa
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for="">NIM Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="nim_mahasiswa" placeholder="Masukkan nomor induk mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Nama Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="nama_mahasiswa" placeholder="Masukkan nama lengkap mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Tanggal Lahir</label>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="tanggal_lahir">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jenis Kelamin</label>
            </div>
            <div class="col-md">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="laki-laki">
                    <label class="form-check-label" for="">
                        Laki_Laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="perempuan">
                    <label class="form-check-label" for="">
                        Perempuan
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jurusan</label>
            </div>
            <div class="col-md">
                <?php include 'koneksi.php';
                $option_jurusan = mysqli_query($conn, "SELECT * FROM data_jurusan");
                ?>
                <select class="form-select" name="jurusan" aria-label="Default select example">
                    <option disabled selected>Pilih Jurusan</option>
                    <?php foreach ($option_jurusan as $key) : ?>
                        <option value="<?= $key['id_jurusan'] ?>"><?= $key['nama_jurusan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="simpan" class="btn btn-success">Simpan Data</button>
        <a href="data_mahasiswa.php" class="btn btn-danger">Kembali</a>
    </div>
</form>
<?php
include 'koneksi.php';

function Nim($conn, $nim_mahasiswa)
{
    $query = "SELECT COUNT(*) as count FROM data_mahasiswa WHERE nim_mahasiswa = '$nim_mahasiswa'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

if (isset($_POST['simpan'])) {
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $tgl_lahir = $_POST['tanggal_lahir'];
   

    if (Nim($conn, $nim_mahasiswa)) {
    echo '<div class="container mt-3"><div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><b>Data Gagal Disimpan! </b>NIM <b>'. $nim_mahasiswa.'</b> Sudah ada
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div></div>';
    } else {

        $simpan = mysqli_query($conn, "INSERT INTO data_mahasiswa( nama_mahasiswa,  nim_mahasiswa,  tanggal_lahir,  jenis_kelamin, 
                                                id_jurusan)  VALUES('$nama_mahasiswa', '$nim_mahasiswa', 
                                                '$tgl_lahir', 
                                                '$jenis_kelamin', 
                                                 '$jurusan')");
        if ($simpan) {
            echo '<script>
        alert("data berhasil disimpan");
        window.location.href="data_mahasiswa.php";
        </script>';
        }
    }
}
include 'layout/footer.php';
?>