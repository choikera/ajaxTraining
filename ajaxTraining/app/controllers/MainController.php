<?php

class MainController extends BaseController {

    public function index()
    {
        if(!Auth::check())
            return Redirect::to('/');
        else
        {
            $msg = DB::table('messages')
                ->join('users', 'messages.userid', '=', 'users.id')->orderBy('messages.id', 'ASC')->select('messages.id as mid','messages.msg','users.firstname')->get();
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
                'tableElement' => '<tr><td>'. Input::get('message') .'</td><td>'.$poster->firstname.'</td><td><form action="deleteMessage/'. $mid .'" method="POST" id="deleteForm_'.  $mid .'"><a href="#" id="deleteItem" name="deleteForm_'.$mid.'">Delete!</a></form></td></tr>',
                'msg' =>    '<h4 id="errorPanel"><font color="blue">Message Success</font></h4>'
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
}
