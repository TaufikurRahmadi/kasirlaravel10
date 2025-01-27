<?php
include 'layout/header.php';
include 'koneksi.php';

$id = $_GET['id'];
$query_mahasiswa = mysqli_query($conn, "SELECT * FROM data_mahasiswa WHERE id_mahasiswa = '$id'");
$get_mahasiswa = mysqli_fetch_array($query_mahasiswa);

$query_jurusan = mysqli_query($conn, "SELECT * FROM data_jurusan");
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Mahasiswa</li>
    </ol>
</nav>

<form method="POST" action="" class="card">
    <div class="card-header">
        Form Mahasiswa
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for=""> NIM MAHASISWA </label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get_mahasiswa['nim_mahasiswa'] ?>" name="nim_mahasiswa" placeholder="Masukkan nomor induk mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Nama Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get_mahasiswa['nama_mahasiswa'] ?>" name="nama_mahasiswa" placeholder="Masukkan nama lengkap mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Tanggal Lahir</label>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" value="<?= $get_mahasiswa['tanggal_lahir'] ?>" name="tanggal_lahir">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jenis Kelamin</label>
            </div>
            <div class="col-lg-9">
                <select class="form-control" name="jenis_kelamin">
                    <option value="Laki-laki" <?= ($get_mahasiswa['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= ($get_mahasiswa['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Program Studi</label>
            </div>
            <div class="col-lg-9">
                <select class="form-control" name="id_jurusan">
                    <?php
                    while ($data_jurusan = mysqli_fetch_assoc($query_jurusan)) {
                        $selected_jurusan = ($data_jurusan['id_jurusan'] == $get_mahasiswa['id_jurusan']) ? 'selected' : '';
                        echo "<option value='{$data_jurusan['id_jurusan']}' $selected_jurusan>{$data_jurusan['nama_jurusan']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button name="edit" class="btn btn-success">Edit Data</button>
        <a href="data_mahasiswa.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php
include 'layout/footer.php';

if (isset($_POST['edit'])) {
    $id = $_GET['id'];
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $tgl_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id_jurusan = $_POST['id_jurusan'];

    $simpan = mysqli_query($conn, "UPDATE data_mahasiswa SET
        nim_mahasiswa = '$nim_mahasiswa',
        nama_mahasiswa = '$nama_mahasiswa',
        tanggal_lahir = '$tgl_lahir',
        jenis_kelamin = '$jenis_kelamin',
        id_jurusan = '$id_jurusan'
        WHERE id_mahasiswa = '$id'");

    if ($simpan) {
        echo '<script>
        alert("Data berhasil di edit");
        window.location.href="data_mahasiswa.php";
        </script>';
    }
}
?>
