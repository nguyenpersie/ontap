<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateForRequest;
use App\Http\Requests\UpdateForRequest;
use App\Http\Services\CustomerService;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }


    public function index()
    {
        $getCustomers = $this->customerService->handleGetCustomers();

        return view('customer.customer', [
            'title' => 'Trang quản lý khách hàng',
            'titleAdd' =>'Thêm khách hàng',
            'titleEdit' =>'Chỉnh sửa khách hàng',
            'viewCustomers' => $getCustomers,
        ]);
    }
    
    public function postCreate(CreateForRequest $request)
    {
        $request->validate(
            CreateForRequest::customerRules(),
            CreateForRequest::customerMessages()
        );

        $this->customerService->handleCreateCustomer($request->input());

        return redirect()->back()->with('success', 'Thêm khách hàng thành công.');
    }

    public function showEdit($id)
    {
        return $this->customerService->handleGetCustomer($id);

    }

    public function updateCustomer(UpdateForRequest $request, $id)
    {
        $request->validate(
            UpdateForRequest::customerRules(),
            UpdateForRequest::customerMessages()
        );

        $modelCustomer = $this->customerService->handleGetCustomer($id);

        if(empty($modelCustomer)) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $this->customerService->handleUpdateCustomer($modelCustomer, $request->input());

        return redirect()->back()->with('success', 'Customer updated successfully');
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function import()
    {
        Excel::import(new CustomersImport, storage_path('customers.xlsx'));

        return redirect()->back()->with('success', 'Import customers successfully.');
    }
}
