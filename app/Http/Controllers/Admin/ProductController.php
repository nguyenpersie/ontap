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

        return view('product.product', [
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

        $file = $request->hasFile('product_image');

        $this->productService->handleCreateProduct($request->input());

        if($file) {
            $newFile = $request->file('product_image');
            $request = $newFile->store('product_image');
        }

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công.');
    }

    public function ShowProduct($id)
    {
        return $this->productService->handleGetProduct($id);
    }

    public function updateProduct(UpdateForRequest $request, $id)
    {
        $request->validate(
            UpdateForRequest::productRules(),
            UpdateForRequest::productMessages()
        );

        $modelProduct = $this->productService->handleGetProduct($id);

        if(empty($modelProduct)) {

            return redirect()->back()->with('error', 'Product not found');
        }

        $this->productService->handleUpdateProduct($modelProduct, $request->input());

        return redirect()->back()->with('success', 'Product updated successfully');
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

}
