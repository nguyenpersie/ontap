<?php

namespace App\Http\Repository;

use App\Models\Mst_product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    protected $model;


    public function __construct()
    {
        $this->model = $this->getModel();
    }

    protected function getModel(): string
    {
        return Mst_product::class;
    }

    public function processingGetProducts(): ?Collection
    {
        return $this->model::all();
    }

    public function processingCreateProduct(array $param): void
    {
        $this->model::create($param);
    }

    public function processingGetProduct(string $id): ?Mst_product
    {
        return $this->model::find($id);
    }

    public function processingUpdateProduct(Mst_product $modelProduct, array $param): void
    {
        $modelProduct->fill($param);
        $modelProduct->save();
    }

    public function processingDeleteProduct(Mst_product $modelProduct): void
    {
        $modelProduct->delete();
    }
}
