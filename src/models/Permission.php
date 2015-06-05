<?php

namespace Despark\LaravelPermissionRoles\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Permission extends Eloquent
{
    protected $fillable = ['name', 'slug', 'description'];

    public function roles()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\Role')->withTimestamps();
    }
}
