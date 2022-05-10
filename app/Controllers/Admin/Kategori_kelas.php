<?php

namespace App\Controllers\Admin;

use App\Models\Kategori_kelas_model;

class Kategori_kelas extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        admin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->listing();
        $total              = $m_kategori_kelas->total();
        
        $data = [
            'title'             => 'Kategori kelas: ' . $total['total'],
            'kategori_kelas'    => $kategori_kelas,
            'sub_menu'          => 'admin/sub_menu/event',
            'content'           => 'admin/kategori_kelas/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    //tambah
    public function tambah(){
        checklogin();
        admin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->listing();
        $total              = $m_kategori_kelas->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'kategori_kelas' => 'required|min_length[3]|is_unique[kategori_kelas.kategori_kelas]',
            ]
        )) {
            // masuk database
            $slug           = url_title($this->request->getPost('kategori_kelas'), '-', true);
            $kategori_kelas = $this->request->getPost('kategori_kelas');
            $data           = [                
                'kategori_kelas'        => $kategori_kelas,
                'slug_kategori_kelas'   => $slug,
                'urutan'                => $this->request->getPost('urutan'),
                'created_by'            => $this->session->get('id_user'),
                'created_at'            => date('Y-m-d H:i:s'),
                'has_kategori_kelas'    => md5(uniqid()),
            ];
            $m_kategori_kelas->save($data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah ditambah');
            return redirect()->to(base_url('admin/kategori_kelas'));
        }
    }
    // edit
    public function edit($has_kategori_kelas)
    {
        checklogin();
        admin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->detail($has_kategori_kelas);
        $total              = $m_kategori_kelas->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'kategori_kelas' => 'required|min_length[3]',
            ]
        )) {
            // masuk database
            $id_kategori_kelas = $kategori_kelas['id_kategori_kelas'];
            $slug = url_title($this->request->getPost('kategori_kelas'), '-', true);
            $data = [
                'kategori_kelas'        => $this->request->getPost('kategori_kelas'),
                'slug_kategori_kelas'   => $slug,
                'updated_at'            => date('Y-m-d H:i:s'),
                'sub_menu'              => 'admin/sub_menu/event',
                'urutan'                => $this->request->getPost('urutan'),
            ];
            
            $update_kategori_kelas = $m_kategori_kelas->update($id_kategori_kelas, $data);
            // masuk database
            if(isset($update_kategori_kelas)){
                $this->session->setFlashdata('sukses', 'Data sukses diedit');
            }else{
                $this->session->setFlashdata('danger', 'Data gagal diedit');
            }
            
            return redirect()->to(base_url('admin/kategori_kelas'));
        }
        $data = [
            'title'             => 'Edit Kategori kelas: ' . $kategori_kelas['kategori_kelas'],
            'kategori_kelas'    => $kategori_kelas,
            'content'           => 'admin/kategori_kelas/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // delete
    public function delete($has_kategori_kelas)
    {
        checklogin();
        admin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->detail($has_kategori_kelas);
        $id_kategori_kelas  = $kategori_kelas['id_kategori_kelas'];
        $data               = [
            'id_kategori_kelas' => $id_kategori_kelas,
            'deleted_at'        => date('Y-m-d H:i:s'),
        ];
        $m_kategori_kelas->update($id_kategori_kelas, $data);
        // masuk database
        $this->session->setFlashdata('sukses', 'Data telah dihapus');
        return redirect()->to(base_url('admin/kategori_kelas'));
    }
    
}
