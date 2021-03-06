<?php

namespace Newride\Silicon\bundles\extensions\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Newride\Silicon\bundles\extensions\Facades\Extensions as ExtensionsFacade;
use Newride\Silicon\bundles\extensions\Services\Extensions;

class ExtensionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('extensions', function ($app) {
            $extensions = $app->make(Extensions::class);
            $extensions->preload();

            return $extensions;
        });

        foreach ($this->app->make('extensions')->all() as $extension) {
            $this->app->register($extension);
        }

        AliasLoader::getInstance()->alias('Extensions', ExtensionsFacade::class);
    }
}
