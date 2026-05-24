<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $model): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, User $model): bool
    {
        // Admin thường không thể sửa Super Admin (trừ khi tự sửa chính mình - mặc dù role của chính mình cũng bị disable trên form)
        if ($model->isSuperAdmin() && !$user->isSuperAdmin()) {
            return false;
        }
        return true;
    }

    public function delete(User $user, User $model): bool
    {
        // LÕI LOGIC: Không ai được phép xóa Super Admin
        if ($model->isSuperAdmin()) {
            return false;
        }
        return true;
    }
}
