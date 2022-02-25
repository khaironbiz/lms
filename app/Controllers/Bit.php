<?php

namespace App\Controllers;

use App\Models\Url_model;
use App\Models\Konfigurasi_model;

class Bit extends BaseController
{
    // index
    public function ly($sort)
    {
        $m_url          = new url_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $url            = $m_url->ly($sort);
        $count_short    = $m_url->count($sort);
        $konfigurasi    = $m_konfigurasi->listing();
        if($count_short > 0){
        $url_asli       = $url['url_asli'];
            return redirect()->to($url_asli);
        }else{
            $data = [
            'title'         => 'Page Not Found',
            'description'   => 'Page Not Found ',
            'keywords'      => 'Berita ' . $konfigurasi['namaweb'],
            'content'       => 'not_found/index',
        ];
        echo view('layout/wrapper', $data);
        }
        
    }

}
