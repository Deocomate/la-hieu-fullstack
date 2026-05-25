<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\SocialFeed;
use App\Models\User;

final class SocialFeedPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SocialFeed $socialFeed): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SocialFeed $socialFeed): bool
    {
        return true;
    }

    public function delete(User $user, SocialFeed $socialFeed): bool
    {
        return true;
    }
}
