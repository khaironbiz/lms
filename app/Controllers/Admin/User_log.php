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

        $data = [
            'title'     => 'Users Log',
            'user_log'  => $m_user_log->paginate(6,'logs'),
            'pager'     => $m_user_log->pager,
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
    // my log
    public function distinct($variabel)
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_user_log = new User_log_model();
        $user_log   = $m_user_log->distinct($variabel);

        $data = [
            'title'     => 'My Log',
            'user_log'  => $user_log,
            'content'   => 'admin/user_log/index',
        ];
var_dump($data);
//        echo view('admin/layout/wrapper', $data);
    }
    public function loop(){
        $m_user_log = new User_log_model();
        $user_log   = $m_user_log->findall();
        foreach ($user_log as $log){
            $time_berjalan = strtotime($log['tanggal_updates']);
            $tahun_berjalan = date('Y', $time_berjalan);
            $bulan_berjalan = date('m', $time_berjalan);
            $hari_berjalan  = date('d', $time_berjalan);

            if($hari_berjalan === "05"){
                echo $log['tanggal_updates']."<br>";

            }
        }
    }
    public function bulan($bulan){
        $tahun      = date('Y');
        $tahun_max  = $tahun+6;
        while($tahun <= $tahun_max){
            $tahun_berjalan = $tahun++;
            $bulan_berjalan = $tahun_berjalan.$bulan."00 00:00:00";
            $time_bulan     = strtotime($bulan_berjalan);
            $m_user_log     = new User_log_model();
            $user_log       = $m_user_log->like('tanggal_updates', $time_bulan)->findAll();
            var_dump($user_log);
        }

    }
}
