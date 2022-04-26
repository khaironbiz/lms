<?php

namespace App\Controllers\Admin;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\Kategori_kelas_model;
use App\Models\User_model;
use App\Models\Kelas_model;
use App\Models\Materi_model;
use App\Models\Materi_file_model;
use App\Models\Akreditasi_profesi_model;
use App\Models\Organisasi_profesi_model;

class Akreditasi_profesi extends BaseController
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
    public function create($has_kelas){
        checklogin();
        $id_user                = $this->session->get('id_user');
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $m_kelas                = new Kelas_model();
        $kelas                  = $m_kelas->detail($has_kelas);
        $data = [
            'id_kelas'                  => $kelas['id_kelas'],
            'id_op'                     => $this->request->getPost('id_op'),
            'level_op'                  => $this->request->getPost('level_op'),
            'nominal_skp'               => $this->request->getPost('nominal_skp'),
            'nomor_skp'                 => $this->request->getPost('nomor_skp'),
            'tanggal_skp'               => $this->request->getPost('tanggal_skp'),
            'keterangan'                => $this->request->getPost('keterangan'),
            'created_by'                => $id_user,
            'created_at'                => date('Y-m-d H:i:s'),
            'has_akreditasi_profesi'    => md5(uniqid()),

        ];
        $m_akreditasi_profesi->insert($data);
        var_dump($data);
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
