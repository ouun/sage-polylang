<?php

namespace Ouun\Sage\Polylang\Providers;

use Ouun\Sage\Polylang\TranslationFinder;
use Ouun\Sage\Polylang\StringFinder;
use Illuminate\Support\ServiceProvider;

class TranslationFinderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('polylang.translation_finder', TranslationFinder::class);
        $this->app->bind('polylang.string_finder', StringFinder::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(function_exists('pll_register_string')) {
            $this->registerTranslations();
            $this->bindStringTranslationFilter();
        }
    }

    public function registerTranslations(): void
    {
        $translationFinder = $this->app['polylang.translation_finder'];
        if (!$translationFinder->shouldScan()) {
            return;
        }

        $config = $this->app['config']->get('polylang.translation_finder') ?: [];
        $strings = $this->findTranslatableStrings($config);
        $translationFinder->registerTranslations($strings);
    }

    protected function findTranslatableStrings(array $config): array
    {
        $stringFinder = $this->app['polylang.string_finder'];

        foreach (['file_extensions', 'ignore_paths', 'domain_whitelist'] as $option) {
            if (isset($config[$option])) {
                $stringFinder->$option = $config[$option];
            }
        }

        $paths = $config['paths'] ?? [
            get_template_directory(),
        ];

        return $stringFinder->scan($paths);
    }

    public function bindStringTranslationFilter(): void
    {
        add_filter('gettext', [$this->app['polylang.translation_finder'], 'gettext'], 10, 3);
    }
}
