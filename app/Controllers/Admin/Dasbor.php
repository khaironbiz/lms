<?php

namespace App\Controllers\Admin;

class Dasbor extends BaseController
{
    public function index()
    {
        checklogin();
        admin();
        $data = ['title' => 'Dashboard Aplikasi',
            'content'    => 'admin/dasbor/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
}
