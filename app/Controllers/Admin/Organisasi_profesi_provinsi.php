<?php

namespace App\Controllers\Admin;

use App\Models\Provinsi_model;
use App\Models\Profesi_model;
use App\Models\Organisasi_profesi_model;
use App\Models\Organisasi_profesi_provinsi_model;

class Organisasi_profesi_provinsi extends BaseController{
    
    public function index(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_op           = new Organisasi_profesi_model();
        $m_op_provinsi  = new Organisasi_profesi_provinsi_model();
        $m_provinsi     = new Provinsi_model();
        $op             = $m_op->listing();
        $op_provinsi    = $m_op_provinsi->listing();
        $provinsi       = $m_provinsi->listing();
        $data = [
            'title'         => 'Daftar Organisasi Profesi',
            'op'            => $op,
            'op_provinsi'   => $op_provinsi,
            'provinsi'      => $provinsi, 
            'content'       => 'admin/organisasi_profesi_provinsi/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function provinsi($id_provinsi){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_op           = new Organisasi_profesi_model();
        $m_op_provinsi  = new Organisasi_profesi_provinsi_model();
        $op             = $m_op->listing();
        $op_provinsi    = $m_op_provinsi->provinsi($id_provinsi);
        $data = [
            'title'         => 'Daftar Organisasi Profesi',
            'op'            => $op,
            'op_provinsi'   => $op_provinsi,
            'content'       => 'admin/organisasi_profesi_provinsi/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    //create
    public function create(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_op           = new Organisasi_profesi_model();
        $m_op_provinsi  = new Organisasi_profesi_provinsi_model();
        if ($this->request->getMethod() === 'post' ){
            if (!$this->validate(
                [
                    'id_op'     => [
                        'rules'     => 'required',
                        'errors'    => [
                            'required'      => 'Nama Organisasi Profesi harus dipilih'
                        ]
                    ],
                    'id_provinsi'  => [
                        'rules'     => 'required',
                        'errors'    => [
                            'required'      => 'nama organisasi harus diisi'
                        ]
                    ] 
                ]
            )
            )
            {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else
            {
                $id_op                  = $this->request->getPost('id_op');
                $id_provinsi            = $this->request->getPost('id_provinsi');
                $pimpinan_op_provinsi   = $this->request->getPost('pimpinan_op_provinsi');
                $alamat_op_provinsi     = $this->request->getPost('alamat_op_provinsi');
                $web_op_provinsi        = $this->request->getPost('web_op_provinsi');
                $email_op_provinsi      = $this->request->getPost('email_op_provinsi');
                $hp_op_provinsi         = $this->request->getPost('hp_op_provinsi');
                $telp_op_provinsi       = $this->request->getPost('telp_op_provinsi');
                $data           = [                
                    'id_op'                 => $id_op,
                    'id_provinsi'           => $id_provinsi,
                    'pimpinan_op_provinsi'  => $pimpinan_op_provinsi,
                    'alamat_op_provinsi'    => $alamat_op_provinsi,
                    'web_op_provinsi'       => $web_op_provinsi,
                    'email_op_provinsi'     => $email_op_provinsi,
                    'hp_op_provinsi'        => $hp_op_provinsi,
                    'telp_op_provinsi'      => $telp_op_provinsi,
                    'created_by'            => $this->session->get('id_user'),
                    'created_at'            => date('Y-m-d H:i:s'),
                    'has_op_provinsi'       => md5(uniqid())
                ];
                var_dump($data);
                // masuk database
                $tambah_op_provinsi = $m_op_provinsi->tambah($data);
                if($tambah_op_provinsi = true)
                {
                    $this->session->setFlashdata('sukses', 'Data telah ditambah');
                    return redirect()->to(base_url('admin/organisasi_profesi_provinsi'));
                }else
                {
                    $this->session->setFlashdata('warning', 'Data gagal ditambah');
                    return redirect()->to(base_url('admin/organisasi_profesi_provinsi'));
                }
            }
            
            
        }else{
            echo "Anda Tersesat";
        }
    }
    //detail
    public function detail($has_op_provinsi){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_profesi      = new Profesi_model();
        $m_op           = new Organisasi_profesi_model();
        $m_opp          = new Organisasi_profesi_provinsi_model();
        $opp            = $m_opp->detail($has_op_provinsi);
        $profesi        = $m_profesi->listing();
        $data = [
                'title'     => $opp->nama_op,
                'opp'       => $opp,
                'profesi'   => $profesi,
                'content'   => 'admin/organisasi_profesi_provinsi/detail',
            ];
            echo view('admin/layout/wrapper', $data);
    }
    // edit
    public function update($has_op){
        $m_op           = new Organisasi_profesi_model();
        if ($this->request->getMethod() === 'post' ){
            if (!$this->validate(
                [
                    'has_op'    => [
                        'rules'     => 'required',
                        'errors'    => [
                        'required'  => 'Nama Profesi harus dipilih',
                                ]
                            ],
                    'nama_op'  => [
                        'rules'     => 'required|min_length[5]|alpha_space',
                        'errors'    => [
                        'required'      => 'nama organisasi harus diisi',
                        'min_length'    => 'nama organisasi minimal 5 karakter',
                        'alpha_space'    => 'nama organisasi hanya berupa huruf'
                                ]
                            ] 
                    ]
                )
            ){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
                }else{
                    $has_op         = $this->request->getPost('has_op');
                    $nama_op        = $this->request->getPost('nama_op');
                    $singkatan_op   = $this->request->getPost('singkatan_op');
                    $pimpinan_op    = $this->request->getPost('pimpinan_op');
                    $alamat_op      = $this->request->getPost('alamat_op');
                    $web_op         = $this->request->getPost('web_op');
                    $email_op       = $this->request->getPost('email_op');
                    $hp_op          = $this->request->getPost('hp_op');
                    $telp_op        = $this->request->getPost('telp_op');
                    $data           = [  
                        'nama_op'       => $nama_op,
                        'singkatan_op'  => $singkatan_op,
                        'pimpinan_op'   => $pimpinan_op,
                        'alamat_op'     => $alamat_op,
                        'web_op'        => $web_op,
                        'email_op'      => $email_op,
                        'hp_op'         => $hp_op,
                        'telp_op'       => $telp_op,
                        'updated_at'    => date('Y-m-d H:i:s'),
                        'has_op'        => $has_op
                        ];
                    var_dump($data);
                    // masuk database
                    $edit_op = $m_op->edit($data);
                    if($edit_op = true){
                        $this->session->setFlashdata('sukses', 'Data telah dirubah');
                        return redirect()->to(base_url('admin/organisasi_profesi'));
                    }else{
                        $this->session->setFlashdata('warning', 'Data gagal dirubah');
                        return redirect()->to(base_url('admin/organisasi_profesi'));
                    }
                }
            }
        }
    // delete
    public function delete($has_op){
        checklogin();
        $m_op       = new Organisasi_profesi_model();
        $op         = $m_op->by_has_op($has_op);
        $data       = [
            'has_op'        => $op->has_op,
            'deleted_at'    => date('Y-m-d H:i:s'),
        ];
        if($has_op === $op->has_op){
            $m_op->edit($data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah dihapus');
            return redirect()->to(base_url('admin/organisasi_profesi'));
        }
        
        
    }
    
}
