<?php

class XixiMiddleware extends \Slim\Middleware {

    /**
     * Initializes a new instance of the this ConditionalLoadMiddleware class.
     */
    public function __construct() { }

    /**
     * The call method for this middleware.
     */
    public function call() {
        $app = $this->app;

        $app->hook('slim.before.router', function() use($app) {
            //do stuff
            $fbLogged = true;
            $app->view()->set( 'fbLogged', $fbLogged);
        });

        $this->next->call();
    }
}