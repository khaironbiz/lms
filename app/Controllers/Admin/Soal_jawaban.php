<?php

namespace App\Controllers\Admin;

use App\Models\Tugas_model;
use App\Models\Tugas_kelas_model;
use App\Models\Kelas_model;

class Soal extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_tugas    = new Tugas_model();
        $tugas      = $m_tugas->listing();

        $data = [
            'title'     => 'Data Base Tugas',
            'tugas'     => $tugas,
            'content'   => 'admin/tugas/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function edit($has_tugas)
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_tugas    = new Tugas_model();
        $tugas      = $m_tugas->has_tugas($has_tugas);

        $data = [
            'title'     => 'Data Base Tugas',
            'tugas'     => $tugas,
            'content'   => 'admin/tugas/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_tugas    = new Tugas_model();
        $tugas      = $m_tugas->listing();
        $data_validasi = [
            'nama_tugas' => [
                'rules' => 'required|min_length[3]|is_unique[tugas.nama_tugas]',
                'errors' => [
                    'required'      => 'Nama tugas harus diisi',
                    'min_length'    => 'Nama tugas minimal 3 karakter',
                    'is_unique'     => 'Nama tugas yang anda input : '.$this->request->getPost('nama_tugas').' sudah ada di data base'
                ]
            ]
        ];

        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if( $this->validate($data_validasi)){
                $nama_tugas = $this->request->getPost('nama_tugas');
                $time       = time();
                $data       = [
                    'nama_tugas'    => $nama_tugas,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_tugas'     => md5(uniqid())
                ];
//                var_dump($data);
                // masuk database
                $m_tugas->tambah($data);
                $this->session->setFlashdata('sukses', 'Data sukses ditambahkan');
                return redirect()->to(base_url('admin/tugas'));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Anda Tersesat');
            return redirect()->to(base_url('admin/tugas'));
        }
    }
    public function update($has_tugas){
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_tugas    = new Tugas_model();
        $tugas      = $m_tugas->listing();
        $data_validasi = [
            'nama_tugas' => [
                'rules' => 'required|min_length[3]|is_unique[tugas.nama_tugas]',
                'errors' => [
                    'required'      => 'Nama tugas harus diisi',
                    'min_length'    => 'Nama tugas minimal 3 karakter',
                    'is_unique'     => 'Nama tugas yang anda input : '.$this->request->getPost('nama_tugas').' sudah ada di data base'
                ]
            ]
        ];

        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if( $this->validate($data_validasi)){
                $nama_tugas = $this->request->getPost('nama_tugas');
                $time       = time();
                $data       = [
                    'nama_tugas'    => $nama_tugas,
                    'updated_at'    => $time,
                    'has_tugas'     => $has_tugas
                ];
//                var_dump($data);
                // masuk database
                $m_tugas->edit($data);
                $this->session->setFlashdata('sukses', 'Data sukses ditambahkan');
                return redirect()->to(base_url('admin/tugas'));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Anda Tersesat');
            return redirect()->to(base_url('admin/tugas'));
        }
    }
    public function kelas($has_kelas)
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_tugas    = new Tugas_model();
        $m_kelas    = new Kelas_model();
        $kelas      = $m_kelas->detail($has_kelas);
        $tugas      = $m_tugas->listing('tugas.nama_tugas','ASC');

        $data = [
            'title'     => 'Data Base Tugas',
            'kelas'     => $kelas,
            'tugas'     => $tugas,
            'content'   => 'admin/tugas/create_tugas_kelas',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create_soal($has_tugas_kelas){
        $id_user        = $this->session->get('id_user');
        $m_soal         = new Soal_model();
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->detail($has_tugas_kelas);
        $data_validasi  = [
            'soal' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Soal harus diisi',
                    'min_length'    => 'Soal minimal 3 karakter'
                ]
            ]
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){

                $id_tugas_kelas = $tugas_kelas['id_tugas_kelas'];
                $id_kelas       = $tugas_kelas['id_kelas'];
                $soal           = $this->request->getPost('soal');
                $has_soal       = md5(uniqid());
                $time           = time();
                $data_soal      = [
                    'id_tugas_kelas'    => $id_tugas_kelas,
                    'id_kelas'          => $id_kelas,
                    'soal'              => $soal,
                    'created_at'        => $time,
                    'created_by'        => $id_user,
                    'has_soal'          => $has_soal,
                ];
                $m_soal->tambah($data_soal);
                $soal           = $m_soal->detail($has_soal);
                $id_soal        = $soal['id_soal'];
                $jawabanA       = $this->request->getPost('a');
                $jawabanB       = $this->request->getPost('b');
                $jawabanC       = $this->request->getPost('c');
                $jawabanD       = $this->request->getPost('d');
                $jawabanE       = $this->request->getPost('e');
                $data_jawaban_a = [
                    'id_soal'       => $id_soal,
                    'jawaban'       => $jawabanA,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_jawaban'   => md5(uniqid())
                ];
                $data_jawaban_b = [
                    'id_soal'       => $id_soal,
                    'jawaban'       => $jawabanB,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_jawaban'   => md5(uniqid())
                ];
                $data_jawaban_c = [
                    'id_soal'       => $id_soal,
                    'jawaban'       => $jawabanC,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_jawaban'   => md5(uniqid())
                ];
                $data_jawaban_d = [
                    'id_soal'       => $id_soal,
                    'jawaban'       => $jawabanD,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_jawaban'   => md5(uniqid())
                ];
                $data_jawaban_e = [
                    'id_soal'       => $id_soal,
                    'jawaban'       => $jawabanE,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_jawaban'   => md5(uniqid())
                ];
            }else{
                echo "Gagal Validasi";
            }

        }else{
            echo "Anda Tersesat ";
        }

    }
    //send email
    private function sendEmail($attachment, $to, $title, $message){
        $email_server = 'hpii.ppni@gmail.com';
        $nama_email     = 'Server HPII';

		$this->email->setFrom($email_server,$nama_email);
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
