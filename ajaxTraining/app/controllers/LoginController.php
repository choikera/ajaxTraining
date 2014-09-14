<?php

class LoginController extends BaseController {

    public function index()
    {
        return View::make('login');
    }

    public function doLogin()
    {
        if(Input::get('username') == 'admin' && Input::get('password') == 'password')
            $response = "<a id='usernameDiv'>Login Successful</a>";
        else
            $response = "<a id='usernameDiv'>Login Failed</a>";

        return $response;
    }
}
