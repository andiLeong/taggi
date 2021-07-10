<?php

namespace Andileong\Taggi;

use Andileong\Taggi\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class TaggiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/taggi.php', 'taggi');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'taggi-migrations');

        $this->publishes([
            __DIR__.'/../config/taggi.php' => config_path('taggi.php')
        ], 'taggi-config');

        Tag::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }
}
