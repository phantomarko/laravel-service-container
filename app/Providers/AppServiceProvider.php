<?php

namespace App\Providers;

use App\Http\Rules\NumberIsMultipleOfAnotherRule;
use App\Http\Rules\StringLengthIsInTheRangeRule;
use App\Http\Rules\ValidNumberRule;
use App\Http\Rules\ValidStringRule;
use App\Http\Services\NameGenerator;
use App\Http\Services\NumberHandler;
use App\Http\Services\PokemonGenerator;
use App\Http\Services\StringHandler;
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
         * Rules
         */
        $this->app->bind(
            'App\Http\Rules\StringLengthIsInTheRangeRule.OneToThree',
            function () {
                return new StringLengthIsInTheRangeRule(1, 3);
            }
        );
        $this->app->bind(
            'App\Http\Rules\StringLengthIsInTheRangeRule.FourToSix',
            function () {
                return new StringLengthIsInTheRangeRule(4, 6);
            }
        );
        $this->app->bind(
            'App\Http\Rules\StringLengthIsInTheRangeRule.SevenToNine',
            function () {
                return new StringLengthIsInTheRangeRule(7, 9);
            }
        );
        $this->app->bind(
            'App\Http\Rules\NumberIsMultipleOfAnotherRule.Two',
            function () {
                return new NumberIsMultipleOfAnotherRule(2);
            }
        );
        $this->app->bind(
            'App\Http\Rules\NumberIsMultipleOfAnotherRule.Three',
            function () {
                return new NumberIsMultipleOfAnotherRule(3);
            }
        );
        $this->app->bind(
            'App\Http\Rules\NumberIsMultipleOfAnotherRule.Five',
            function () {
                return new NumberIsMultipleOfAnotherRule(5);
            }
        );

        /*
         * Use Cases
         */
        $this->app->bind(ProcessString::class, function (Container $container) {
            return new ProcessString(
                new StringHandler(
                    $container->make('App\Http\Rules\StringLengthIsInTheRangeRule.OneToThree'),
                    new StringToUpperCaseTransformer(),
                    new StringHandler(
                        $container->make('App\Http\Rules\StringLengthIsInTheRangeRule.FourToSix'),
                        new StringToReverseTransformer(),
                        new StringHandler(
                            $container->make('App\Http\Rules\StringLengthIsInTheRangeRule.SevenToNine'),
                            new StringToUpperCaseTransformer(),
                            new StringHandler(
                                new ValidStringRule(),
                                new StringToReverseTransformer()
                            )
                        )
                    )
                ),
                new NumberHandler(
                    $container->make('App\Http\Rules\NumberIsMultipleOfAnotherRule.Five'),
                    new NameGenerator(),
                    new NumberHandler(
                        $container->make('App\Http\Rules\NumberIsMultipleOfAnotherRule.Three'),
                        new PokemonGenerator(),
                        new NumberHandler(
                            $container->make('App\Http\Rules\NumberIsMultipleOfAnotherRule.Two'),
                            new NameGenerator(),
                            new NumberHandler(
                                new ValidNumberRule(),
                                new PokemonGenerator()
                            )
                        )
                    )
                )
            );
        });
    }
}
