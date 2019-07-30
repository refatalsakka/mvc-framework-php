<?php

namespace System\Http\Middlewares;

use System\Middleware as Middleware;

class AuthenticateMiddleware extends Middleware
{
    public function handle()
    {   
        $request = $this->request->url();
        
        $login = $this->load->model('Login');

        $pagesWhenLogout = [
            '/login',
            '/login/submit',
            '/registration',
            '/registration/submit'
        ];

        if ($login->isLogged()) {
            
            if (in_array($request, $pagesWhenLogout)) $this->url->redirectTo('/');

        } else {

            if (! in_array($request, $pagesWhenLogout)) $this->url->redirectTo('/');
        }
    }
}