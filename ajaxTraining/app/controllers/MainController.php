<?php

class MainController extends BaseController {

    public function index()
    {
        if(!Auth::check())
            return Redirect::to('/');
        else
        {
            $msg = DB::table('messages')
                ->join('users', 'messages.userid', '=', 'users.id')->orderBy('messages.id', 'ASC')->select('messages.id as mid','messages.msg','users.firstname','users.lastname')->get();
            return View::make('main.index')->with('msg', $msg);
        }
    }

    public function enterMessage()
    {
        if(Input::get('message') == '')
        {
            $response = array(
                'msg' => '<h4 id="errorPanel"><font color="red">Please input a message</font></h4>'
            );
        }
        else
        {
            $poster = DB::table('users')->where('id', Auth::user()->id)->first();
            $msgData = array(
                'userid' => Auth::user()->id,
                'msg' => Input::get('message')
            );
            DB::table('messages')->insert($msgData);
            $mid = DB::table('messages')->max('id');
            $response = array(
                'tableElement' => '<tr><td>'. Input::get('message') .'</td><td>'.$poster->firstname.' '.$poster->lastname.'</td><td><form action="deleteMessage/'. $mid .'" method="POST" id="deleteForm_'.  $mid .'"><a href="#" id="deleteItem" name="deleteForm_'.$mid.'">Delete!</a></form></td></tr>',
                'msg' =>    '<h4 id="errorPanel"><font color="blue"><center>Message Success</center></font></h4>'
            );
        }

        return $response;
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function deleteMessage($mid)
    {
        DB::table('messages')->where('id', $mid)->delete();
    }

    public function addUser()
    {
        $users = DB::table('users')->get();
        return View::make('main.addUser')->with('users', $users);
    }

    public function newUser()
    {
        $checkUname = DB::table('users')->where('username', Input::get('username'))->count();

        if($checkUname != 0)
        {
            $response = array(
                'msg' => '<h4 id="errorPanel"><font color="red">Username already exists!</font></h4>'
            );
        }
        else
        {
            $userData = array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'type' => Input::get('userType'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname')
            );
            DB::table('users')->insert($userData);
            $mid = DB::table('users')->max('id');
            $response = array(
                'tableElement' => '<tr><td>'. Input::get('username') .'</td>
                <td>'.Input::get('firstname').' '.Input::get('lastname').'</td>
                <td>'.Input::get('userType').'</td>
                <td><a href="#" name="deleteUser/'.$mid.'">Delete</a></td></tr>',
                'msg' =>    '<h4 id="errorPanel"><font color="blue"><center>User has been Created</center></font></h4>'
            );
        }

        return $response;
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
    }
}
