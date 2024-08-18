<?php
    $navItems = [
        ['route' => 'product.list', 'label' => 'Sản phẩm', 'header' => 'MÀN HÌNH QUẢN LÝ SẢN PHẨM'],
        ['route' => 'customer.list', 'label' => 'Khách hàng', 'header' => 'MÀN HÌNH QUẢN LÝ KHÁCH HÀNG'],
        ['route' => 'user.list', 'label' => 'Users', 'header' => 'MÀN HÌNH QUẢN LÝ USERS'],
    ];

    $activeRoute = Route::currentRouteName(); // Get the current route name
    $headerTitle = '';
    foreach ($navItems as $item) {
        if ($item['route'] === $activeRoute) {
            $headerTitle = $item['header'];
            break;
        }
    }
?>

<div class="container">
    <div class="header text-center">
        <h2><?php echo e($headerTitle); ?></h2>
    </div>
    <ul class="nav nav-tabs">
        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($activeRoute === $item['route'] ? 'active' : ''); ?>" href="<?php echo e(route($item['route'])); ?>"><?php echo e($item['label']); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /var/www/review/resources/views/layout/tabitem.blade.php ENDPATH**/ ?>