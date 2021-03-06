<?php

namespace App\Controllers\Admin;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\Kategori_kelas_model;
use App\Models\Metode_belajar_model;
use App\Models\Soal_model;
use App\Models\Tugas_kelas_model;
use App\Models\Tugas_metode_model;
use App\Models\Tugas_model;
use App\Models\User_model;
use App\Models\Kelas_model;
use App\Models\Materi_model;
use App\Models\Materi_file_model;
use App\Models\kelas_peserta_model;
use App\Models\Organisasi_profesi_model;
use App\Models\Akreditasi_profesi_model;

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
            'sub_menu'      => 'admin/sub_menu/event',
            'content'       => 'admin/kelas/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // kategori
    public function detail($has_kelas)
    {
        checklogin();
        $m_kelas                = new Kelas_model();
        $m_berita               = new Berita_model();
        $kelas                  = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas               = $kelas->id_kelas;
        $id_event               = $kelas->id_event;
        $berita                 = $m_berita->by_id($id_event);
        $m_user                 = new User_model();
        $user                   = $m_user->listing();
        $m_materi               = new Materi_model();
        $materi                 = $m_materi->kelas($id_kelas);
        $m_op                   = new Organisasi_profesi_model();
        $op                     = $m_op->listing();
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $m_kelas_peserta        = new Kelas_peserta_model();
        $kelas_peserta          = $m_kelas_peserta->list_by_id_kelas($id_kelas);
        $count_id_kelas         = $m_kelas_peserta->count_id_kelas($id_kelas);
        $m_tugas_kelas          = new Tugas_kelas_model();
        $count_tugas            = $m_tugas_kelas->count_id_kelas($id_kelas);
        $tugas_kelas            = $m_tugas_kelas->list_by_id_kelas($kelas->id_kelas);
        $m_tugas                = new Tugas_model();
        $tugas                  = $m_tugas->listing('tugas.nama_tugas','ASC');
        $m_tugas_metode         = new Tugas_metode_model();
        $tugas_metode           = $m_tugas_metode->listing('tugas_metode.nama_metode', 'ASC');
        $data = [
            'title'         => $kelas->nama_kelas,
            'kelas'         => $kelas,
            'berita'        => $berita,
            'user'          => $user,
            'materi'        => $materi,
            'op'            => $op,
            'tugas'         => $tugas,
            'count_tugas'   => $count_tugas,
            'tugas_kelas'   => $tugas_kelas,
            'tugas_metode'  => $tugas_metode,
            'ap'            => $akreditasi_profesi,
            'kelas_peserta' => $kelas_peserta,
            'count_peserta' => $count_id_kelas,
            'content'       => 'admin/kelas/detail',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // jenis_berita
    public function skp($has_kelas)
    {
        checklogin();
        $m_kelas                = new Kelas_model();
        $m_berita               = new Berita_model();
        $kelas                  = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas               = $kelas->id_kelas;
        $id_event               = $kelas->id_event;
        $berita                 = $m_berita->by_id($id_event);
        $m_user                 = new User_model();
        $user                   = $m_user->listing();
        $m_materi               = new Materi_model();
        $materi                 = $m_materi->kelas($id_kelas);
        $m_op                   = new Organisasi_profesi_model();
        $op                     = $m_op->listing();
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $m_kelas_peserta        = new Kelas_peserta_model();
        $kelas_peserta          = $m_kelas_peserta->list_by_id_kelas($id_kelas);
        $count_id_kelas         = $m_kelas_peserta->count_id_kelas($id_kelas);
        $m_tugas_kelas          = new Tugas_kelas_model();
        $count_tugas            = $m_tugas_kelas->count_id_kelas($id_kelas);
        $tugas_kelas            = $m_tugas_kelas->list_by_id_kelas($kelas->id_kelas);
        $m_tugas                = new Tugas_model();
        $tugas                  = $m_tugas->listing('tugas.nama_tugas','ASC');
        $m_tugas_metode         = new Tugas_metode_model();
        $tugas_metode           = $m_tugas_metode->listing('tugas_metode.nama_metode', 'ASC');
        $data = [
            'title'         => $kelas->nama_kelas,
            'kelas'         => $kelas,
            'berita'        => $berita,
            'user'          => $user,
            'materi'        => $materi,
            'op'            => $op,
            'tugas'         => $tugas,
            'count_tugas'   => $count_tugas,
            'tugas_kelas'   => $tugas_kelas,
            'tugas_metode'  => $tugas_metode,
            'ap'            => $akreditasi_profesi,
            'kelas_peserta' => $kelas_peserta,
            'count_peserta' => $count_id_kelas,
            'content'       => 'admin/kelas/skp',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // jenis_berita
    public function peserta($has_kelas)
    {
        checklogin();
        $m_kelas                = new Kelas_model();
        $m_berita               = new Berita_model();
        $kelas                  = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas               = $kelas->id_kelas;
        $id_event               = $kelas->id_event;
        $berita                 = $m_berita->by_id($id_event);
        $m_user                 = new User_model();
        $user                   = $m_user->listing();
        $m_materi               = new Materi_model();
        $materi                 = $m_materi->kelas($id_kelas);
        $m_op                   = new Organisasi_profesi_model();
        $op                     = $m_op->listing();
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $m_kelas_peserta        = new Kelas_peserta_model();
        $kelas_peserta          = $m_kelas_peserta->list_by_id_kelas($id_kelas);
        $count_id_kelas         = $m_kelas_peserta->count_id_kelas($id_kelas);
        $m_tugas_kelas          = new Tugas_kelas_model();
        $count_tugas            = $m_tugas_kelas->count_id_kelas($id_kelas);
        $tugas_kelas            = $m_tugas_kelas->list_by_id_kelas($kelas->id_kelas);
        $m_tugas                = new Tugas_model();
        $tugas                  = $m_tugas->listing('tugas.nama_tugas','ASC');
        $m_tugas_metode         = new Tugas_metode_model();
        $tugas_metode           = $m_tugas_metode->listing('tugas_metode.nama_metode', 'ASC');
        $data = [
            'title'         => $kelas->nama_kelas,
            'kelas'         => $kelas,
            'berita'        => $berita,
            'user'          => $user,
            'materi'        => $materi,
            'op'            => $op,
            'tugas'         => $tugas,
            'count_tugas'   => $count_tugas,
            'tugas_kelas'   => $tugas_kelas,
            'tugas_metode'  => $tugas_metode,
            'ap'            => $akreditasi_profesi,
            'kelas_peserta' => $kelas_peserta,
            'count_peserta' => $count_id_kelas,
            'content'       => 'admin/kelas/peserta',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // jenis_berita
    public function tugas($has_kelas)
    {
        checklogin();
        $m_kelas                = new Kelas_model();
        $m_berita               = new Berita_model();
        $kelas                  = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas               = $kelas->id_kelas;
        $id_event               = $kelas->id_event;
        $berita                 = $m_berita->by_id($id_event);
        $m_user                 = new User_model();
        $user                   = $m_user->listing();
        $m_materi               = new Materi_model();
        $materi                 = $m_materi->kelas($id_kelas);
        $m_op                   = new Organisasi_profesi_model();
        $op                     = $m_op->listing();
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $m_kelas_peserta        = new Kelas_peserta_model();
        $kelas_peserta          = $m_kelas_peserta->list_by_id_kelas($id_kelas);
        $count_id_kelas         = $m_kelas_peserta->count_id_kelas($id_kelas);
        $m_tugas_kelas          = new Tugas_kelas_model();
        $count_tugas            = $m_tugas_kelas->count_id_kelas($id_kelas);
        $tugas_kelas            = $m_tugas_kelas->list_by_id_kelas($kelas->id_kelas);
        $m_tugas                = new Tugas_model();
        $tugas                  = $m_tugas->listing('tugas.nama_tugas','ASC');
        $m_tugas_metode         = new Tugas_metode_model();
        $tugas_metode           = $m_tugas_metode->listing('tugas_metode.nama_metode', 'ASC');
        $data = [
            'title'         => $kelas->nama_kelas,
            'kelas'         => $kelas,
            'berita'        => $berita,
            'user'          => $user,
            'materi'        => $materi,
            'op'            => $op,
            'tugas'         => $tugas,
            'count_tugas'   => $count_tugas,
            'tugas_kelas'   => $tugas_kelas,
            'tugas_metode'  => $tugas_metode,
            'ap'            => $akreditasi_profesi,
            'kelas_peserta' => $kelas_peserta,
            'count_peserta' => $count_id_kelas,
            'content'       => 'admin/kelas/tugas',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // jenis_berita
    public function materi($has_kelas)
    {
        checklogin();
        $m_kelas                = new Kelas_model();
        $m_berita               = new Berita_model();
        $kelas                  = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas               = $kelas->id_kelas;
        $id_event               = $kelas->id_event;
        $berita                 = $m_berita->by_id($id_event);
        $m_user                 = new User_model();
        $user                   = $m_user->listing();
        $m_materi               = new Materi_model();
        $materi                 = $m_materi->kelas($id_kelas);
        $m_op                   = new Organisasi_profesi_model();
        $op                     = $m_op->listing();
        $m_akreditasi_profesi   = new Akreditasi_profesi_model();
        $akreditasi_profesi     = $m_akreditasi_profesi->by_id_kelas($id_kelas);
        $m_kelas_peserta        = new Kelas_peserta_model();
        $kelas_peserta          = $m_kelas_peserta->list_by_id_kelas($id_kelas);
        $count_id_kelas         = $m_kelas_peserta->count_id_kelas($id_kelas);
        $m_tugas_kelas          = new Tugas_kelas_model();
        $count_tugas            = $m_tugas_kelas->count_id_kelas($id_kelas);
        $tugas_kelas            = $m_tugas_kelas->list_by_id_kelas($kelas->id_kelas);
        $m_tugas                = new Tugas_model();
        $tugas                  = $m_tugas->listing('tugas.nama_tugas','ASC');
        $m_tugas_metode         = new Tugas_metode_model();
        $tugas_metode           = $m_tugas_metode->listing('tugas_metode.nama_metode', 'ASC');
        $m_materi_file          = new Materi_file_model();
        $materi_file            = $m_materi_file->list_by_id_kelas($id_kelas);
        $data = [
            'title'         => $kelas->nama_kelas,
            'kelas'         => $kelas,
            'berita'        => $berita,
            'user'          => $user,
            'materi'        => $materi,
            'file'          => $materi_file,
            'op'            => $op,
            'tugas'         => $tugas,
            'count_tugas'   => $count_tugas,
            'tugas_kelas'   => $tugas_kelas,
            'tugas_metode'  => $tugas_metode,
            'ap'            => $akreditasi_profesi,
            'kelas_peserta' => $kelas_peserta,
            'count_peserta' => $count_id_kelas,
            'content'       => 'admin/kelas/materi',
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
    public function add_kelas($has_berita)
    {
        checklogin();
        $m_kelas        = new Kelas_model();
        
        // Start validasi
        if ($this->request->getMethod() === 'post'){
            $data_validasi  = [
                'nama_kelas'        => 'required|min_length[3]',
                'kategori_kelas'    => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ];
            if($this->validate($data_validasi)){
                $time_start     = strtotime($this->request->getVar('tanggal_mulai'));
                $time_end       = strtotime($this->request->getVar('tanggal_selesai'));
                $tanggal_mulai  = date('Y-m-d',$time_start);
                $tanggal_selesai= date('Y-m-d',$time_end);
                $avatar         = $this->request->getFile('gambar');
                $namabaru       = uniqid().str_replace(' ', '-', $avatar->getName());
                $data = [
                    'pic_kelas'         => $this->session->get('id_user'),
                    'id_event'          => $this->request->getVar('id_event'),
                    'nama_kelas'        => $this->request->getVar('nama_kelas'),
                    'kategori_kelas'    => $this->request->getVar('kategori_kelas'),
                    'tanggal_mulai'     => $tanggal_mulai,
                    'tanggal_selesai'   => $tanggal_selesai,
                    'kuota'             => $this->request->getVar('kuota'),
                    'metode_belajar'    => $this->request->getVar('metode_belajar'),
                    'status'            => $this->request->getVar('status'),
                    'poster'            => $namabaru,
                    'harga_dasar'       => $this->request->getVar('harga_dasar'),
                    'harga_jual'        => $this->request->getVar('harga_jual'),
                    'has_kelas'         => md5(uniqid()),
                ];
                $add_kelas = $m_kelas->save($data);
                if($add_kelas){
                    $avatar->move('assets/upload/image/', $namabaru);
                    // Create thumb
                    $image = \Config\Services::image()
                        ->withFile('assets/upload/image/' . $namabaru)
                        ->fit(400, 400, 'center')
                        ->save('assets/upload/image/thumbs/' . $namabaru);
                        // masuk database
                    return redirect()->to(base_url('admin/event/detail/'.$has_berita))->with('sukses', 'Data Berhasil di Simpan');
                }else{
                    return redirect()->to(base_url('admin/event'))->with('warning', 'Data Gagal di Simpan');
                }
                
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            return redirect()->to(base_url('admin/event'))->with('warning', 'Akses Illegal');
        } 
    }
    // edit
    public function edit($has_kelas)
    {
        checklogin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $m_metode_belajar   = new Metode_belajar_model();
        $m_kelas            = new Kelas_model();
        $m_user             = new User_model();
        $user               = $m_user->listing();
        $kategori_kelas     = $m_kategori_kelas->listing();
        $kelas              = $m_kelas->detail($has_kelas);
        $metode_belajar     = $m_metode_belajar->findAll();
        $data               = [
            'title'             => $kelas['nama_kelas'],
            'kategori_kelas'    => $kategori_kelas,
            'metode_belajar'    => $metode_belajar,
            'kelas'             => $kelas,
            'user'              => $user,
            'content'           => 'admin/kelas/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // UPDATE
    public function update($has_kelas)
    {
        checklogin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $m_kelas            = new Kelas_model();
        $kategori_kelas     = $m_kategori_kelas->listing();
        $kelas              = $m_kelas->detail($has_kelas);
        // Start validasi
        if ($this->request->getMethod() === 'post')
        {
            if (! empty($_FILES['gambar']['name']))
            {
                $data_validasi = [
                    'nama_kelas' => 'required',
                    'gambar' => [
                        'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[gambar,4096]',
                    ],
                ];
                if($this->validate($data_validasi)) 
                {
                    // Image upload
                    $avatar   = $this->request->getFile('gambar');
                    $namabaru = str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/image/', $namabaru);
                    // Create thumb
                    $image = \Config\Services::image()
                    ->withFile('assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save('assets/upload/image/thumbs/' . $namabaru);
                    // masuk database
                    $data = [
                        
                        'nama_kelas'            => $this->request->getVar('nama_kelas'),
                        'tanggal_mulai'         => date('Y-m-d', strtotime($this->request->getVar('tanggal_mulai'))),
                        'tanggal_selesai'       => date('Y-m-d', strtotime($this->request->getVar('tanggal_selesai'))),
                        'kategori_kelas'        => $this->request->getVar('kategori_kelas'),
                        'kuota'                 => $this->request->getVar('kuota'),
                        'harga_dasar'           => $this->request->getVar('harga_dasar'),
                        'harga_jual'            => $this->request->getVar('harga_jual'),
                        'status'                => $this->request->getVar('status'),
                        'metode_belajar'        => $this->request->getVar('metode_belajar'),
                        'poster'                => $namabaru,
                        'has_kelas'             => $has_kelas
                    ];
                    var_dump($data);
                    $m_kelas->edit($data);
                    return redirect()->to(base_url('admin/kelas/detail/'.$has_kelas))->with('sukses', 'Data Berhasil di Simpan dengan gambar baru');
                }else{
                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->back()->withInput();
                }
            }else{
                $data_validasi = [
                    'nama_kelas' => 'required',
                ];
                if($this->validate($data_validasi))
                {
                    $data = [
                        
                        'nama_kelas'            => $this->request->getVar('nama_kelas'),
                        'tanggal_mulai'         => date('Y-m-d', strtotime($this->request->getVar('tanggal_mulai'))),
                        'tanggal_selesai'       => date('Y-m-d', strtotime($this->request->getVar('tanggal_selesai'))),
                        'kategori_kelas'        => $this->request->getVar('kategori_kelas'),
                        'kuota'                 => $this->request->getVar('kuota'),
                        'harga_dasar'           => $this->request->getVar('harga_dasar'),
                        'harga_jual'            => $this->request->getVar('harga_jual'),
                        'status'                => $this->request->getVar('status'),
                        'metode_pembelajaran'   => $this->request->getVar('metode_pembelajaran'),
                        'has_kelas'             => $has_kelas
                    ];
                    var_dump($data);
                    $m_kelas->edit($data);
                    return redirect()->to(base_url('admin/kelas/detail/'.$has_kelas))->with('sukses', 'Data Berhasil di Simpan tanpa gambar');
                }else{
                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->back()->withInput();
                }
            }
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
