<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    @include('layout.header')
</head>
<body>
<div class="container">
@include('layout.tabitem')
@include('alert')
<div class="row mb-3">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="bi bi-person-fill-add"></i> Thêm mới</button>
    </div>
    <div class="col-md-4 d-flex justify-content-start">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-right: 5px;">Tìm kiếm</button>
        <a href="{{ route('customer.list') }}" type="button" id="reloadButton" class="btn btn-warning">Reload</a>
    </div>
    <div class="col-md-2">
        <a href="{{ route('customers.export') }}" type="button" class="btn btn-success"><i class="bi bi-download"></i> Export CSV</a>
    </div>
    <div class="col-md-2">
        <form method="POST" action="{{ route('customers.import') }}" enctype="multipart/form-data">
            @csrf
            <label for="import-file" class="btn btn-success" style="margin: 0;">
                <i class="bi bi-upload"></i> Import CSV
            </label>
            <input type="file" name="file" id="import-file" style="display: none;" onchange="submitForm()">
        </form>
    </div>
        <script>
            function submitForm() {
                document.querySelector('form').submit();
            }
        </script>
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
            <form action="{{ route('customers.search') }}" method="GET">
            <div class="row mb-3">
                <label for="search" class="form-label">Họ và tên</label>
                <div class="col-md-12">
                    <input type="text" id="search" name="search" class="form-control" placeholder="..." value="{{ request()->input('search') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="fromEmail" class="form-label">Email</label>
                <div class="col-md-12">
                    <input type="email" id="fromEmail" name="fromEmail" class="form-control" placeholder="@email.com" value="{{ request()->input('fromEmail') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="isActive" class="form-label">Chọn trạng thái</label>
                <div class="col-md-12">
                <select class="form-control" name="isActive" id="isActive">
                    <option>Chọn trạng thái</option>
                    <option value="2" {{ request()->input('isActive') == 2 ? 'selected' : '' }}>Tạm khóa</option>
                    <option value="1" {{ request()->input('isActive') == 1 ? 'selected' : '' }}>Đang hoạt động</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="fromAddress" class="form-label">Địa chỉ</label>
                <div class="col-md-12">
                    <input type="text" id="fromAddress" name="fromAddress" class="form-control" placeholder="..." value="{{ request()->input('fromAddress') }}">
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
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th></th>
                    </tr>
                </thead>
                {{-- @foreach ($viewCustomers as $index => $customer)
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
                @endforeach --}}
                @foreach ($viewCustomers as $customer)
                <tbody>
                    <tr>
                        <td>{{ ($viewCustomers->currentPage() - 1) * $viewCustomers->perPage() + $loop->iteration }}</td></td>
                        <td>
                            <span id="customer_name_{{ $customer->customer_id }}">{{ $customer->customer_name }}</span>
                            <input type="text" id="customer_name_input_{{ $customer->customer_id }}" value="{{ $customer->customer_name }}" style="display: none;" class="form-control">
                        </td>
                        <td>
                            <span id="email_{{ $customer->customer_id }}">{{ $customer->email }}</span>
                            <input type="email" id="email_input_{{ $customer->customer_id }}" value="{{ $customer->email }}" style="display: none;" class="form-control">
                        </td>
                        <td>
                            <span id="address_{{ $customer->customer_id }}">{{ $customer->address }}</span>
                            <input type="text" id="address_input_{{ $customer->customer_id }}" value="{{ $customer->address }}" style="display: none;" class="form-control">
                        </td>
                        <td>
                            <span id="tel_num_{{ $customer->customer_id }}">{{ $customer->tel_num }}</span>
                            <input type="text" id="tel_num_input_{{ $customer->customer_id }}" value="{{ $customer->tel_num }}" style="display: none;" class="form-control">
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-info btn-custom" id="edit_button_{{ $customer->customer_id }}" onclick="editCustomer({{ $customer->customer_id }}, event)">Edit</a>
                            <a href="#" class="btn btn-outline-success btn-custom" id="save_button_{{ $customer->customer_id }}" onclick="saveCustomer({{ $customer->customer_id }})" style="display: none;">Save</a>
                            <a href="#" class="btn btn-outline-danger btn-custom" id="cancel_button_{{ $customer->customer_id }}" onclick="cancelEdit({{ $customer->customer_id }}, event)" style="display: none;">Cancel</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
<script>
    function editCustomer(id, event) {
        event.preventDefault();
        // Stop event propagation to prevent scrolling up
        if (event)
        {

            //event.stopPropagation();
        }

        var customerName = document.getElementById('customer_name_' + id);
        var customerNameInput = document.getElementById('customer_name_input_' + id);
        var email = document.getElementById('email_' + id);
        var emailInput = document.getElementById('email_input_' + id);
        var address = document.getElementById('address_' + id);
        var addressInput = document.getElementById('address_input_' + id);
        var telNum = document.getElementById('tel_num_' + id);
        var telNumInput = document.getElementById('tel_num_input_' + id);
        var editButton = document.getElementById('edit_button_' + id);
        var saveButton = document.getElementById('save_button_' + id);
        var cancelButton = document.getElementById('cancel_button_' + id);

        if (customerName && customerNameInput && email && emailInput && address && addressInput && telNum && telNumInput && editButton && saveButton && cancelButton) {
            customerName.style.display = 'none';
            customerNameInput.style.display = 'block';
            email.style.display = 'none';
            emailInput.style.display = 'block';
            address.style.display = 'none';
            addressInput.style.display = 'block';
            telNum.style.display = 'none';
            telNumInput.style.display = 'block';
            editButton.style.display = 'none';
            saveButton.style.display = 'block';
            cancelButton.style.display = 'block';
        }
    }

    function cancelEdit(id, event) {
        // Stop event propagation to prevent scrolling up
        if (event) {
            event.preventDefault();
            //event.stopPropagation();
        }

        var customerName = document.getElementById('customer_name_' + id);
        var customerNameInput = document.getElementById('customer_name_input_' + id);
        var email = document.getElementById('email_' + id);
        var emailInput = document.getElementById('email_input_' + id);
        var address = document.getElementById('address_' + id);
        var addressInput = document.getElementById('address_input_' + id);
        var telNum = document.getElementById('tel_num_' + id);
        var telNumInput = document.getElementById('tel_num_input_' + id);
        var editButton = document.getElementById('edit_button_' + id);
        var saveButton = document.getElementById('save_button_' + id);
        var cancelButton = document.getElementById('cancel_button_' + id);

        if (customerName && customerNameInput && email && emailInput && address && addressInput && telNum && telNumInput && editButton && saveButton && cancelButton) {
            customerName.style.display = 'block';
            customerNameInput.style.display = 'none';
            customerName.style.display = 'block';
            customerNameInput.style.display = 'none';
            email.style.display = 'block';
            emailInput.style.display = 'none';
            address.style.display = 'block';
            addressInput.style.display = 'none';
            telNum.style.display = 'block';
            telNumInput.style.display = 'none';
            editButton.style.display = 'block';
            saveButton.style.display = 'none';
            cancelButton.style.display = 'none';
        }
    }

    function saveCustomer(id) {
    event.preventDefault();
    let customerNameInput = $('#' + 'customer_name_input_' + id).val();
    let emailInput = $('#' + 'email_input_' + id).val();
    let addressInput = $('#' + 'address_input_' + id).val();
    let telNumInput = $('#' + 'tel_num_input_' + id).val();

    if (customerNameInput && emailInput && addressInput && telNumInput) {
        $.ajax({
            type: 'POST',
            url: "{{ route('customer.post.update') }}",
            data: {
                id: id,
                customer_name: customerNameInput,
                email: emailInput,
                address: addressInput,
                tel_num: telNumInput,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Customer updated successfully!');
                    // Update the display fields with the new values
                    $('#' + 'customer_name_' + id).text(customerNameInput);
                    $('#' + 'email_' + id).text(emailInput);
                    $('#' + 'address_' + id).text(addressInput);
                    $('#' + 'tel_num_' + id).text(telNumInput);
                    // Hide the input fields and show the display fields
                    $('#' + 'customer_name_input_' + id).hide();
                    $('#' + 'email_input_' + id).hide();
                    $('#' + 'address_input_' + id).hide();
                    $('#' + 'tel_num_input_' + id).hide();
                    $('#' + 'customer_name_' + id).show();
                    $('#' + 'email_' + id).show();
                    $('#' + 'address_' + id).show();
                    $('#' + 'tel_num_' + id).show();
                    // Show the edit button and hide the save and cancel buttons
                    $('#' + 'edit_button_' + id).show();
                    $('#' + 'save_button_' + id).hide();
                    $('#' + 'cancel_button_' + id).hide();
                } else {
                    toastr.error('Error updating customer!');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error updating customer!');
            }
        });
    }
}
</script>
</div>
<div class="d-flex justify-content-center">
    {{ $viewCustomers->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
</div>
<!-- Button trigger modal -->
<!-- Modal -->
@include('customer.modal.add')
@include('layout.footer')
</body>
</html>
