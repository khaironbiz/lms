<?php

namespace App\Controllers\Admin;

use App\Models\Profesi_model;
use App\Models\Organisasi_profesi_model;

class Profesi extends BaseController{
    // daftar nama profesi
    public function index(){
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_profesi  = new Profesi_model();
        $profesi    = $m_profesi->listing();
        
        if ($this->request->getMethod() === 'post' ){
            $aksi   = $this->request->getPost('aksi');
            if($aksi=="add_profesi"){
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
                    
                    // var_dump($count);
                }
            }elseif($aksi==="edit_profesi"){
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
                    $has_profesi_post   = $this->request->getPost('has_profesi');
                    $data               = [  
                        'has_profesi'   => $has_profesi_post,              
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
                    
                    // var_dump($count);
                }
            }else{
                echo "Halaman Blank";
            }
            
        }else{
            $data = [
                'title'     => 'Daftar Nama Profesi',
                'profesi'   => $profesi,
                'content'   => 'admin/profesi/index',
            ];
            echo view('admin/layout/wrapper', $data);
        }
        
    }
    //tambah data
    public function organisasi(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_profesi      = new Profesi_model();
        $m_op           = new Organisasi_profesi_model();
        $op             = $m_op->listing();
        $profesi        = $m_profesi->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' ){
            $aksi = $this->request->getPost('aksi');
            if($aksi ==="create_op"){
                if (!$this->validate([
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
                    ])) {
                        session()->setFlashdata('error', $this->validator->listErrors());
                        return redirect()->back()->withInput();
                }else{
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
                    if($tambah_op = true){
                        $this->session->setFlashdata('sukses', 'Data telah ditambah');
                        return redirect()->to(base_url('admin/profesi/organisasi'));
                    }else{
                        $this->session->setFlashdata('warning', 'Data gagal ditambah');
                        return redirect()->to(base_url('admin/profesi/organisasi'));
                    }
                    
                    // var_dump($count);
                }
            }elseif($aksi ==="edit_op"){
                if (!$this->validate([
                    'has_op'    => [
                        'rules'     => 'required',
                        'errors'    => [
                            'required'          => 'Nama Profesi harus dipilih',
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
                    ])) {
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
                    $data           = [                
                        
                        'nama_op'       => $nama_op,
                        'singkatan_op'  => $singkatan_op,
                        'pimpinan_op'   => $pimpinan_op,
                        'alamat_op'     => $alamat_op,
                        'web_op'        => $web_op,
                        'email_op'      => $email_op,
                        'hp_op'         => $hp_op,
                        'updated_at'    => date('Y-m-d H:i:s'),
                        'has_op'        => $has_op
                    ];
                    var_dump($data);
                    // masuk database
                    $edit_op = $m_op->edit($data);
                    if($edit_op = true){
                        $this->session->setFlashdata('sukses', 'Data telah dirubah');
                        return redirect()->to(base_url('admin/profesi/organisasi'));
                    }else{
                        $this->session->setFlashdata('warning', 'Data gagal dirubah');
                        return redirect()->to(base_url('admin/profesi/organisasi'));
                    }
                    
                    // var_dump($count);
                }
            }else{
                echo "Anda Tersesat";
            }
            
            
        }else{
            $data = [
                'title'     => 'Daftar Organisasi Profesi',
                'op'        => $op,
                'profesi'   => $profesi,
                'content'   => 'admin/organisasi_profesi/index',
            ];
            echo view('admin/layout/wrapper', $data);
        }
        
    }
    //pengkinian data
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
    public function edit($has_kategori_kelas){
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
    public function delete($has_kategori_kelas){
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
