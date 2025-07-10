<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Config;
use App\Models\User;

class ConfigPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Config');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('view Config');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Config');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('update Config');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('delete Config');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Config');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('restore Config');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Config');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('replicate Config');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Config');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Config $config): bool
    {
        return $user->checkPermissionTo('force-delete Config');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Config');
    }
}
