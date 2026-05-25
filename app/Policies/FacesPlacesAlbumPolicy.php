<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FacesPlacesAlbum;
use App\Models\User;

final class FacesPlacesAlbumPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canManageAlbums($user);
    }

    public function view(User $user, FacesPlacesAlbum $facesPlacesAlbum): bool
    {
        return $this->canManageAlbums($user);
    }

    public function create(User $user): bool
    {
        return $this->canManageAlbums($user);
    }

    public function update(User $user, FacesPlacesAlbum $facesPlacesAlbum): bool
    {
        return $this->canManageAlbums($user);
    }

    public function delete(User $user, FacesPlacesAlbum $facesPlacesAlbum): bool
    {
        return $this->canManageAlbums($user);
    }

    public function restore(User $user, FacesPlacesAlbum $facesPlacesAlbum): bool
    {
        return $this->canManageAlbums($user);
    }

    public function forceDelete(User $user, FacesPlacesAlbum $facesPlacesAlbum): bool
    {
        return $this->canManageAlbums($user);
    }

    private function canManageAlbums(User $user): bool
    {
        return in_array($user->role, ['admin', 'super_admin'], true);
    }
}
