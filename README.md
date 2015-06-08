# Laravel Permission Roles

## Installation

Open `composer.json` file of your project and add the following to the require array:
```json

"despark/laravel-permission-roles" : "1.0.*"

```

Now run `composer update` to install the new requirement.

Once it's installed, you need to register the service provider in `app/config/app.php` in the providers array:
```php

'providers' => array(
  ...
  'Despark\LaravelPermissionRoles\LaravelPermissionRolesServiceProvider',
);

```

Migrate required tables:
`php artisan migrate --package="despark/laravel-permission-roles"`
command will create: roles, role_user, permissions, permission_role - tables

## How to use it

- User Model Example

```php

use Despark\LaravelPermissionRoles\PermissionTrait;

class User extends Eloquent
{
    use PermissionTrait;
}

```

- Attach Role to User

```php

$user = new User();
$user = $user->create($input);
$user->attachRole(Input::get('role'));

```

- Update user Role

```php

$user = User::findOrFail($id)
$user->changeRole(Input::get('role'));

```

- Use Role Model

```php

use Despark\LaravelPermissionRoles\Role;

class RoleController extends BaseController
{
	Role::findOrFail($id);
}

```
Roles table
![alt tag](https://cloud.githubusercontent.com/assets/11192578/8034023/979fe46c-0dec-11e5-8173-6e254395520a.png)


- Add permissions to Role

```php

$input = Input::all();
$role = Role::findOrFail($id);
$role->update($input);
if ($role->permissions->count()) {
    $role->permissions()->detach($role->permissions->lists('id'));
    $role->permissions()->attach(array_get($input, 'permissions'));
}

```

- Check if current user has permission

```php

Auth::user()->canLoginToAdmin()  // permission slug 'login_to_admin'

Auth::user()->canAddUsers()  // permission slug 'edit_user'

Auth::user()->canEditUsers()  // permission slug 'edit_page'

```
Permissions table
![alt tag](https://cloud.githubusercontent.com/assets/11192578/8034024/997ece6a-0dec-11e5-9878-c1478f07f527.png)

## Permission based routes

filters.php

```php

Route::filter('admin.permission', function () {

    $route = explode('/', \Route::getCurrentRoute()->getPath());

    if (!Auth::user()->can('edit_'.str_replace('-', '_', array_get($route, 1)))) {
        throw new \Exception("Sorry, you don't have permission to access this page.");
    }
});

```
routes.php

```php

Route::group(
    ['before' => 'admin.permission'], function () {
        Route::resource('user', 'UserController');
    }
);

Route::group(
    ['before' => 'admin.permission'], function () {
        Route::resource('page', 'PageController');

    }
);

```










