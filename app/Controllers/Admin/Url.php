<?php

namespace App\Controllers\Admin;

use App\Models\Url_model;

class Url extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->listing($id_user);
        $total      = $m_url->total();
        $data = [
            'title'     => 'List Url ('.$total.')',
            'url'       => $url,
            'content'   => 'admin/url_short/index',
        ];
        $to         = "khaironbiz@gmail.com";
        $subject    = "Kirim Email dengan fungsi";
        $token      = uniqid();
        $message    = "ini adalah cara untuk mengirim email $token";
        $this->sendMail($to,$subject,$message,2);
        echo view('admin/layout/wrapper', $data);
    }
    //tambah
    public function tambah(){
        checklogin();
        $m_url      = new Url_model();
        $url        = $m_url->listing();
        $total      = $m_url->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'url_asli'  => 'required|min_length[3]|is_unique[url.url_asli]',
                'short' => 'required|min_length[3]|is_unique[url.short]',
            ]
        )) {
            // masuk database
            
            $url_asli       = $this->request->getPost('url_asli');
            $short          = $this->request->getPost('short');
            $data           = [                
                'url_asli'      => $url_asli,
                'short'         => $short,
                'created_by'    => $this->session->get('id_user'),
                'created_at'    => date('Y-m-d H:i:s'),
                'has_url'       => md5(uniqid())
            ];
            $m_url->save($data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah ditambah');
            return redirect()->to(base_url('a/b/'.$short));
        }
        //return redirect()->to(base_url('a/b/'.$short));
    }
    //send email
    private function sendMail($to,$subject,$message,$server=1) {
        $email = \Config\Services::email();

        if($server==1){
            $email_pengirim = "server@hpii.or.id";
            $email_password = "@Pentagon250909#";
            $smtp_host      = "smtp.hostinger.com";
            $nama_pengirim  = "Himpunan Perawat Informatika Indonesia";
        }else if($server==2){
            $email_pengirim = "hpii.ppni@gmail.com";
            $email_password = "@Mail250909#";
            $smtp_host      = "smtp.gmail.com";
            $nama_pengirim  = "Himpunan Perawat Informatika Indonesia";
        }
        $config["protocol"]     = "smtp";
        $config["SMTPHost"]     = $smtp_host;
        $config["SMTPUser"]     = $email_pengirim;
        $config["SMTPPass"]     = $email_password;
        $config["SMTPPort"]     = 465;
        $config["SMTPCrypto"]   = "ssl";
        $email->initialize($config);
        $email->setTo($to);

        $email->setFrom($email_pengirim, $nama_pengirim);
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send())
        {
            echo 'Email successfully sent';
        }
        else
        {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
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
