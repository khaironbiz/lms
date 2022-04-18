<?php

namespace App\Controllers\Admin;

use App\Models\Profesi_model;
use App\Models\Organisasi_profesi_model;

class Organisasi_profesi extends BaseController{
    
    public function index(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_profesi      = new Profesi_model();
        $m_op           = new Organisasi_profesi_model();
        $op             = $m_op->listing();
        $profesi        = $m_profesi->listing();
        $data = [
                'title'     => 'Daftar Organisasi Profesi',
                'op'        => $op,
                'profesi'   => $profesi,
                'content'   => 'admin/organisasi_profesi/index',
            ];
            echo view('admin/layout/wrapper', $data);
        
        
    }
    //create
    public function create(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_op           = new Organisasi_profesi_model();
        if ($this->request->getMethod() === 'post' ){
            if (!$this->validate(
                [
                    'id_profesi'    => [
                        'rules'     => 'required|is_unique[organisasi_profesi.id_profesi]',
                        'errors'    => [
                            'required'          => 'Nama Profesi harus dipilih',
                            'is_unique'         => 'Profesi ini sudah terdaftar di database organisasi profesi, periksa kembali!!!!!!!!!',
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
            )
            {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else
            {
                $id_profesi     = $this->request->getPost('id_profesi');
                $nama_op        = $this->request->getPost('nama_op');
                $singkatan_op   = $this->request->getPost('singkatan_op');
                $pimpinan_op    = $this->request->getPost('pimpinan_op');
                $alamat_op      = $this->request->getPost('alamat_op');
                $web_op         = $this->request->getPost('web_op');
                $email_op       = $this->request->getPost('email_op');
                $hp_op          = $this->request->getPost('hp_op');
                $data           = [                
                    'id_profesi'    => $id_profesi,
                    'nama_op'       => $nama_op,
                    'singkatan_op'  => $singkatan_op,
                    'pimpinan_op'   => $pimpinan_op,
                    'alamat_op'     => $alamat_op,
                    'web_op'        => $web_op,
                    'email_op'      => $email_op,
                    'hp_op'         => $hp_op,
                    'created_by'    => $this->session->get('id_user'),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'has_op'       => md5(uniqid())
                ];
                var_dump($data);
                // masuk database
                $tambah_op = $m_op->tambah($data);
                if($tambah_op = true)
                {
                    $this->session->setFlashdata('sukses', 'Data telah ditambah');
                    return redirect()->to(base_url('admin/organisasi_profesi'));
                }else
                {
                    $this->session->setFlashdata('warning', 'Data gagal ditambah');
                    return redirect()->to(base_url('admin/organisasi_profesi'));
                }
            }
            
            
        }else{
            echo "Anda Tersesat";
        }
    }
    //detail
    public function detail($has_op){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_profesi      = new Profesi_model();
        $m_op           = new Organisasi_profesi_model();
        $op             = $m_op->by_has_op($has_op);
        $profesi        = $m_profesi->listing();
        $data = [
                'title'     => 'Organisasi Profesi '.$op->nama_profesi,
                'op'        => $op,
                'profesi'   => $profesi,
                'content'   => 'admin/organisasi_profesi/detail',
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
