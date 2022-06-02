<?php

namespace App\Controllers;

use App\Models\Client_model;
use App\Models\Kelas_model;
use App\Models\Kelas_peserta_model;
use App\Models\Konfigurasi_model;
use App\Models\Materi_file_model;
use App\Models\Materi_model;
use App\Models\Soal_model;
use App\Models\Tugas_kelas_model;

class Kelas extends BaseController
{
    // Client
    public function index()
    {
        $m_konfigurasi = new Konfigurasi_model();
        $m_client      = new Client_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $client        = $m_client->home();

        $data = [
            'title'         => 'Client Kami',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'client'        => $client,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'client/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // kelas yang dimiliki oleh user
    public function progress(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_user_progress($id_user);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // kelas yang dimiliki oleh user
    public function main(){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_user($id_user);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // all
    public function soon(){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_user_soon($id_user);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // may room class
    public function room($has_kelas){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user'); 
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();       
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas       = $kelas->id_kelas;
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas_list = $m_tugas_kelas->list_by_id_kelas($id_kelas);
        $m_materi       = new Materi_model();
        $materi         = $m_materi->list_id_kelas($id_kelas);
//        var_dump($kelas);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'materi'        => $materi,
            'tugas_kelas'   => $tugas_kelas_list,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/room',
        ];
        echo view('layout/wrapper', $data);
    }
    // may room class
    public function materi($has_kelas){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas       = $kelas->id_kelas;
        $m_materi       = new Materi_model();
        $materi         = $m_materi->list_id_kelas($id_kelas);
//        var_dump($kelas);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'materi'        => $materi,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/materi',
        ];
        echo view('layout/wrapper', $data);
    }
    public function peserta($has_kelas){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas       = $kelas->id_kelas;
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_kelas($id_kelas, 'kelas_peserta.nama_sertifikat', 'ASC');
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->list_by_id_kelas($id_kelas);
        $data           = [
            'title'         => 'Peserta',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'peserta'       => $peserta,
            'tugas_kelas'    => $tugas_kelas,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/peserta',
        ];
        echo view('layout/wrapper', $data);

    }
    public function conference($has_kelas){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas       = $kelas->id_kelas;
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_kelas($id_kelas, 'kelas_peserta.nama_sertifikat', 'ASC');
        $data           = [
            'title'         => 'Peserta',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'peserta'       => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/conference',
        ];
        echo view('layout/wrapper', $data);

    }
    public function tugas($has_tugas_kelas){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_tugas_kelas  = new Tugas_kelas_model();
        $tugas_kelas    = $m_tugas_kelas->detail($has_tugas_kelas);
        $id_tugas_kelas = $tugas_kelas['id_tugas_kelas'];
        $id_kelas       = $tugas_kelas['id_kelas'];
        $tugas_kelas_list = $m_tugas_kelas->list_by_id_kelas($id_kelas);
        $m_soal         = new Soal_model();
        $soal           = $m_soal->list_id_tugas_kelas($id_tugas_kelas);
        $count_soal     = $m_soal->count_id_tugas_kelas($id_tugas_kelas);
        $m_kelas        = new Kelas_model();
        $kelas          = $m_kelas->by_id_kelas($id_kelas);
        $data           = [
            'title'         => 'Tugas Kelas',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'tugas_kelas_detail'   => $tugas_kelas,
            'tugas_kelas'   => $tugas_kelas_list,
            'soal'          => $soal,
            'count_soal'    => $count_soal,
            'kelas'         => $kelas,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/tugas',
        ];

        echo view('layout/wrapper', $data);

    }
}
