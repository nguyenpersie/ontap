<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateForRequest;
use App\Http\Requests\UpdateForRequest;
use App\Http\Services\ProductService;
use App\Models\Mst_product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $getProducts = $this->productService->handleGetProducts();

        $getProducts = Mst_product::query()
            ->orderBy('is_sales','asc')
            ->paginate(20);

        return view('product.list', [
            'title' => 'Trang quản lý sản phẩm',
            'titleAdd' =>'Thêm sản phẩm',
            'titleEdit' =>'Chỉnh sửa sản phẩm',
            'viewProducts' => $getProducts,
        ]);
    }

    public function postCreate(CreateForRequest $request)
    {
        $request->validate(
            CreateForRequest::productRules(),
            CreateForRequest::productMessages()
        );

        $productData = $request->input();

        if ($request->hasFile('product_image')) {
            $productData['product_image'] = $request->file('product_image')->store('product_image', ['disk' => 'public']);
        }

        $this->productService->handleCreateProduct($productData);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Product data was successfully saved!',
        //     'image_path' => asset('storage/' . $productData['product_image']),
        // ]);
        return redirect()->back()->with('success', 'Product data was successfully saved!');
    }

    public function ShowProduct($id)
    {
        $data =  $this->productService->handleGetProduct($id);

        if (empty($data)) {
            return respondWithJsonError(DATA_NOT_FOUND, NOT_FOUND_CODE);
        }

        $html = view('product.modal.ajax_edit', [
            'product' => $data,
        ])->render();


        return response()->json([ 'html' => $html]);
    }

    public function updateProduct(UpdateForRequest $request, $id)
    {
        $request->validate(
            UpdateForRequest::productRules(),
            UpdateForRequest::productMessages()
        );

        $modelProduct = $this->productService->handleGetProduct($id);

        // if(empty($modelProduct)) {

        //     return redirect()->back()->with('error', 'Product not found');
        // }

        $productData = $request->except('product_image');

        if ($request->hasFile('product_image')) {
            $productData['product_image'] = $request->file('product_image')->store('product_image', ['disk' => 'public']);
        } elseif (file_exists(public_path($modelProduct->product_image)))  {
            $productData['product_image'] = $modelProduct->product_image;
        } else {
            $productData['product_image'] = null; // or a default image URL
        }

        $this->productService->handleUpdateProduct($modelProduct, $productData);

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }
    }

    public function deleteProduct($id)
    {
        $modelProduct = $this->productService->handleGetProduct($id);

        if(empty($modelProduct)) {

            return redirect()->back()->with('error', 'Product not found');
        }

        $this->productService->handleDeleteProduct($modelProduct);

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function proSearch(Request $request)
    {
        $search = $request->input('search');
        $isSales = $request->input('isSales');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');

        $viewProducts = Mst_product::query();

        if (!empty($search)) {
            $viewProducts = $viewProducts->where('product_name', 'LIKE', "%{$search}%");
        }

        if (!empty($priceFrom)) {
            $viewProducts = $viewProducts->where('product_price', '>=', $priceFrom);
        }

        if (!empty($priceTo)) {
            $viewProducts = $viewProducts->where('product_price', '<=', $priceTo);
        }

        if (!empty($isSales)) {
            $viewProducts = $viewProducts->orWhere('is_sales', 'LIKE', "%{$isSales}%");
        }

        $viewProducts = $viewProducts->paginate(10);

        return view('product.list', [
            'title' => 'Trang quản lý sản phẩm',
            'titleAdd' =>'Thêm sản phẩm',
            'titleEdit' =>'Chỉnh sửa sản phẩm',
            'viewProducts' => $viewProducts,
        ]);
    }
}
