<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateForRequest;
use App\Http\Requests\UpdateForRequest;
use App\Http\Services\CustomerService;
use App\Imports\CustomersImport;
use App\Models\Mst_customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

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

        $getCustomers = Mst_customer::query()
        ->orderBy('is_active','asc')
        ->paginate(10);

        return view('customer.list', [
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

    // public function updateCustomer(UpdateForRequest $request, $id)
    // {
    //     $request->validate(
    //         UpdateForRequest::customerRules(),
    //         UpdateForRequest::customerMessages()
    //     );

    //     $modelCustomer = $this->customerService->handleGetCustomer($id);

    //     if(empty($modelCustomer)) {
    //         return redirect()->back()->with('error', 'Customer not found');
    //     }

    //     $this->customerService->handleUpdateCustomer($modelCustomer, $request->input());

    //     return redirect()->back()->with('success', 'Customer updated successfully');
    // }

    public function update(Request $request)
    {

        \Log::info('Update Customer Request', ['request' => $request->all()]);

        $validator = Validator::make(UpdateForRequest::customerRules(), UpdateForRequest::customerMessages(), $request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $modelCustomer = $this->customerService->handleGetCustomer($request->input('id', 1));

        if (empty($modelCustomer)) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        $this->customerService->handleUpdateCustomer($modelCustomer, $request->all());

        return response()->json(['success' => true, 'message' => 'Customer updated successfully']);
    }

    public function editCustomer(Request $request, $id)
    {
        $modelCustomer = $this->customerService->handleGetCustomer($id);

        if (empty($modelCustomer)) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $modelCustomer]);
    }




    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function import(Request $request)
    {
                // Validate the request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $filePath = storage_path('imports/' . $filename);

        $file->storeAs('imports', $filename);

        try {
            // Import the data from the file
            Excel::import(new CustomersImport, $filePath);

            // Return a success message
            return redirect()->back()->with('success', 'Import customers successfully.');
        } catch (\Exception $e) {
            // Return an error message
            return redirect()->back()->with('error', 'Error importing CSV file: ' . $e->getMessage());
        }
    }

    // public function import()
    // {
    //     Excel::import(new CustomersImport, storage_path('customers.xlsx'));

    //     return redirect()->back()->with('success', 'Import customers successfully.');
    // }

    public function cusSearch(Request $request)
    {
        $search = $request->input('search');
        $fromEmail = $request->input('fromEmail');
        $isActive = $request->input('isActive');
        $fromAddress = $request->input('fromAddress');

        $viewCustomers = Mst_customer::query();

            if (!empty($search)) {
                $viewCustomers = $viewCustomers->where('customer_name', 'LIKE', "%{$search}%");
            }

            if (!empty($fromEmail)) {
                $viewCustomers = $viewCustomers->orWhere('email', 'LIKE', "%{$fromEmail}%");
            }

            if (!empty($isActive)) {
                $viewCustomers = $viewCustomers->orWhere('is_active', 'LIKE', "%{$isActive}%");
            }

            if (!empty($fromAddress)) {
                $viewCustomers = $viewCustomers->orWhere('address', 'LIKE', "%{$fromAddress}%");
            }

            $viewCustomers = $viewCustomers->paginate(10);

        return view('customer.list', [
            'title' => 'Trang quản lý khách hàng',
            'titleAdd' =>'Thêm khách hàng',
            'titleEdit' =>'Chỉnh sửa khách hàng',
            'viewCustomers' => $viewCustomers,
        ]);
    }


}
