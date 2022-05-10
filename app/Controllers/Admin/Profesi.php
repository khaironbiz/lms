<?php

namespace App\Controllers\Admin;

use App\Models\Profesi_model;
use App\Models\Organisasi_profesi_model;

class Profesi extends BaseController{
    // daftar nama profesi
    public function index(){
        checklogin();
        admin();
        $id_user    = $this->session->get('id_user');
        $m_profesi  = new Profesi_model();
        $profesi    = $m_profesi->listing();
        $data = [
                'title'     => 'Daftar Nama Profesi',
                'profesi'   => $profesi,
                'content'   => 'admin/profesi/index',
            ];
            echo view('admin/layout/wrapper', $data);
    }
    //tambah data
    public function create(){
        checklogin();
        admin();
        $id_user    = $this->session->get('id_user');
        $m_profesi  = new Profesi_model();
        $profesi    = $m_profesi->listing();
        if ($this->request->getMethod() === 'post' ){
            if (!$this->validate([
                    'nama_profesi'  => [
                        'rules'     => 'required|min_length[5]|alpha_space',
                        'errors'    => [
                            'required'      => 'Field harus diisi',
                            'min_length'    => 'Field minimal 5 karakter',
                            'alpha_space'   => 'Field hanya berupa huruf'
                        ]
                    ]
                ])
            ){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else{
                $nama_profesi   = $this->request->getPost('nama_profesi');
                $data           = [                
                    'nama_profesi'  => $nama_profesi,
                    'created_by'    => $this->session->get('id_user'),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'has_profesi'   => md5(uniqid())
                ];
                $count_profesi = $m_profesi->count($nama_profesi);
                if($count_profesi <1){
                    $m_profesi->save($data);
                    // masuk database
                    $this->session->setFlashdata('sukses', 'Data telah ditambah');
                    return redirect()->to(base_url('admin/profesi'));
                }else{
                    //pesan error duplikasi nama profesi
                    $this->session->setFlashdata('warning', 'Nama profesi telah terdaftar sebelumnya, mohon periksa kembali');
                    return redirect()->to(base_url('admin/profesi'));
                }
            }
            
        }else{
            echo "Anda Tersesat";
        }
        
    }
    // edit
    public function update($has_profesi){
        checklogin();
        admin();
        $id_user    = $this->session->get('id_user');
        $m_profesi  = new Profesi_model();
        $profesi    = $m_profesi->listing();
        if (!$this->validate([
            'nama_profesi'  => [
                'rules'     => 'required|min_length[5]|alpha_space',
                'errors'    => [
                    'required'      => 'Field harus diisi',
                    'min_length'    => 'Field minimal 5 karakter',
                    'alpha_space'   => 'Field hanya berupa huruf'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }else{
            $nama_profesi       = $this->request->getPost('nama_profesi');
            $data               = [  
                'has_profesi'   => $has_profesi,              
                'nama_profesi'  => $nama_profesi,
                'updated_at'    => date('Y-m-d H:i:s')
            ];
            $count_profesi = $m_profesi->count($nama_profesi);
            if($count_profesi <1){
                //aksi edit ke database
                $m_profesi->edit($data);
                $this->session->setFlashdata('sukses', 'Data telah ditambah');
                return redirect()->to(base_url('admin/profesi'));
            }else{
                //pesan error duplikasi nama profesi
                $this->session->setFlashdata('warning', 'Nama profesi telah terdaftar sebelumnya, mohon periksa kembali');
                return redirect()->to(base_url('admin/profesi'));
            }
        }
    }
    // delete
    public function delete($has_profesi){
        checklogin();
        admin();
        $id_user    = $this->session->get('id_user');
        $m_profesi  = new Profesi_model();
        $profesi    = $m_profesi->listing();
        if (!$this->validate([
            'nama_profesi'  => [
                'rules'     => 'required|min_length[5]|alpha_space',
                'errors'    => [
                    'required'      => 'Field harus diisi',
                    'min_length'    => 'Field minimal 5 karakter',
                    'alpha_space'   => 'Field hanya berupa huruf'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }else{
            $nama_profesi       = $this->request->getPost('nama_profesi');
            $data               = [  
                'has_profesi'   => $has_profesi,              
                'nama_profesi'  => $nama_profesi,
                'deleted_at'    => date('Y-m-d H:i:s')
            ];
            $count_profesi = $m_profesi->count($nama_profesi);
            if($count_profesi <1){
                //aksi edit ke database
                $m_profesi->edit($data);
                $this->session->setFlashdata('sukses', 'Data telah dihapus');
                return redirect()->to(base_url('admin/profesi'));
            }else{
                //pesan error duplikasi nama profesi
                $this->session->setFlashdata('warning', 'Nama profesi telah terdaftar sebelumnya, mohon periksa kembali');
                return redirect()->to(base_url('admin/profesi'));
            }
            // var_dump($count);
        }
    }
    
}
