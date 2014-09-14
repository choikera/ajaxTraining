<?php

class OptionsController extends BaseController {
    public function add() {
        return View::make( 'options/new' );
    }

    public function create() {
        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create option'
            ) );
        }

        $option_name = Input::get( 'option_name' );
        $option_value = Input::get( 'option_value' );

        $response = array(
            'status' => 'success',
            'msg' => 'Option created successfully',
        );

        return Response::json( $response );
    }
}
