<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function PelangganAccess(User $user)
    {
        return $user->role == 'Pelanggan';
    }

    public function AdminAccess(User $user)
    {
        return $user->role == 'Admin';
    }

    public function SuperAdminAccess(User $user)
    {
        return $user->role == 'Pemilik';
    }
}
