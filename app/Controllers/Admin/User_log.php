<?php

namespace App\Controllers\Admin;

use App\Models\User_log_model;

class User_log extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        admin();
        $id_user    = $this->session->get('id_user');
        $m_user_log = new User_log_model();
        $user_log   = $m_user_log->listing($id_user);

        $data = [
            'title'     => 'Users Log',
            'user_log'  => $user_log,
            'content'   => 'admin/user_log/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    // my log
    public function main()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_user_log = new User_log_model();
        $user_log   = $m_user_log->mylog($id_user);

        $data = [
            'title'     => 'My Log',
            'user_log'  => $user_log,
            'content'   => 'admin/user_log/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
}
