<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .header {
        background-color: #e1eff7;
        padding: 10px 0;
    }
    .nav-tabs {
        margin-bottom: 20px;
    }
    .table thead th {
        background-color: #f44336;
        color: white;
    }
    .user-table td {
        vertical-align: middle;
    }
    .pagination {
        justify-content: center;
    }
    .status-active {
        color: green;
    }
    .btn-custom {
        padding: 0.5em;
        margin-right: 0.5em;
    }

    .logout-button {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .btn-custom {
    width: 70px; /* Set the desired fixed width */
    height: 40px; /* Set the desired fixed height */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    font-size: 14px; /* Adjust font size if needed */
    }

</style>
<div class="d-flex justify-content-end align-items-center mb-4">
    <div class="badge text-bg-secondary text-wrap fs-6 me-2">
        <?php if(Auth::User()->group_role==2): ?>
            <div value="2">Reviewer: <?php echo e(Auth::User()->name); ?></div>
        <?php elseif(Auth::User()->group_role > 2): ?>
            <div value="3">Editor: <?php echo e(Auth::User()->name); ?></div>
        <?php else: ?>
            <div value="1">Admin: <?php echo e(Auth::User()->name); ?></div>
        <?php endif; ?>
    </div>
    <button class="btn btn-danger me-1" style="margin-left: 10px;">
        <a href="<?php echo e(route('logout')); ?>" class="text-white text-decoration-none d-flex align-items-center">
            <i class="bi bi-person-circle"></i> Logout
        </a>
    </button>
</div>

<?php /**PATH /var/www/review/resources/views/header.blade.php ENDPATH**/ ?>