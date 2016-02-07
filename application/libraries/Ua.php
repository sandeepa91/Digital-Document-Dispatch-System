<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ua
{
    /**
     * Checks if the session is existing and returns the user type of the logged in user.
     * if the session is destroyed / expired, redirect to root.
     * @return String
     */
    public function check_login()
    {
        $CI_ = get_instance();
        $USER_OBJ = $CI_->session->userdata('user');

        if (isset($USER_OBJ->id)) {
            return $USER_OBJ->role;
        } else {
            redirect('/');
        }
    }

}