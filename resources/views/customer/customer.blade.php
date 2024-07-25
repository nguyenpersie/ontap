<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    @include('header')
</head>
<body>
<div class="container">
    <div class="header text-center">
        <h2>XÂY DỰNG MÀN QUẢN LÝ KHÁCH HÀNG</h2>
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
            <a class="nav-link active" href="{{ route('customer.list') }}">Khách hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.list') }}">Users</a>
        </li>
    </ul>
    @include('alert')
    <div class="row mb-3">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="bi bi-person-fill-add"></i> Thêm mới</button>
        </div>
            <div class="col-md-2">
                <a href="{{ route('customers.import') }}" type="button" class="btn btn-success"><i class="bi bi-upload"></i> Import CSV</a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('customers.export') }}" type="button" class="btn btn-success"><i class="bi bi-download"></i> Export CSV</a>
            </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nhập họ và tên">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nhập email">
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option>Chọn trạng thái</option>
                <option value="0">Tạm khóa</option>
                <option value="1">Đang hoạt động</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Địa chỉ">
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary">Tìm kiếm</button>
        <button class="btn btn-secondary">Xóa tìm</button>
    </div>

    <div class="table-responsive">
        <table class="table table-Secondary table-hover">
            <div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th></th>
                      </tr>
                  </thead>
                  @foreach ($viewCustomers as $index => $customer)
                  <tbody>
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->tel_num }}</td>
                        <td>
                            <a href="{{ route('customer.edit',['id'=>$customer->customer_id]) }}" class="btn btn-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $customer->customer_id }}">✏️</a>
                        </td>
                        @include('customer.modal.edit')
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
@include('customer.modal.add')
@include('footer')
</body>
</html>
