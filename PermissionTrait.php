<?php

namespace Despark\LaravelPermissionRoles;

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
        return $this->belongsToMany(__NAMESPACE__.'\\Role');
    }

    public function getRole()
    {
        return $this->roles->first();
    }

    public function changeRole($roleId)
    {
        $this->roles()->detach();
        $this->attachRole($roleId);
    }

    public function attachRole($ids)
    {
        $this->roles()->attach($ids);
    }

    public function detachRole($ids)
    {
        $this->roles()->detach($ids);
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
