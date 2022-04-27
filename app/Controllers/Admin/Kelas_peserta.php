<?php

namespace App\Controllers\Admin;

use App\Models\Kelas_model;
use App\Models\Kelas_peserta_model;
use App\Models\Berita_model;

class Kelas_peserta extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user            = $this->session->get('id_user');
        $m_kelas_peserta    = new Kelas_peserta_model();
        $kelas_peserta      = $m_kelas_peserta->listing();
        
        $data = [
            'title'         => 'Dartar Peserta Pelatihan',
            'kelas_peserta' => $kelas_peserta,
            'content'       => 'admin/kelas_peserta/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // kelas_user
    public function user($id_user)
    {
        checklogin();
        $id_user            = $this->session->get('id_user');
        $m_kelas_peserta    = new Kelas_model();
        $kelas_peserta      = $m_kelas_peserta->kelas_user($id_user);
        
        $data = [
            'title'         => 'List Url',
            'kelas_peserta' => $kelas_peserta,
            'content'       => 'admin/kelas_peserta/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // kelas_user
    public function peserta($has_user)
    {
        checklogin();
        $id_user            = $this->session->get('id_user');
        $m_user             = new User_model();
        $user               = $m_user->has_user($has_user);
        $id_user            = $user->id_user;
        $m_kelas_peserta    = new Kelas_model();
        $kelas_peserta      = $m_kelas_peserta->kelas_user($id_user);
        
        $data = [
            'title'         => 'List Url',
            'kelas_peserta' => $kelas_peserta,
            'content'       => 'admin/kelas_peserta/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    //tambah data
    public function create($has_kelas){
        checklogin();
        $id_user            = $this->session->get('id_user');
        $m_kelas_peserta    = new Kelas_peserta_model();
        $kelas_peserta      = $m_kelas_peserta->listing();
        $m_kelas            = new Kelas_model();
        $kelas              = $m_kelas->detail($has_kelas);
        $id_berita          = $kelas['id_event'];
        $m_berita           = new Berita_model();
        $berita             = $m_berita->by_id($id_berita);
        // Start validasi
        if ($this->request->getMethod() === 'post' ){
            $data_validasi = [
                'email_peserta' => [
                    'rules' => 'required|min_length[10]',
                    'errors' => [
                        'required'      => 'Email peserta harus diisi',
                        'min_length'    => 'Email peserta minimal 10 karakter',
                    ]
                ],
                'hp_peserta' => [
                    'rules'             => 'required|min_length[10]|numeric',
                    'errors'            => [
                        'required'      => 'Nomor HP harus diisi',
                        'min_length'    => 'Nomor HP minimal 10 karakter',
                        'numeric'       => 'Nomor HP hanya berupa angka'
                    ]
                ]
            ];
            if (!$this->validate($data_validasi)) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else{
                $email_peserta      = $this->request->getPost('email_peserta');
                $hp_peserta         = $this->request->getPost('hp_peserta');
                $nama_sertifikat    = $this->request->getPost('nama_sertifikat');
                $data           = [ 
                    'id_event'          => $kelas['id_event'],
                    'id_kelas'          => $kelas['id_kelas'],         
                    'email_peserta'     => $email_peserta,
                    'hp_peserta'        => $hp_peserta,
                    'nama_sertifikat'   => $nama_sertifikat,
                    'id_user'           => $this->session->get('id_user'),
                    'harga'             => $kelas['harga_jual'],
                    'created_by'        => $this->session->get('id_user'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'has_kelas_peserta' => md5(uniqid())
                ];
                $m_kelas_peserta->save($data);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah ditambah');
                return redirect()->to(base_url('home/berita'));
                // var_dump($data);
            }
        }else{
            $this->session->setFlashdata('warning', 'INVALID AKSES');
            return redirect()->to(base_url('admin/url'));
        }
        
        //return redirect()->to(base_url('a/b/'.$short));
    }
    //tambah data
    public function pengkinian($has_url){
        checklogin();
        $session       = \Config\Services::session();
        $id_user    = $this->session->get('id_user');
        $m_kelas_peserta      = new Url_model();
        $url        = $m_kelas_peserta->has_url($has_url);
        $id_url     = $url['id_url'];
        $short      = $this->request->getPost('short');
        $count      = $m_kelas_peserta->count($short);
        $total      = $m_kelas_peserta->total();
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
                $m_kelas_peserta->update($id_url, $data);
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
