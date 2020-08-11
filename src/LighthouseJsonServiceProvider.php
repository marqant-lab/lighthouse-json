<?php

namespace Marqant\LighthouseJson;

use Illuminate\Support\ServiceProvider;

/** @package Marqant\LighthouseJosn */
class LighthouseJsonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerScalars();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // boot package
    }

    /**
     * Register scalars of this package.
     *
     * @return void
     */
    private function registerScalars(): void
    {
        config(['lighthouse.namespaces.scalars' => array_merge((array) config('lighthouse.namespaces.scalars'), (array) 'Marqant\\LighthouseJson\\GraphQL\\Scalars')]);
    }
}
