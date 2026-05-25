<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

final class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canManageArticles($user);
    }

    public function view(User $user, Article $article): bool
    {
        return $this->canManageArticles($user);
    }

    public function create(User $user): bool
    {
        return $this->canManageArticles($user);
    }

    public function update(User $user, Article $article): bool
    {
        return $this->canManageArticles($user);
    }

    public function delete(User $user, Article $article): bool
    {
        return $this->canManageArticles($user);
    }

    public function restore(User $user, Article $article): bool
    {
        return $this->canManageArticles($user);
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return $this->canManageArticles($user);
    }

    private function canManageArticles(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin'], true);
    }
}
