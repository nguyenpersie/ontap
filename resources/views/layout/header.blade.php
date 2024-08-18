<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Bootstrap CSS -->
<link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@2.2.3/dist/css/datepicker.min.css">

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
        @if (Auth::User()->group_role==2)
            <div value="2">Reviewer: {{ Auth::User()->name }}</div>
        @elseif (Auth::User()->group_role > 2)
            <div value="3">Editor: {{ Auth::User()->name }}</div>
        @else
            <div value="1">Admin: {{ Auth::User()->name }}</div>
        @endif
    </div>
    <button class="btn btn-danger me-1" style="margin-left: 10px;">
        <a href="{{ route('logout') }}" class="text-white text-decoration-none d-flex align-items-center">
            <i class="bi bi-person-circle"></i> Logout
        </a>
    </button>
</div>
