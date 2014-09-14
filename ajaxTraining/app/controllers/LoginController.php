<?php

class LoginController extends BaseController {

    public function index()
    {
        return View::make('login');
    }

    public function doLogin()
    {
        $userData = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if(Auth::attempt($userData))
        {
            $response = array(
                'hidden' => "<input type='hidden' name='testHidden' id='testHidden' value='true'/>"
            );
        }
        else
        {
            $response = array(
                'success' => "<font color='red'><a id='usernameDiv'>Login Failed</a></font>",
                'hidden' => "<input type='hidden' name='testHidden' id='testHidden' value='false'/>"
            );
        }

        return $response;
    }
}
