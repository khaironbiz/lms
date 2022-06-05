<?php

namespace App\Controllers\Admin;

use App\Models\Registrasi_model;
use App\Models\User_model;

class Registrasi extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_registrasi   = new Registrasi_model();
        $registrasi     = $m_registrasi->listing();
        $data = [
            'title'         => 'Registrasi List',
            'registrasi'    => $registrasi,
            'content'       => 'admin/registrasi/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function detail($has_register)
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_registrasi   = new Registrasi_model();
        $registrasi     = $m_registrasi->has_registrasi($has_register);
        $data = [
            'title'         => 'Registrasi List',
            'registrasi'    => $registrasi,
            'content'       => 'admin/registrasi/detail',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function approve($has_register)
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_registrasi   = new Registrasi_model();
        $registrasi     = $m_registrasi->has_registrasi($has_register);
        $m_user         = new User_model();
        $data = [
            'nama'          => $registrasi['nama'],
            'jenis_kelamin' => $registrasi['jenis_kelamin'],
            'tanggal_lahir' => $registrasi['tanggal_lahir'],
            'nik'           => $registrasi['nik'],
            'nira'          => $registrasi['nira'],
            'email'         => $registrasi['email'],
            'hp'            => $registrasi['hp'],
            'dpw'           => $registrasi['dpw'],
            'level_akses'   => $registrasi['level_akses'],
            'created_at'    => time(),
            'status'        => 1,
            'has_user'      => md5(uniqid()),

        ];
        $tambah_user = $m_user->save($data);
        if($tambah_user != "NULL"){
            echo "Data berhasil disimpan";
        }else{
            var_dump($data);
        }
    }
    //send email
    private function sendEmail($attachment, $to, $title, $message){

		$this->email->setFrom('hpii.ppni@gmail.com','khairon');
		$this->email->setTo($to);

		$this->email->attach($attachment);

		$this->email->setSubject($title);
		$this->email->setMessage($message);

		if(! $this->email->send()){
			return false;
		}else{
			return true;
		}
	}
}
