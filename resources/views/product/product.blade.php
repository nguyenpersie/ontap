<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    @include('header')
</head>
<body>
<div class="container">
    <div class="header text-center">
        <h2>XÂY DỰNG MÀN QUẢN LÝ SẢN PHẨM</h2>
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
            <a class="nav-link active" href="{{ route('product.list') }}">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.list') }}">Khách hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.list') }}">Users</a>
        </li>
    </ul>
    @include('alert')
    <div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
        <i class="bi bi-person-fill-add"></i> Thêm mới</button>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option>Chọn trạng thái</option>
                <option value="0">Không hoạt động</option>
                <option value="1">Đang hoạt động</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="giá bán từ">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="giá bán đến">
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
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Tình trạng</th>
                        <th></th>
                      </tr>
                  </thead>
                  @foreach ($viewProducts as $index => $product)
                  <tbody>
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->deccription }}</td>
                        <td>{{ $product->product_price }} $</td>
                        <td>
                            @if ($product->is_sales == 2)
                                <option value="2" class="text-danger">Ngừng bán</option>
                            @elseif ($product->is_sales > 2)
                                <option value="3" class="text-dark">Hết hàng</option>
                            @elseif ($product->is_sales < 2)
                                <option value="1" class="text-success">Đang bán</option>
                            @else
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('product.edit',['id'=>$product->product_id]) }}" class="btn btn-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $product->product_id }}">✏️</a>
                            <a href="{{ route('product.delete', ['id' => $product->product_id]) }}" class="btn btn-danger btn-custom">🗑️</a>
                        </td>
                        @include('product.modal.edit')
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
@include('product.modal.add')
@include('footer')
</body>
</html>
