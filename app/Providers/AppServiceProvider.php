<?php

namespace App\Providers;

use App\Http\Services\NameGenerator;
use App\Http\Services\PokemonGenerator;
use App\Http\Services\StringToReverseTransformer;
use App\Http\Services\StringToUpperCaseTransformer;
use App\Http\UseCases\ProcessString;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Use Cases
         */
        $this->app->bind(ProcessString::class, function (Container $container) {
            return new ProcessString(
                [
                    $container->make(StringToUpperCaseTransformer::class),
                    $container->make(StringToReverseTransformer::class)
                ],
                [
                    $container->make(PokemonGenerator::class),
                    $container->make(NameGenerator::class)
                ]
            );
        });
    }
}
