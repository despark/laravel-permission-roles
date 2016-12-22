<?php

namespace Despark\LaravelPermissionRoles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public $tableColumns = [
        'name' => 'Name',
        'description' => 'Description',
        'slug' => 'Slug',
    ];

    public function permissions()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\Permission')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(__NAMESPACE__.'\\User')->withTimestamps();
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'permissions' => 'required',
        ];

        return $rules;
    }

    public static function getList()
    {
        return static::lists('name', 'id');
    }
}
