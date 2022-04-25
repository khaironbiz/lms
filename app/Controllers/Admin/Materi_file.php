<?php

namespace App\Controllers\Admin;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use App\Models\Materi_model;
use App\Models\Materi_file_model;
use App\Models\User_model;
use App\Models\Kelas_model;

class Materi_file extends BaseController
{
    // index
    public function index()
    {
        checklogin();
        $m_materi_file      = new Materi_file_model();
        $materi_file        = $m_materi_file->listing();
        $data = [
            'title'         => 'Daftar Kumpulan Materi Pembelajaran',
            'materi_file'   => $materi_file,
            'content'       => 'admin/materi_file/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function file($has_materi)
    {
        checklogin();
        $m_materi           = new Materi_model();
        $materi             = $m_materi->has_materi($has_materi);
        $m_materi_file      = new Materi_file_model();
        $materi_file        = $m_materi_file->file();
        $data = [
            'title'         => 'Tambah Bahan Ajar Materi : '.$materi['materi'],
            'materi_file'   => $materi_file,
            'materi'        => $materi, 
            'content'       => 'admin/materi_file/add-file',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function video()
    {
        checklogin();
        $m_materi_file      = new Materi_file_model();
        $materi_file        = $m_materi_file->video();
        $data = [
            'title'         => 'Daftar Kumpulan Materi Pembelajaran',
            'materi_file'   => $materi_file,
            'content'       => 'admin/materi_file/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // kategori
    public function detail($has_materi_file)
    {
        checklogin();
        $m_materi   = new Materi_model();
        $m_kategori = new Kategori_model();
        $materi     = $m_materi->has_materi($has_materi);
        $data = [
            'title'     => "Detail Materi ".$materi['materi'],
            'materi'    => $materi,
            'content'   => 'admin/materi/detail',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    
    // save add
    public function add()
    {
        checklogin();
        $m_kategori = new Kategori_model();
        $m_kelas    = new kelas_model();
        $m_materi   = new Materi_model();
        $kategori   = $m_kategori->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'materi'    => 'required|min_length[6]',
                'pemateri'  => 'required|numeric',
            ]
        )) {
            $has_kelas      = $this->request->getVar('kelas');
            $kelas          = $m_kelas->detail($has_kelas);
            $id_kelas       = $kelas['id_kelas'];
            $id_event       = $kelas['id_event'];
            $waktu_mulai    = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_mulai')." ".$this->request->getVar('jam_mulai')));
            $waktu_selesai  = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_selesai')." ".$this->request->getVar('jam_selesai')));
            $data           = [
                'id_event'      => $id_event,
                'id_kelas'      => $id_kelas,
                'materi'        => $this->request->getVar('materi'),
                'pemateri'      => $this->request->getVar('pemateri'),
                'waktu_mulai'   => $waktu_mulai,
                'waktu_selesai' => $waktu_selesai,
                'created_by'    => $this->session->get('id_user'),
                'created_at'    => date('Y-m-d H:i:s'),
                'has_materi'    => md5(uniqid()),
            ];
            $m_materi->save($data);
            return redirect()->to(base_url('admin/event/detail/'."/".$has_event))->with('sukses', 'Data Berhasil di Simpan');;
            // echo $waktu_mulai;
        }
    }
    public function update($has_materi)
    {
        checklogin();
        $m_kategori = new Kategori_model();
        $m_kelas    = new kelas_model();
        $m_materi   = new Materi_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'materi'    => 'required|min_length[6]',
                'pemateri'  => 'required|numeric',
            ]
        )) {
            
            $waktu_mulai    = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_mulai')." ".$this->request->getVar('jam_mulai')));
            $waktu_selesai  = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_selesai')." ".$this->request->getVar('jam_selesai')));
            $materi         = $m_materi->has_materi($has_materi);
            $id_materi      = $materi['id_materi'];
            $id_event       = $materi['id_event'];
            $berita         = $m_berita->by_id($id_event);
            $data           = [
                'materi'        => $this->request->getVar('materi'),
                'pemateri'      => $this->request->getVar('pemateri'),
                'waktu_mulai'   => $waktu_mulai,
                'waktu_selesai' => $waktu_selesai,
                'updated_at'    => date('Y-m-d H:i:s'),
                'blokir'        => $this->request->getVar('blokir'),
            ];
            $m_materi->update($id_materi, $data);
            return redirect()->to(base_url('admin/event/detail/'."/".$berita['has_berita']))->with('sukses', 'Data Berhasil di Simpan');;
        //    var_dump($materi) ;
        }
    }
}
