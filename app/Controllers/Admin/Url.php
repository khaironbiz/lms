<?php

namespace App\Controllers\Admin;

use App\Models\Url_model;

class Url extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->listing($id_user);
        $total      = $m_url->total();
        $data = [
            'title'     => 'List Url ('.$total.')',
            'url'       => $url,
            'content'   => 'admin/url_short/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    //tambah data
    public function tambah(){
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->listing($id_user);
        $total      = $m_url->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'url_asli'  => 'required|min_length[3]',
                'short' => 'required|min_length[3]|is_unique[url.short]|alpha_numeric_punct',
            ]
        )) {
            // masuk database
            
            $url_asli       = $this->request->getPost('url_asli');
            $short          = $this->request->getPost('short');
            $count          = $m_url->count($short);
            $data           = [                
                'url_asli'      => $url_asli,
                'short'         => $short,
                'created_by'    => $this->session->get('id_user'),
                'created_at'    => date('Y-m-d H:i:s'),
                'has_url'       => md5(uniqid())
            ];
            $m_url->save($data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah ditambah');
            return redirect()->to(base_url('admin/url'));
            // var_dump($count);
        }else{
            // var_dump($count);
            $this->session->setFlashdata('warning', 'Data Gagal ditambahkan, pastikan short url anda hanya angka dan huruf');
            return redirect()->to(base_url('admin/url/'));
        }
        //return redirect()->to(base_url('a/b/'.$short));
    }
    //tambah data
    public function pengkinian($has_url){
        checklogin();
        $session       = \Config\Services::session();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->has_url($has_url);
        $id_url     = $url['id_url'];
        $short      = $this->request->getPost('short');
        $count      = $m_url->count($short);
        $total      = $m_url->total();
        // var_dump($count);
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'url_asli'  => 'required|min_length[3]',
                'short'     => 'required|min_length[3]|is_unique[url.short]|alpha_numeric_punct',
            ]
        )) {
            // masuk database
            
            $url_asli       = $this->request->getPost('url_asli');
            $data           = [ 
                'url_asli'      => $url_asli,
                'short'         => $short,
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
            $m_url->update($id_url, $data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah diupdate');
            return redirect()->to(base_url('admin/url'));
        }else{
            $this->session->setFlashdata('warning', 'Data Gagal diupdate : url tidak unik ');
            return redirect()->to(base_url('admin/url/'));
        }
        //return redirect()->to(base_url('a/b/'.$short));
    }

    // edit
    public function edit($has_kategori_kelas)
    {
        checklogin();
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
