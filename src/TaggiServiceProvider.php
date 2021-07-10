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

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        Tag::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }
}
