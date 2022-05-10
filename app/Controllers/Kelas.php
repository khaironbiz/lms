<?php

namespace App\Controllers;

use App\Models\Client_model;
use App\Models\Kelas_model;
use App\Models\Kelas_peserta_model;
use App\Models\Konfigurasi_model;

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
    // may room class
    public function room($has_kelas){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user'); 
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();       
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/room',
        ];
        echo view('layout/wrapper', $data);
    }
}
