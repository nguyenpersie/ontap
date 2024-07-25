<?php



namespace App\Http\Services;

use App\Http\Repository\ProductRepository;
use App\Models\Mst_product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function handleGetProducts(): ?Collection
    {
        return $this->productRepository->processingGetProducts();
    }

    public function handleCreateProduct(array $param): void
    {
        $param = $this->processingCovertParamCreate($param);
        $this->productRepository->processingCreateProduct($param);
    }

    protected function processingCovertParamCreate(array $param): array
    {

    
        return $param;
    }

    public function handleGetProduct(string $id): ?Mst_product
    {
        return $this->productRepository->processingGetProduct($id);
    }

    public function handleUpdateProduct(Mst_product $modelProduct, array $param): void
    {
        $this->productRepository->processingUpdateProduct($modelProduct, $param);
    }

    public function handleDeleteProduct(Mst_product $modelProduct): void
    {
        $this->productRepository->processingDeleteProduct($modelProduct);
    }
}
