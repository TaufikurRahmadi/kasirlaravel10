<?php include 'layout/header.php';
include 'koneksi.php';

// Check if the form for deleting a department is submitted
if (isset($_GET['id'])) {
    $id_jurusan = $_GET['id'];

    $check_query = "SELECT COUNT(*) AS jumlah_mahasiswa FROM data_mahasiswa WHERE id_jurusan = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $id_jurusan);
    $check_stmt->execute();
    $result_check = $check_stmt->get_result();

    $row_check = mysqli_fetch_assoc($result_check);
    $jumlah_mahasiswa = $row_check['jumlah_mahasiswa'];

    $check_stmt->close();

    // If there are associated records, show a message and do not proceed with deletion
    if ($jumlah_mahasiswa > 0) {
        echo '<script>
            alert("Tidak dapat menghapus jurusan karena terdapat data mahasiswa terkait.");
            window.location.href="index.php";
        </script>';
    } else {
        // No associated records, proceed with the deletion
        $delete_query = "DELETE FROM data_jurusan WHERE id_jurusan = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $id_jurusan);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows > 0) {
            echo '<script>
                alert("Jurusan berhasil dihapus");
                window.location.href="index.php";
            </script>';
        } else {
            echo '<script>
                alert("Gagal menghapus jurusan");
                window.location.href="index.php";
            </script>';
        }

        $delete_stmt->close();
    }
}

// Fetch the data after deletion
$query = "SELECT dj.id_jurusan, dj.nama_jurusan, COUNT(dm.id_jurusan) AS jumlah_mahasiswa
          FROM data_jurusan dj
          LEFT JOIN data_mahasiswa dm ON dj.id_jurusan = dm.id_jurusan
          GROUP BY dj.id_jurusan, dj.nama_jurusan";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Jurusan</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        List Jurusan
    </div>
    <div class="card-body">
        <a href="tambah_jurusan.php" class="btn btn-primary btn-sm mb-3">+ Tambah Data Jurusan</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Jurusan</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($result as $get) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $get['nama_jurusan']?></td>
                        <td><?= $get['jumlah_mahasiswa']?></td>
                        <td>
                            <a href="edit_jurusan.php?id=<?=$get['id_jurusan']?>" class="badge bg-primary">Edit</a>
                            <a onclick="return confirm('Hapus Data?')" href="hapus_jurusan.php?id=<?=$get['id_jurusan']?>" class="badge bg-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'layout/footer.php';?>
