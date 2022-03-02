<?php

namespace App\Controllers\Admin;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\Kategori_kelas_model;
use App\Models\User_model;
use App\Models\Kelas_model;

class Kelas extends BaseController
{
    // index
    public function index()
    {
        checklogin();
        $m_berita           = new Berita_model();
        $m_kategori         = new Kategori_model();
        $m_kelas            = new Kelas_model();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->listing();
        $berita             = $m_berita->event();
        $kelas              = $m_kelas->listing();
        $total              = $m_berita->total_event();
        $data = [
            'title'         => 'Kelas (' . $total . ')',
            'berita'        => $berita,
            'kelas'         => $kelas,
            'kategori_kelas'=> $kategori_kelas,
            'sub_menu'      => 'admin/sub_menu/berita',
            'content'       => 'admin/kelas/index',
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
    public function berita($jenis_berita)
    {
        checklogin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $berita     = $m_berita->jenis_berita_all($jenis_berita);
        $total      = $m_berita->total_jenis_berita($jenis_berita);
        $data = [
            'title'     => $jenis_berita . ' (' . $total . ')',
            'berita'    => $berita,
            'sub_menu'  => 'admin/sub_menu/berita',
            'content'   => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // status_berita
    public function status_berita($status_berita)
    {
        checklogin();
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
        $m_kategori = new Kategori_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        $data = [
            'title'     => 'Tambah Berita',
            'kategori'  => $kategori,
            'content'   => 'admin/event/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // save add
    public function add()
    {
        checklogin();
        $m_kategori = new Kategori_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'judul_berita'  => 'required',
                'gambar'        => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            if (! empty($_FILES['gambar']['name'])) {
                // Image upload
                $avatar   = $this->request->getFile('gambar');
                $namabaru = str_replace(' ', '-', $avatar->getName());
                $avatar->move(WRITEPATH . '../assets/upload/image/', $namabaru);
                // Create thumb
                $image = \Config\Services::image()
                    ->withFile(WRITEPATH . '../assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save(WRITEPATH . '../assets/upload/image/thumbs/' . $namabaru);
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
                ];
                $m_berita->tambah($data);
                return redirect()->to(base_url('admin/berita/jenis_berita/' . $this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
            }
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
            ];
            $m_berita->tambah($data);
            return redirect()->to(base_url('admin/berita/jenis_berita/' . $this->request->getVar('jenis_berita')))->with('sukses', 'Data Berhasil di Simpan');
        }
    }
    // edit
    public function edit($id_berita)
    {
        checklogin();
        $m_kategori = new Kategori_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        $berita     = $m_berita->detail($id_berita);
        $data       = [
            'title'     => 'Edit Berita: ' . $berita['judul_berita'],
            'kategori'  => $kategori,
            'berita'    => $berita,
            'content'   => 'admin/event/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // UPDATE
    public function update($id_berita)
    {
        checklogin();
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
                $namabaru = str_replace(' ', '-', $avatar->getName());
                $avatar->move(WRITEPATH . '../assets/upload/image/', $namabaru);
                // Create thumb
                $image = \Config\Services::image()
                    ->withFile(WRITEPATH . '../assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save(WRITEPATH . '../assets/upload/image/thumbs/' . $namabaru);
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
                ];
                $m_berita->edit($data);
                return redirect()->to(base_url('admin/event'))->with('sukses', 'Data Berhasil di Simpan');
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
            ];
            $m_berita->edit($data);
            return redirect()->to(base_url('admin/event'))->with('sukses', 'Data Berhasil di Simpan');
        }
    }
    // Delete
    public function delete($id_berita)
    {
        checklogin();
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