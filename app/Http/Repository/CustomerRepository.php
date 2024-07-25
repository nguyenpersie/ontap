<?php

namespace App\Http\Repository;

use App\Models\Mst_customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    protected $model;


    public function __construct()
    {
        $this->model = $this->getModel();
    }

    protected function getModel(): string
    {
        return Mst_customer::class;
    }

    public function processingGetCustomers(): ?Collection
    {
        return $this->model::all();
    }

    public function processingGetCustomer(string $id): ?Mst_customer
    {
        return $this->model::find($id);
    }

    public function processingCreateCustomer(array $param): void
    {
        $this->model::create($param);
    }

    public function processingUpdateCustomer(Mst_customer $model, array $param): void
    {
        $model->fill($param);
        $model->save();
    }
}
