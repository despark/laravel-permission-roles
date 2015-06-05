<?php

namespace Despark\LaravelPermissionRoles\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    protected $fillable = ['name', 'slug', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\Permission')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\User')->withTimestamps();
    }
}
