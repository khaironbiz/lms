<?php

namespace App\Controllers;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\Konfigurasi_model;
use App\Models\Kelas_model;
use App\Models\Materi_model;
use App\Models\User_model;
use App\Models\Akreditasi_profesi_model;


class Berita extends BaseController
{
    // index
    public function index()
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_berita      = new Berita_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $berita        = $m_berita->home();

        $data = [
            'title'         => 'Berita',
            'description'   => 'Berita ' . $konfigurasi['namaweb'],
            'keywords'      => 'Berita ' . $konfigurasi['namaweb'],
            'berita'        => $berita,
            'content'       => 'berita/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // event
    public function event()
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_berita      = new Berita_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $berita        = $m_berita->event_publish();

        $data = [
            'title'         => 'Event ',
            'description'   => 'Berita ' . $konfigurasi['namaweb'],
            'keywords'      => 'Berita ' . $konfigurasi['namaweb'],
            'berita'        => $berita,
            'content'       => 'berita/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // read
    public function read($slug_berita)
    {
        
        $session        = \Config\Services::session();
        $m_user         = new User_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_berita       = new Berita_model();
        $m_kelas        = new Kelas_model();
        $m_materi       = new Materi_model();
        if ($session->get('username') === ''){
            $user       = [
                'nama'  => 'Tamu',
                'email' => '',
                'hp'    => '',
            ];
        }else{
            $id_user        = $this->session->get('id_user');
            $user           = $m_user->detail($id_user);

        }
        $konfigurasi    = $m_konfigurasi->listing();
        $berita         = $m_berita->read($slug_berita);
        $sidebar        = $m_berita->sidebar();
        $id_event       = $berita['id_berita'];
		$kelas          = $m_kelas->event($id_event);
        $materi         = $m_materi->event($id_event);

        $data = [
            'id_berita' => $berita['id_berita'],
            'hits'      => $berita['hits'] + 1,
        ];
        $m_berita->edit($data);
        $data = [
            'title'         => $berita['judul_berita'],
            'description'   => $berita['judul_berita'],
            'keywords'      => $berita['judul_berita'],
            'id_user'       => $this->session->get('id_user'),
            'berita'        => $berita,
            'sidebar'       => $sidebar,
            'kelas'         => $kelas,
            'materi'        => $materi,
            'user'          => $user,
            'content'       => 'berita/read',
        ];
        echo view('layout/wrapper', $data);
    }

    //kelas
    public function kelas($has_kelas)
    {
        
        $session                = \Config\Services::session();
        $m_kelas                = new Kelas_model();
        $m_materi               = new Materi_model();
		$kelas                  = $m_kelas->detail($has_kelas);
        $id_kelas               = $kelas['id_kelas'];
        $materi                 = $m_materi->kelas($id_kelas);
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $id_user                = $this->session->get('id_user');
        $m_user                 = new User_model();
        $user                   = $m_user->detail($id_user);
        
        // Update hits
        $data = [
            'has_kelas'  => $kelas['has_kelas'],
            'hit_kelas' => $kelas['hit_kelas'] + 1,
        ];
        $m_kelas->edit($data);
        $data = [
            'title'         => $kelas['nama_kelas'],
            'description'   => $kelas['nama_kelas'],
            'keywords'      => $kelas['nama_kelas'],
            'kelas'         => $kelas,
            'materi'        => $materi, 
            'skp'           => $akreditasi_profesi,
            'id_user'       => $this->session->get('id_user'),
            'user'          => $user,
            'content'       => 'kelas/detail',
        ];
        echo view('layout/wrapper', $data);
    }

    // profil
    public function profil($slug_berita)
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_berita      = new Berita_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $berita        = $m_berita->read($slug_berita);

        // Update hits
        $data = [
            'id_berita' => $berita['id_berita'],
            'hits'      => $berita['hits'] + 1,
        ];
        $m_berita->edit($data);
        // Update hits

        $data = ['title'  => $berita['judul_berita'],
            'description' => $berita['judul_berita'],
            'keywords'    => $berita['judul_berita'],
            'berita'      => $berita,
            'content'     => 'berita/profil',
        ];
        echo view('layout/wrapper', $data);
    }

    // layanan
    public function layanan($slug_berita)
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_berita      = new Berita_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $berita        = $m_berita->read($slug_berita);

        // Update hits
        $data = ['id_berita' => $berita['id_berita'],
            'hits'           => $berita['hits'] + 1,
        ];
        $m_berita->edit($data);
        // Update hits

        $data = ['title'  => $berita['judul_berita'],
            'description' => $berita['judul_berita'],
            'keywords'    => $berita['judul_berita'],
            'berita'      => $berita,
            'content'     => 'berita/layanan',
        ];
        echo view('layout/wrapper', $data);
    }

    // kategori
    public function kategori($slug_kategori)
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_berita      = new Berita_model();
        $m_kategori    = new Kategori_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $kategori      = $m_kategori->read($slug_kategori);
        $berita        = $m_berita->kategori($kategori['id_kategori']);
        // Update hits
        $data = ['id_kategori' => $kategori['id_kategori'],
            'hits'             => $kategori['hits'] + 1,
        ];
        $m_kategori->edit($data);
        // Update hits

        $data = ['title'  => $kategori['nama_kategori'],
            'description' => $kategori['nama_kategori'],
            'keywords'    => $kategori['nama_kategori'],
            'kategori'    => $kategori,
            'berita'      => $berita,
            'content'     => 'berita/index',
        ];
        echo view('layout/wrapper', $data);
    }
}
