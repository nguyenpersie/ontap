<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e($title); ?></title>
    <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<div class="container">
    <div class="header text-center">
        <h2>XÂY DỰNG MÀN QUẢN LÝ SẢN PHẨM</h2>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo e(route('product.list')); ?>">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('customer.list')); ?>">Khách hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('user.list')); ?>">Users</a>
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
            <a href="<?php echo e(route('product.list')); ?>" type="button" id="reloadButton" class="btn btn-warning">Reload</a>
        </div>
    </div>

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="searchModalLabel">Tìm kiếm</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo e(route('products.search')); ?>" method="GET">
                <div class="row mb-3">
                    <label for="product_name" class="form-label">Tên sản phẩm</label>
                    <div class="col-md-12">
                        <input type="text" id="product_name" name="search" class="form-control" placeholder="..." value="<?php echo e(request()->input('search')); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="isSales" class="form-label">Chọn trạng thái</label>
                  <div class="col-md-12">
                    <select class="form-control" id="isSales" name="isSales">
                        <option>Chọn trạng thái</option>
                        <option value="1" <?php echo e(request()->input('isSales') == 1 ? 'selected' : ''); ?>>Đang bán</option>
                        <option value="2" <?php echo e(request()->input('isSales') == 2 ? 'selected' : ''); ?>>Ngừng bán</option>
                        <option value="3" <?php echo e(request()->input('isSales') == 3 ? 'selected' : ''); ?>>Hết hàng</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="priceFrom" class="form-label">Giá bán từ</label>
                    <div class="col-md-12">
                        <input type="text" id="priceFrom" class="form-control" placeholder="$" name="priceFrom" value="<?php echo e(request()->input('priceFrom')); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="priceTo" class="form-label">Giá bán đến</label>
                    <div class="col-md-12">
                        <input type="text" id="priceTo" class="form-control" placeholder="$" name="priceTo" value="<?php echo e(request()->input('priceTo')); ?>">
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
        <table class="table table-Secondary table-hover">
            <div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Tình trạng</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php $__currentLoopData = $viewProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tbody>
                        <tr>
                        <td><?php echo e(($viewProducts->currentPage() - 1) * $viewProducts->perPage() + $loop->iteration); ?></td>
                        <td><?php echo e($product->product_name); ?></td>
                        <td><?php echo e($product->deccription); ?></td>
                        <td><?php echo e($product->product_price); ?> $</td>
                        <td>
                            <?php if($product->is_sales == 2): ?>
                                <option value="2" class="text-danger">Ngừng bán</option>
                            <?php elseif($product->is_sales > 2): ?>
                                <option value="3" class="text-dark">Hết hàng</option>
                            <?php elseif($product->is_sales < 2): ?>
                                <option value="1" class="text-success">Đang bán</option>
                            <?php else: ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('product.edit',['id'=>$product->product_id])); ?>" class="btn btn-outline-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo e($product->product_id); ?>">Edit</a>
                            <a href="<?php echo e(route('product.delete', ['id' => $product->product_id])); ?>" class="btn btn-outline-danger btn-custom">Delete</a>
                        </td>
                        <?php echo $__env->make('product.modal.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center">
    <?php echo e($viewProducts->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5')); ?>

</div>
<!-- Button trigger modal -->
<!-- Modal -->
<?php echo $__env->make('product.modal.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /var/www/review/resources/views/product/product.blade.php ENDPATH**/ ?>