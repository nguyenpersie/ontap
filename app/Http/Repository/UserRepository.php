<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    protected function getModel(): string
    {
        return User::class;
    }

    public function processingGetUsers(): ?Collection
    {
         return $this->model::all();
    }

    public function processingGetUser(string $id): ?User
    {
        return $this->model::find($id);
    }

    public function processingCreateUser(array $param): void
    {
        $this->model::create($param);
    }


    public function processingUpdateUser(User $modelUser, array $param): void
    {
        $modelUser->fill($param);
        $modelUser->save();
    }

    public function processingDeleteUser(User $modelUser): void
    {
        $modelUser->delete();
    }
}
