<?php

namespace App\Providers;

use App\Annotations\PermissionReader;
use App\Http\Controllers\Admin\UsersController;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\FilesystemCache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /** @var PermissionReader $reader */
        $reader = app(PermissionReader::class);
        //dd($reader->getPermissions());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->registerAnnotations();
        $this->app->bind(Reader::class, function(){
           return new CachedReader(
               new AnnotationReader(),
               new FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
               $debug = env('APP_DEBUG')
           );
        });
    }

    /**
     * Para realizar o loader nas annotations
     */
    protected function registerAnnotations()
    {
        $loader = require __DIR__.'/../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    }
}
