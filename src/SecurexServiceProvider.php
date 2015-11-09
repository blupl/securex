<?php namespace Blupl\Securex;

use Orchestra\Support\Providers\ServiceProvider;


/**
 * Class SecurexServiceProvider
 * @package Blupl\Securex
 */
class SecurexServiceProvider extends ServiceProvider
{
    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../');

        $this->addConfigComponent('blupl/securex', 'blupl/securex', $path.'/resources/config');
        $this->addLanguageComponent('blupl/securex', 'blupl/securex', $path.'/resources/lang');
        $this->addViewComponent('blupl/securex', 'blupl/securex', $path.'/resources/views');

        $this->mapExtensionConfig();
        $this->bootExtensionRouting($path);
        $this->bootExtensionMenuEvents();
    }


    /**
     * Boot extension menu handler.
     *
     * @return void
     */
    protected function bootExtensionMenuEvents()
    {
        $this->app['events']->listen('orchestra.ready: admin', 'Blupl\Securex\Http\Handlers\SecurexMenuHandler');
    }

    /**
     * Boot extension routing.
     *
     * @param  string  $path
     *
     * @return void
     */
    protected function bootExtensionRouting($path)
    {
        $this->app['router']->filter('media.manage', 'Orchestra\Foundation\Http\Filters\CanManage');
        $this->app['router']->filter('media.csrf', 'Orchestra\Foundation\Http\Filters\VerifyCsrfToken');

        require_once "{$path}/src/routes.php";
    }


    /**
     * Map extension config.
     *
     * @return void
     */
    protected function mapExtensionConfig()
    {
        $this->app['orchestra.extension.config']->map('blupl/securex', [
            'admin_role'  => 'orchestra/foundation::roles.admin',
            'member_role' => 'orchestra/foundation::roles.member',
        ]);
    }
}