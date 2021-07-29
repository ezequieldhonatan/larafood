<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\{
    Tenant\TenantRepositoryInterface,
    Category\CategoryRepositoryInterface
};

use App\Repositories\{
    Tenant\TenantRepository,
    Category\CategoryRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( TenantRepositoryInterface::class, TenantRepository::class );
        $this->app->bind( CategoryRepositoryInterface::class, CategoryRepository::class );

    } // register

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
