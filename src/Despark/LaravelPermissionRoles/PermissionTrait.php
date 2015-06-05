<?php

namespace Despark\LaravelPermissionRoles;

use Despark\LaravelPermissionRoles\Models\Role;

trait PermissionTrait
{
    public function __call($method, $params = [])
    {
        if (starts_with($method, 'is') and $method != 'is') {
            return $this->is(snake_case(substr($method, 2)));
        } elseif (starts_with($method, 'can') and $method != 'can') {
            return $this->can(snake_case(substr($method, 3)));
        } else {
            $query = $this->newQuery();

            return call_user_func_array([$query, $method], $params);
        }
    }

    public function roles()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\Roles')->withTimestamps();
    }

    public function attachRole($name)
    {
        $ids = is_array($name) ? $name : func_get_args();
        foreach ($ids as $search) {
            $role = Role::search($name)->firstOrFail();
            $this->roles()->attach($role->id);
        }
    }

    public function detachRole($name)
    {
        $roles = is_array($name) ? $name : func_get_args();
        foreach ($roles as $role) {
            $role = Role::search($role)->firstOrFail();
            $this->roles()->detach($role->id);
        }
    }

    public function detachRoles()
    {
        $this->detachRole($this->roles->lists('id'));
    }

    public function is($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name || $role->slug == $name) {
                return true;
            }
        }

        return false;
    }

    public function can($name)
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name == $name || $permission->slug == $name) {
                    return true;
                }
            }
        }

        return false;
    }
}
