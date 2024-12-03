<?php
include 'partials/header.php';

$prestasiController = new PrestasiController($conn);
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

$prestasiList = $prestasiController->showAllPrestasi($id_mahasiswa);

?>

<div class="info">
    <p class="info-text">Home - Prestasi</p>
</div>

<div class="card p-4" style="margin: 50px 84px 50px 84px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0 fs-4" style="color: #475261;">
            List Prestasi
        </h5>
        <div class="d-flex align-items-center gap-3">
            <div class="input-group" style="max-width: 300px;">
                <button class="btn btn-primary" type="button" style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-search"></i>
                </button>
                <input class="form-control" placeholder="Search Prestasi" type="text" />
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2" style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-plus"></i>
                    <a href="tambahprestasi.php" style="text-decoration: none; color: white;">
                        <p class="mb-0">Tambah</p>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>Juara</th>
                <th>Lomba</th>
                <th>Tingkat</th>
                <th>Waktu Pelaksanaan</th>
                <th>Penyelenggara</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($prestasiList)) : ?>
                <?php foreach ($prestasiList as $prestasi) : ?>
                    <tr>
                        <td><?= htmlspecialchars($prestasi['id_prestasi']); ?></td>
                        <td><?= htmlspecialchars($prestasi['jenis_kompetisi']); ?></td>
                        <td><?= htmlspecialchars($prestasi['tingkat_kompetisi']); ?></td>
                        <td>
                            <?= htmlspecialchars(
                                $prestasi['tanggal_mulai'] instanceof DateTime 
                                    ? $prestasi['tanggal_mulai']->format('Y-m-d') 
                                    : $prestasi['tanggal_mulai'], 
                                ENT_QUOTES, 'UTF-8'
                            ); ?>
                        </td>
                        <td><?= htmlspecialchars($prestasi['tempat_kompetisi']); ?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-start gap-1">
                                <a href="detail.php?id=<?= $prestasi['id_prestasi']; ?>" class="btn btn-outline-primary btn-xs">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                <a href="edit.php?id=<?= $prestasi['id_prestasi']; ?>" class="btn btn-outline-warning btn-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data prestasi tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <select class="form-select" style="width: 70px;">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a aria-label="Previous" class="page-link" href="#">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">...</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">10</a>
                </li>
                <li class="page-item">
                    <a aria-label="Next" class="page-link" href="#">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
