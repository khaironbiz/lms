<?php

namespace App\Controllers\Admin;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\User_model;
use App\Models\Client_model;

class Berita extends BaseController
{
    // index
    public function index()
    {
        checklogin();
        admin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $berita     = $m_berita->listing();
        $total      = $m_berita->total();

        $data = [
            'title'     => 'Berita, Profil dan Layanan (' . $total . ')',
            'berita'    => $berita,
            'sub_menu'  => 'admin/sub_menu/berita',
            'content'   => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // kategori
    public function kategori($id_kategori)
    {
        checklogin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $kategori   = $m_kategori->detail($id_kategori);
        $berita     = $m_berita->kategori_all($id_kategori);
        $total      = $m_berita->total_kategori($id_kategori);

        $data = ['title' => $kategori['nama_kategori'] . ' (' . $total . ')',
            'berita'     => $berita,
            'content'    => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // jenis_berita
    public function jenis_berita($jenis_berita)
    {
        checklogin();
        admin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $berita     = $m_berita->jenis_berita_all($jenis_berita);
        $total      = $m_berita->total_jenis_berita($jenis_berita);

        $data = ['title' => $jenis_berita . ' (' . $total . ')',
            'berita'     => $berita,
            'content'    => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // status_berita
    public function status_berita($status_berita)
    {
        checklogin();
        admin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $kategori   = $m_kategori->detail($id_kategori);
        $berita     = $m_berita->status_berita_all($status_berita);
        $total      = $m_berita->total_status_berita($status_berita);

        $data = ['title' => $status_berita . ' (' . $total . ')',
            'berita'     => $berita,
            'content'    => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // author
    public function author($id_user)
    {
        checklogin();
        admin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $m_user     = new User_model();
        $user       = $m_user->detail($id_user);
        $berita     = $m_berita->author_all($id_user);
        $total      = $m_berita->total_author($id_user);

        $data = ['title' => $user['nama'] . ' (' . $total . ')',
            'berita'     => $berita,
            'content'    => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Tambah
    public function tambah()
    {
        checklogin();
        admin();
        $m_kategori = new Kategori_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        $m_client   = new Client_model();
        $client     = $m_client->listing();
        $data_validasi = [
            'judul_berita'  => 'required|',
            'gambar'        => [
                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[gambar,4096]',
            ],
        ];

        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if($this->validate($data_validasi)){
                if (! empty($_FILES['gambar']['name'])) {
                    // Image upload
                    $avatar   = $this->request->getFile('gambar');
                    $namabaru = uniqid().str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/image/', $namabaru);
                    // Create thumb
                    $image = \Config\Services::image()
                        ->withFile('assets/upload/image/' . $namabaru)
                        ->fit(400, 400, 'center')
                        ->save('assets/upload/image/thumbs/' . $namabaru);
                    // masuk database
                    $data = [
                        'id_user'         => $this->session->get('id_user'),
                        'id_kategori'     => $this->request->getVar('id_kategori'),
                        'slug_berita'     => strtolower(url_title($this->request->getVar('judul_berita'))),
                        'judul_berita'    => $this->request->getVar('judul_berita'),
                        'ringkasan'       => $this->request->getVar('ringkasan'),
                        'isi'             => $this->request->getVar('isi'),
                        'status_berita'   => $this->request->getVar('status_berita'),
                        'jenis_berita'    => $this->request->getVar('jenis_berita'),
                        'keywords'        => $this->request->getVar('keywords'),
                        'icon'            => $this->request->getVar('icon'),
                        'gambar'          => $namabaru,
                        'tanggal_post'    => date('Y-m-d H:i:s'),
                        'tanggal_publish' => date('Y-m-d', strtotime($this->request->getVar('tanggal_publish'))) . ' ' . date('H:i', strtotime($this->request->getVar('jam'))),
                        'has_berita'      => md5(uniqid()),
                    ];
                    $m_berita->tambah($data);
                    return redirect()->to(base_url('admin/berita'))->with('sukses', 'Data Berhasil di Simpan');
                }else{
                    $data = [
                        'id_user'         => $this->session->get('id_user'),
                        'id_kategori'     => $this->request->getVar('id_kategori'),
                        'slug_berita'     => strtolower(url_title($this->request->getVar('judul_berita'))),
                        'judul_berita'    => $this->request->getVar('judul_berita'),
                        'ringkasan'       => $this->request->getVar('ringkasan'),
                        'isi'             => $this->request->getVar('isi'),
                        'status_berita'   => $this->request->getVar('status_berita'),
                        'jenis_berita'    => $this->request->getVar('jenis_berita'),
                        'keywords'        => $this->request->getVar('keywords'),
                        'icon'            => $this->request->getVar('icon'),
                        'tanggal_post'    => date('Y-m-d H:i:s'),
                        'tanggal_publish' => date('Y-m-d', strtotime($this->request->getVar('tanggal_publish'))) . ' ' . date('H:i', strtotime($this->request->getVar('jam'))),
                        'has_berita'      => md5(uniqid()),
                    ];
                }
                $m_berita->tambah($data);

                return redirect()->to(base_url('admin/berita'))->with('sukses', 'Data Berhasil di Simpan');

            }

        }

        $data = [
            'title'     => 'Tambah Berita',
            'client'    => $client,
            'kategori'  => $kategori,
            'content'   => 'admin/berita/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // edit
    public function edit($id_berita)
    {
        checklogin();
        admin();
        $m_kategori = new Kategori_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        $berita     = $m_berita->detail($id_berita);
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'judul_berita' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            if (! empty($_FILES['gambar']['name'])) {
                // Image upload
                $avatar   = $this->request->getFile('gambar');
                $namabaru = uniqid().str_replace(' ', '-', $avatar->getName());
                $avatar->move('assets/upload/image/', $namabaru);
                // Create thumb
                $image = \Config\Services::image()
                    ->withFile('assets/upload/image/' . $namabaru)
                    ->fit(400, 400, 'center')
                    ->save('assets/upload/image/thumbs/' . $namabaru);
                // masuk database
                $data = [
                    'id_berita'       => $id_berita,
                    'id_user'         => $this->session->get('id_user'),
                    'id_kategori'     => $this->request->getVar('id_kategori'),
                    'slug_berita'     => strtolower(url_title($this->request->getVar('judul_berita'))),
                    'judul_berita'    => $this->request->getVar('judul_berita'),
                    'ringkasan'       => $this->request->getVar('ringkasan'),
                    'isi'             => $this->request->getVar('isi'),
                    'status_berita'   => $this->request->getVar('status_berita'),
                    'jenis_berita'    => $this->request->getVar('jenis_berita'),
                    'keywords'        => $this->request->getVar('keywords'),
                    'icon'            => $this->request->getVar('icon'),
                    'gambar'          => $namabaru,
                    'tanggal_publish' => date('Y-m-d', strtotime($this->request->getVar('tanggal_publish'))) . ' ' . date('H:i', strtotime($this->request->getVar('jam'))),
                    'has_berita'      => md5(uniqid()),
                ];
                $m_berita->edit($data);

                return redirect()->to(base_url('admin/berita/'))->with('sukses', 'Data Berhasil di Simpan');
            }
            $data = [
                'id_berita'       => $id_berita,
                'id_user'         => $this->session->get('id_user'),
                'id_kategori'     => $this->request->getVar('id_kategori'),
                'slug_berita'     => strtolower(url_title($this->request->getVar('judul_berita'))),
                'judul_berita'    => $this->request->getVar('judul_berita'),
                'ringkasan'       => $this->request->getVar('ringkasan'),
                'isi'             => $this->request->getVar('isi'),
                'status_berita'   => $this->request->getVar('status_berita'),
                'jenis_berita'    => $this->request->getVar('jenis_berita'),
                'keywords'        => $this->request->getVar('keywords'),
                'icon'            => $this->request->getVar('icon'),
                'tanggal_publish' => date('Y-m-d', strtotime($this->request->getVar('tanggal_publish'))) . ' ' . date('H:i', strtotime($this->request->getVar('jam'))),
                'has_berita'      => md5(uniqid()),
            ];
            $m_berita->edit($data);

            return redirect()->to(base_url('admin/berita/'))->with('sukses', 'Data Berhasil di Simpan');
        }

        $data = ['title' => 'Edit Berita: ' . $berita['judul_berita'],
            'kategori'   => $kategori,
            'berita'     => $berita,
            'content'    => 'admin/berita/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_berita)
    {
        checklogin();
        admin();
        $m_berita = new Berita_model();
        $data     = ['id_berita' => $id_berita];
        $m_berita->delete($data);
        // masuk database
        $this->session->setFlashdata('sukses', 'Data telah dihapus');

        return redirect()->to(base_url('admin/berita'));
    }
    public function baru(){
        
        $data = [
            'title' => 'Berita, Profil dan Layanan',
            'content'    => 'admin/berita/baru',
        ];
        echo view('admin/layout/theme', $data);
    }
}
