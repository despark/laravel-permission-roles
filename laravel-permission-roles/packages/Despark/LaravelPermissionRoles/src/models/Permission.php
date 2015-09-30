<?php

namespace Despark\LaravelPermissionRoles;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public $tableColumns = [
        'name'        => 'Name',
        'description' => 'Description',
        'slug'        => 'Slug',
    ];

    public function roles()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\Role')->withTimestamps();
    }
}
