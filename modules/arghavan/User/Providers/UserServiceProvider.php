<?php


namespace arghavan\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Models\Permission;
use arghavan\User\Database\Seeders\UserTableSeeder;
use arghavan\User\Models\User;
use arghavan\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_route.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api/user_route.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','User');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        Factory::guessFactoryNamesUsing(static function (string $user){
            return 'arghavan\User\Database\Factories\\'.class_basename($user).'Factory';
        });

        config()->set('auth.providers.users.model',User::class);

        Gate::policy(User::class,UserPolicy::class);

        DatabaseSeeder::$seeders[] = UserTableSeeder::class;
    }


    public function boot(){

        config()->set('sidebar.items.users',[
            "icon" => 'i-users',
            "title" => 'کاربران',
            "url" => route('users.index'),
            "permission" => Permission::PERMISSION_MANAGE_USERS
        ]);

        config()->set('sidebar.items.usersInformation',[
            "icon" => 'i-user__information',
            "title" => 'اطلاعات کاربری',
            "url" => route('admin.profile')
        ]);
    }
}
