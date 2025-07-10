<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Pendaftaran;
use App\Models\User;

class PendaftaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Pendaftaran');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('view Pendaftaran');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Pendaftaran');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('update Pendaftaran');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('delete Pendaftaran');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Pendaftaran');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('restore Pendaftaran');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Pendaftaran');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('replicate Pendaftaran');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Pendaftaran');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pendaftaran $pendaftaran): bool
    {
        return $user->checkPermissionTo('force-delete Pendaftaran');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Pendaftaran');
    }
}
