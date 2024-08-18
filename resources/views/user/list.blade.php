@extends('layout.master')
@section('title', 'Quan Ly Product')
@section('content')

<div class="row mb-3">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="bi bi-person-fill-add"></i> Thêm mới</button>
    </div>
    <div class="col-md-4 d-flex justify-content-start">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-right: 5px;">Tìm kiếm</button>
        <a href="{{ route('user.list') }}" type="button" id="reloadButton" class="btn btn-warning">Reload</a>
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
            <form action="{{ route('user.search') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-12">
                <input type="text" name="search" class="form-control" placeholder="Nhập họ tên" value="{{ request()->input('search') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <input type="email" name="fromEmail" class="form-control" placeholder="Nhập email" value="{{ request()->input('fromEmail') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <select class="form-control" name="groupRole">
                    <option>Chọn nhóm</option>
                    <option value="1" {{ request()->input('groupRole') == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ request()->input('groupRole') == 2 ? 'selected' : '' }}>Reviewer</option>
                    <option value="3" {{ request()->input('groupRole') == 3 ? 'selected' : '' }}>Editor</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                <select class="form-control" name="isActive">
                    <option>Chọn trạng thái</option>
                    <option value="2" {{ request()->input('isActive') == 2 ? 'selected' : '' }}>Tạm khóa</option>
                    <option value="1" {{ request()->input('isActive') == 1 ? 'selected' : '' }}>Đang hoạt động</option>
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
                  @foreach ($viewUsers as $user)
                  <tbody>
                      <tr>
                        <td>{{ ($viewUsers->currentPage() - 1) * $viewUsers->perPage() + $loop->iteration }}</td>
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
                                <option value="2" class="text-danger">Tạm khóa</option>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-outline-info btn-custom" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">Edit</a>
                            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-outline-danger btn-custom">Delete</a>
                            <button class="btn btn-outline-secondary btn-custom">Review</button>
                        </td>
                        @include('user.modal.edit')
                      </tr>
                  </tbody>
                  @endforeach
            </div>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $viewUsers->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
</div>
<!-- Button trigger modal -->
<!-- Modal -->
@include('user.modal.add')
@endsection
