<?php

namespace App\Repositories;

use Prettus\Repository\Providers\RepositoryServiceProvider as PrettusRepositoryServiceProvider;

class RepositoryServiceProvider extends PrettusRepositoryServiceProvider
{
    public function register()
    {
        //execute parent register method
        parent::register();

        $this->bindRepositories();
    }

    public function bindRepositories()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
    }
}
