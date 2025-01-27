<?php include 'layout/header.php';
//memanggil fungsi koneksi ke database 
include 'koneksi.php';
//membuat query untuk memanggil data 
$query = mysqli_query($conn, "SELECT * FROM operator_sistem");

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Operator</li>
    </ol>
</nav>
<div class="card">
    <div class="card-header">
        List Mahasiswa
    </div>
    <div class="card-body">
        <a href="tambah_operator.php" class="btn btn-primary btn-sm mb-3">+ Tambah Data Operator</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($query as $get) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $get['nama_operator'] ?></td>
                            <td><?= $get['email_operator'] ?></td>
                            <td><?= $get['password_operator'] ?></td>
                        
                            <td>
                                <a href="edit_operator.php?id=<?= $get['id_operator'] ?>" class="badge bg-primary">
                                    Edit
                                </a>
                                <a onclick="return confirm('Hapus Data?')" href="hapus_operator.php?id=<?= $get['id_operator'] ?>" class="badge bg-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>