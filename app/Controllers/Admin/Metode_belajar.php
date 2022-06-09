<?php

namespace App\Controllers\Admin;

use App\Models\Url_model;
use App\Models\Metode_belajar_model;

class Metode_belajar extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user            = $this->session->get('id_user');
        $m_metode_belajar   = new Metode_belajar_model();
        $metode_belajar     = $m_metode_belajar->findAll();
        
        $data = [
            'title'             => 'Metode Belajar',
            'metode_belajar'    => $metode_belajar,
            'sub_menu'          => 'admin/sub_menu/event',
            'content'           => 'admin/metode_belajar/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    //tambah data
    public function create() {
        checklogin();
        $session            = \Config\Services::session();
        $id_user            = $this->session->get('id_user');
        $m_metode_belajar   = new Metode_belajar_model();
        $data_validasi  = [
            'metode_belajar'  => [
                'rules'     => 'required|min_length[3]',
                'errors'    => [
                    'required'      => 'Metode belajar harus diisi',
                    'min_length'    => 'Metode belajar minimal 3 Karakter',
                ]
            ],
        ];
        if ($this->request->getMethod() === 'post' ){
            if($this->validate($data_validasi)){
                $data = [
                    'metode_belajar'    => $this->request->getPost('metode_belajar'),
                    'created_at'        => time(),
                    'created_by'        => $id_user,
                    'has_metode_belajar'=> md5(uniqid()),
                ];
                $m_metode_belajar->save($data);
                $this->session->setFlashdata('sukses', 'Data berhasil disimpan');
                return redirect()->back()->withInput();
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

        }else{
            $this->session->setFlashdata('warning', 'AKSES ILEGAL');
            return redirect()->back()->withInput();
//            return redirect()->to(base_url('admin/url'));
        }
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
        if ($this->request->getMethod() === 'post' ) {
            // masuk database
            if(! $this->validate(
                [
                    'url_asli'  => [
                        'rules'     => 'required|min_length[10]|valid_url',
                        'errors'    => [
                            'required'      => 'URL Asli Harus diisi',
                            'min_length'    => 'URL Asli minimal 10 Karakter',
                        ]
                        ],
                    
                    'short'     => [
                        'rules'     => 'required|min_length[3]|is_unique[url.short]|alpha_numeric',
                        'errors'    => [
                            'required'      => 'Short URL Harus diisi',
                            'min_length'    => 'Short URL minimal 3 Karakter',
                            'is_unique'     => 'Short URL Sudah terdaftar, gunakan short url lain',
                            'alpha_numeric' => 'Short URL Hanya memuat karakter huruf dan angka'
                        ]
                    ]
                    
                ]
            )){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            
            }else{
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
            }
            
        }else{
            $this->session->setFlashdata('warning', 'AKSES ILEGAL');
                return redirect()->to(base_url('admin/url'));
        }
        //return redirect()->to(base_url('a/b/'.$short));
    }

    // edit
    public function edit($has_metode_belajar)
    {
        checklogin();
        $m_metode_belajar   = new Metode_belajar_model();
        $metode_belajar     = $m_metode_belajar->find($has_metode_belajar);
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'kategori_kelas' => 'required|min_length[3]',
            ]
        )) {
            // masuk database

            $data = [
                'id_metode_belajar' => $metode_belajar['id_metode_belajar'],
                'metode_belajar'    => $this->request->getPost('metode_belajar'),
                'updated_at'        => time(),
            ];
            $update = $m_metode_belajar->save($data);
            // masuk database
            if($update != NULL){
                $this->session->setFlashdata('sukses', 'Data sukses diedit');
            }else{
                $this->session->setFlashdata('danger', 'Data gagal diedit');
            }
            return redirect()->to(base_url('admin/metode_belajar'));
        }
        $data = [
            'title'             => 'Edit Kategori kelas: ' . $metode_belajar['metode_belajar'],
            'metode_belajar'    => $metode_belajar,
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
