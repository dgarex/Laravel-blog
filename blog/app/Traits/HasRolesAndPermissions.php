<?php
namespace App\Traits;

use App\Role;
use App\Permission;

trait HasRolesAndPermissions {

/**
* Связь модели User с моделью Role
*/
public function roles() {
return $this
->belongsToMany(Role::class, 'user_role')
->withTimestamps();
}


public function permissions() {
return $this
->belongsToMany(Permission::class, 'user_permission')
->withTimestamps();
}
}
