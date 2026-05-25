<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ArticleCategory;
use App\Models\User;

final class ArticleCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canManageArticleCategories($user);
    }

    public function view(User $user, ArticleCategory $articleCategory): bool
    {
        return $this->canManageArticleCategories($user);
    }

    public function create(User $user): bool
    {
        return $this->canManageArticleCategories($user);
    }

    public function update(User $user, ArticleCategory $articleCategory): bool
    {
        return $this->canManageArticleCategories($user);
    }

    public function delete(User $user, ArticleCategory $articleCategory): bool
    {
        return $this->canManageArticleCategories($user);
    }

    private function canManageArticleCategories(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin'], true);
    }
}
