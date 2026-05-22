<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
        <div>
            <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 1px; margin:0;">Quản Lý Danh Mục</h3>
            <div style="height: 3px; width: 60px; background-color: #c89b3c; margin-top: 10px;"></div>
        </div>
        <a href="/WebBanGiay/Category/add" class="btn btn-gold rounded" style="border-radius: 6px !important;">
            <i class="fas fa-plus mr-1"></i> Thêm Danh Mục
        </a>
    </div>

    <div class="table-responsive shadow-sm" style="border: 1px solid #eee;">
        <table class="table table-hover align-middle bg-white mb-0">
            <thead style="background-color: #111; color: #fff; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">
                <tr>
                    <th class="py-3 pl-4" width="10%">ID</th>
                    <th class="py-3" width="30%">Tên Danh Mục</th>
                    <th class="py-3" width="35%">Mô Tả</th>
                    <th class="py-3 text-center" width="25%">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td class="pl-4 font-weight-bold align-middle">#<?= $cat->id ?></td>
                        <td class="font-weight-bold text-uppercase align-middle"><?= htmlspecialchars($cat->name) ?></td>
                        <td class="text-muted small align-middle"><?= htmlspecialchars($cat->description) ?></td>
                        <td class="text-center align-middle">
                            <div class="btn-group" role="group">
                                <a href="/WebBanGiay/Category/show/<?= $cat->id ?>" class="btn btn-sm btn-outline-dark px-3">XEM</a>
                                <a href="/WebBanGiay/Category/edit/<?= $cat->id ?>" class="btn btn-sm btn-dark px-3">SỬA</a>
                                <a href="/WebBanGiay/Category/delete/<?= $cat->id ?>" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Xóa danh mục này?');">XÓA</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>