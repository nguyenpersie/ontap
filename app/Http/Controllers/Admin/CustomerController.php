<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomersExport;
use App\Exports\NotifyUserOfCompletedExport;
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
        //return Excel::download(new CustomersExport, 'customers.csv', \Maatwebsite\Excel\Excel::CSV);

        (new CustomersExport)->queue('customers.csv')->allOnQueue('ExportsCustomer');

        return back()->withSuccess('Export started!');
    }

    public function import(Request $request)
    {
        $start = microtime(true);
                // Validate the request
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $filePath = storage_path('/app/imports/' . $filename);

        $file->storeAs('imports', $filename);

        try {
            // Import the data from the file
            // Excel::queueImport(new CustomersImport, $filePath);

            Excel::queueImport(new CustomersImport, $filePath)->onQueue('ImportsCustomer');

            $end = microtime(true);
            $executionTime = round($end - $start, 3);
            \Log::debug('Command html decode translation. Spend time: ' . $executionTime . 's');

            // Return a success message
            return redirect()->back()->with('success', 'Import customers successfully.');
        } catch (\Exception $e) {
            $end = microtime(true);
            $executionTime = round($end - $start, 3);
            \Log::debug('Command html decode translation. Spend time: ' . $executionTime . 's');
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
        $filters = [
            'customer_name' => $request->input('search'),
            'email' => $request->input('fromEmail'),
            'is_active' => $request->input('isActive'),
            'address' => $request->input('fromAddress'),
        ];

        $viewCustomers = Mst_customer::query();

        foreach ($filters as $column => $value) {
            if (!empty($value)) {
                $viewCustomers->orWhere($column, 'LIKE', "%{$value}%");
            }
        }

        $viewCustomers = $viewCustomers->paginate(10);

        return view('customer.list', [
            'viewCustomers' => $viewCustomers,
        ]);
    }
}
