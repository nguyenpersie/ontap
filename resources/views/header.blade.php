    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    </style>
    <div class="container mt-5">
        <button class="btn btn-danger logout-button" style="float: right;">
            <a href="{{url('logout')}}" style="color: white; text-decoration: none;"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </button>
    </div>
