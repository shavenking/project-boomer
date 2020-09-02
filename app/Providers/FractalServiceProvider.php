<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use League\Fractal\{
    Manager,
    Resource\Item,
    Resource\Collection as ResourceCollection,
    Serializer\JsonApiSerializer
};

class FractalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $manager = new Manager;
        $manager->setSerializer(new JsonApiSerializer);

        $this->app->singleton(Manager::class, function () use ($manager) {
            return $manager;
        });

        $this->app->singleton('fractalTransform', function () use ($manager) {
            return function (
                $modelOrCollection,
                $transformer,
                $type
            ) use ($manager) {
                if ($modelOrCollection instanceof Model) {
                    $resource = new Item(
                        $modelOrCollection,
                        $transformer,
                        $type
                    );
                }

                if ($modelOrCollection instanceof Collection) {
                    $resource = new ResourceCollection(
                        $modelOrCollection,
                        $transformer,
                        $type
                    );
                }

                if (!isset($resource)) {
                    throw new \Exception;
                }

                return new Collection(
                    $manager->createData($resource)->toArray()
                );
            };
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
