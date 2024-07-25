<?php



namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Repository\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function handleGetUsers(): ?Collection
    {

        return $this->userRepository->processingGetUsers();
    }

    public function handleGetUser(string $id): ?User
    {
        return $this->userRepository->processingGetUser($id);
    }

    public function handleCreateUser(array $param): void
    {
        $param = $this->processingCovertParamCreate($param);
        $this->userRepository->processingCreateUser($param);
    }

    protected function processingCovertParamCreate(array $param): array
    {
        $param['password'] = Hash::make($param['password']);

        return $param;
    }

    public function handleUpdateUser(User $modelUser, array $param): void
    {
        $this->userRepository->processingUpdateUser($modelUser, $param);
    }

    public function handleDeleteUser(User $modelUser): void
    {
        $this->userRepository->processingDeleteUser($modelUser);

    }
}
