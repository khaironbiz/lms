<?php

namespace App\Controllers\Admin;

use App\Models\Soal_model;
use App\Models\Tugas_metode_model;
use App\Models\Tugas_model;
use App\Models\Tugas_kelas_model;
use App\Models\Kelas_model;

class Tugas_kelas extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->listing();
        $data = [
            'title'         => 'Data Base Tugas',
            'tugas_kelas'   => $tugas_kelas,
            'content'       => 'admin/tugas_kelas/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function detail($has_tugas_kelas)
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->detail($has_tugas_kelas);
        $id_tugas_kelas = $tugas_kelas['id_tugas_kelas'];
        $m_soal         = new Soal_model();
        $soal           = $m_soal->list_id_tugas_kelas($id_tugas_kelas);
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->soon();
        $m_tugas        = new Tugas_model();
        $tugas          = $m_tugas->listing();
        $m_tugas_metode = new Tugas_metode_model();
        $tugas_metode   = $m_tugas_metode->listing();


        $data = [
            'title'         => 'Update Tugas Kelas',
            'tugas_kelas'   => $tugas_kelas,
            'tugas'         => $tugas,
            'kelas'         => $kelas,
            'soal'          => $soal,
            'tugas_metode'  => $tugas_metode,
            'content'       => 'admin/tugas_kelas/detail',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function edit($has_tugas_kelas)
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->detail($has_tugas_kelas);
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->soon();
        $m_tugas        = new Tugas_model();
        $tugas          = $m_tugas->listing();
        $m_tugas_metode = new Tugas_metode_model();
        $tugas_metode   = $m_tugas_metode->listing();

        $data = [
            'title'         => 'Update Tugas Kelas',
            'tugas_kelas'   => $tugas_kelas,
            'tugas'         => $tugas,
            'kelas'         => $kelas,
            'tugas_metode'  => $tugas_metode,
            'content'       => 'admin/tugas_kelas/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function tambah()
    {
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->soon();
        $m_tugas        = new Tugas_model();
        $tugas          = $m_tugas->listing();
        $m_tugas_metode = new Tugas_metode_model();
        $tugas_metode   = $m_tugas_metode->listing();

        $data = [
            'title'         => 'Tambah Tugas Kelas',
            'tugas'         => $tugas,
            'kelas'         => $kelas,
            'tugas_metode'  => $tugas_metode,
            'content'       => 'admin/tugas_kelas/create',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function update($has_tugas_kelas){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_tugas_kelas  = new Tugas_kelas_model();
        $data_validasi  = [
            'tgl_start' => [
                'rules' => 'required|valid_date[d-m-Y]',
                'errors' => [
                    'required'      => 'Tanggal mulai harus diisi',
                    'valid_date'    => 'Tanggal mulai tidak sesuai format'
                ]
            ],
            'jam_start' => [
                'rules' => 'required|valid_date[H:i:s]',
                'errors' => [
                    'required'      => 'Jam mulai harus diisi',
                    'valid_date'    => 'Jam mulai tidak sesuai format'
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Keterangan harus diisi',
                    'min_length'    => 'Keterangan minimal 3 karakter'
                ]
            ]
        ];

        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if( $this->validate($data_validasi)){
                $id_kelas       = $this->request->getPost('id_kelas');
                $id_tugas       = $this->request->getPost('id_tugas');
                $id_metode      = $this->request->getPost('id_metode');
                $date_mulai     = $this->request->getPost('tgl_start');
                $jam_mulai      = $this->request->getPost('jam_start');
                $date_selesai   = $this->request->getPost('tgl_selesai');
                $jam_selesai    = $this->request->getPost('jam_selesai');
                $time_start     = $date_mulai." ".$jam_mulai;
                $time_finish    = $date_selesai." ".$jam_selesai;
                $int_time_1     = strtotime($time_start);
                $keterangan     = $this->request->getPost('keterangan');
                $time       = time();
                $data       = [
                    'id_kelas'          => $id_kelas,
                    'id_tugas'          => $id_tugas,
                    'id_metode'         => $id_metode,
                    'keterangan'        => $keterangan,
                    'time_start'        => strtotime($time_start),
                    'time_finish'       => strtotime($time_finish),
                    'updated_at'        => time(),
                    'has_tugas_kelas'   => $has_tugas_kelas
                ];

                $m_tugas_kelas->edit($data);
                $this->session->setFlashdata('sukses', 'Data sukses ditambahkan');
                return redirect()->to(base_url('admin/tugas_kelas'));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Anda Tersesat');
            return redirect()->to(base_url('admin/tugas_kelas'));
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
            'content'   => 'admin/tugas_kelas/create_tugas_kelas',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        $id_user        = $this->session->get('id_user');
        $m_tugas        = new Tugas_model();
        $m_kelas        = new Kelas_model();
        $m_tugas_kelas  = new Tugas_kelas_model();

        $data_validasi  = [
            'tgl_start' => [
                'rules' => 'required|valid_date[d-m-Y]',
                'errors' => [
                    'required'      => 'Tanggal mulai harus diisi',
                    'valid_date'    => 'Tanggal mulai tidak sesuai format'
                ]
            ],
            'jam_start' => [
                'rules' => 'required|valid_date[H:i:s]',
                'errors' => [
                    'required'      => 'Jam mulai harus diisi',
                    'valid_date'    => 'Jam mulai tidak sesuai format'
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Keterangan harus diisi',
                    'min_length'    => 'Keterangan minimal 3 karakter'
                ]
            ]
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $id_kelas       = $this->request->getPost('id_kelas');
                $id_tugas       = $this->request->getPost('id_tugas');
                $id_metode      = $this->request->getPost('id_metode');
                $date_mulai     = $this->request->getPost('tgl_start');
                $jam_mulai      = $this->request->getPost('jam_start');
                $date_selesai   = $this->request->getPost('tgl_selesai');
                $jam_selesai    = $this->request->getPost('jam_selesai');
                $time_start     = $date_mulai." ".$jam_mulai;
                $time_finish    = $date_selesai." ".$jam_selesai;
                $int_time_1     = strtotime($time_start);
                $keterangan     = $this->request->getPost('keterangan');
                $uniqid         = uniqid();
                $data           = [
                    'id_kelas'          => $id_kelas,
                    'id_tugas'          => $id_tugas,
                    'id_metode'         => $id_metode,
                    'keterangan'        => $keterangan,
                    'time_start'        => strtotime($time_start),
                    'time_finish'       => strtotime($time_finish),
                    'created_at'        => time(),
                    'created_by'        => $id_user,
                    'has_tugas_kelas'   => md5($uniqid),
                ];
                $m_tugas_kelas->tambah($data);
                return redirect()->back()->with('sukses', 'Data Berhasil di Simpan');
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

        }else{
            echo "Anda Tersesat ";
        }

    }
    public function create_tugas_kelas($has_kelas){
        $id_user        = $this->session->get('id_user');
        $m_tugas        = new Tugas_model();
        $m_kelas        = new Kelas_model();
        $m_tugas_kelas  = new Tugas_kelas_model();
        $kelas          = $m_kelas->detail($has_kelas);
        $data_validasi  = [
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Keterangan harus diisi',
                    'min_length'    => 'Keterangan minimal 3 karakter'
                ]
            ]
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $id_kelas       = $kelas['id_kelas'];
                $id_tugas       = $this->request->getPost('id_tugas');
                $id_metode      = $this->request->getPost('id_metode');
                $date_mulai     = $this->request->getPost('tgl_start');
                $jam_mulai      = $this->request->getPost('jam_start');
                $date_selesai   = $this->request->getPost('tgl_finish');
                $jam_selesai    = $this->request->getPost('jam_finish');
                $time_start     = $date_mulai." ".$jam_mulai;
                $time_finish    = $date_selesai." ".$jam_selesai;
                $int_time_1     = strtotime($time_start);
                $keterangan     = $this->request->getPost('keterangan');
                $uniqid         = uniqid();
                $data           = [
                    'id_kelas'          => $id_kelas,
                    'id_tugas'          => $id_tugas,
                    'id_metode'         => $id_metode,
                    'keterangan'        => $keterangan,
                    'time_start'        => strtotime($time_start),
                    'time_finish'       => strtotime($time_finish),
                    'created_at'        => time(),
                    'created_by'        => $id_user,
                    'has_tugas_kelas'   => md5($uniqid),
                ];
                $m_tugas_kelas->tambah($data);

                return redirect()->back()->with('sukses', 'Data Berhasil di Simpan');
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
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
