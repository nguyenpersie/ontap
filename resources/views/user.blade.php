<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    @include('header')
</head>
<body>
<div class="container">
    <div class="header text-center">
        <h2>XÂY DỰNG MÀN QUẢN LÝ USER</h2>
    </div>
    <div style="float: right;">
        <div class="badge text-bg-primary text-wrap fs-6" style="width: 10rem;">
            <i>
                @if (Auth::User()->group_role==2)
                    <div value="2">Reviewer: {{ Auth::User()->name }}</div>
                @elseif (Auth::User()->group_role > 2)
                    <div value="3">Editor: {{ Auth::User()->name }}</div>
                @else
                    <div value="1">Admin: {{ Auth::User()->name }}</div>
                @endif
            </i>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.list') }}">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.list') }}">Khách hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('user.list') }}">Users</a>
        </li>
    </ul>
    @include('alert')
    <div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
        <i class="bi bi-person-fill-add"></i> Thêm mới</button>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nhập họ tên">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nhập email">
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option>Chọn nhóm</option>
                <option value="1">Admin</option>
                <option value="2">Reviewer</option>
                <option value="3">Editor</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option>Chọn trạng thái</option>
                <option value="0">Không hoạt động</option>
                <option value="1">Đang hoạt động</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary">Tìm kiếm</button>
        <button class="btn btn-secondary">Xóa tìm</button>
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
                  @foreach ($viewUsers as $index => $user)
                  <tbody>
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->group_role == 2)
                                <option value="2">Reviewer</option>
                            @elseif ($user->group_role > 2)
                                <option value="3">Editor</option>
                            @elseif ($user->group_role < 2)
                                <option value="1">Admin</option>
                            @else
                            @endif
                        </td>
                        <td class="status-active">
                            @if ($user->is_active==1)
                                <option value="1" class="text-success">Đang hoạt động</option>
                                @else
                                <option value="0" class="text-danger">Tạm khóa</option>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">✏️</a>
                            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger btn-custom">🗑️</a>
                            <button class="btn btn-secondary btn-custom">👤</button>
                        </td>
                        @include('modal.edit')
                      </tr>
                  </tbody>
                  @endforeach
            </div>
        </table>
    </div>

    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item"><a class="page-link" href="#">7</a></li>
            <li class="page-item"><a class="page-link" href="#">8</a></li>
            <li class="page-item"><a class="page-link" href="#">9</a></li>
            <li class="page-item"><a class="page-link" href="#">10</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
@include('modal.add')
@include('footer')
</body>
</html>
