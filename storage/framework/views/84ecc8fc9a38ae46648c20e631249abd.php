<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e($title); ?></title>
    <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<div class="container">
    <div class="header text-center">
        <h2>XÂY DỰNG MÀN QUẢN LÝ USER</h2>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('product.list')); ?>">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('customer.list')); ?>">Khách hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo e(route('user.list')); ?>">Users</a>
        </li>
    </ul>
    <?php echo $__env->make('alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row mb-3">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="bi bi-person-fill-add"></i> Thêm mới</button>
    </div>
    <div class="col-md-4 d-flex justify-content-start">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-right: 5px;">Tìm kiếm</button>
        <a href="<?php echo e(route('user.list')); ?>" type="button" id="reloadButton" class="btn btn-warning">Reload</a>
    </div>
</div>
        <!-- Button to trigger the modal -->

    <!-- Modal -->
    <div class="modal fade" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="searchModalLabel">Tìm kiếm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo e(route('user.search')); ?>" method="GET">
            <div class="row mb-3">
                <div class="col-md-12">
                <input type="text" name="search" class="form-control" placeholder="Nhập họ tên" value="<?php echo e(request()->input('search')); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <input type="email" name="fromEmail" class="form-control" placeholder="Nhập email" value="<?php echo e(request()->input('fromEmail')); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <select class="form-control" name="groupRole">
                    <option>Chọn nhóm</option>
                    <option value="1" <?php echo e(request()->input('groupRole') == 1 ? 'selected' : ''); ?>>Admin</option>
                    <option value="2" <?php echo e(request()->input('groupRole') == 2 ? 'selected' : ''); ?>>Reviewer</option>
                    <option value="3" <?php echo e(request()->input('groupRole') == 3 ? 'selected' : ''); ?>>Editor</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <select class="form-control" name="isActive">
                    <option>Chọn trạng thái</option>
                    <option value="2" <?php echo e(request()->input('isActive') == 2 ? 'selected' : ''); ?>>Tạm khóa</option>
                    <option value="1" <?php echo e(request()->input('isActive') == 1 ? 'selected' : ''); ?>>Đang hoạt động</option>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered user-table">
            <div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th>Trạng Thái</th>
                        <th>Hành động</th>
                      </tr>
                  </thead>
                  <?php $__currentLoopData = $viewUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tbody>
                      <tr>
                        <td><?php echo e(($viewUsers->currentPage() - 1) * $viewUsers->perPage() + $loop->iteration); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->group_role == 2): ?>
                                <option value="2">Reviewer</option>
                            <?php elseif($user->group_role > 2): ?>
                                <option value="3">Editor</option>
                            <?php elseif($user->group_role < 2): ?>
                                <option value="1">Admin</option>
                            <?php else: ?>
                            <?php endif; ?>
                        </td>
                        <td class="status-active">
                            <?php if($user->is_active==1): ?>
                                <option value="1" class="text-success">Đang hoạt động</option>
                                <?php else: ?>
                                <option value="2" class="text-danger">Tạm khóa</option>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-outline-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo e($user->id); ?>">Edit</a>
                            <a href="<?php echo e(route('user.delete', ['id' => $user->id])); ?>" class="btn btn-outline-danger btn-custom">Delete</a>
                            <button class="btn btn-outline-secondary btn-custom">Review</button>
                        </td>
                        <?php echo $__env->make('user.modal.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      </tr>
                  </tbody>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center">
    <?php echo e($viewUsers->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')); ?>

</div>
<!-- Button trigger modal -->
<!-- Modal -->
<?php echo $__env->make('user.modal.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /var/www/review/resources/views/user/user.blade.php ENDPATH**/ ?>