<?php



namespace App\Http\Services;

use App\Http\Repository\CustomerRepository;
use App\Models\Mst_customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handleGetCustomers(): ?Collection
    {
        return $this->customerRepository->processingGetCustomers();
    }

    public function handleGetCustomer(string $id): ?Mst_customer
    {
        return $this->customerRepository->processingGetCustomer($id);
    }

    public function handleCreateCustomer(array $param): void
    {
        $this->customerRepository->processingCreateCustomer($param);
    }

    public function handleUpdateCustomer(Mst_customer $model, array $param): void
    {
        $this->customerRepository->processingUpdateCustomer($model, $param);
    }


}
