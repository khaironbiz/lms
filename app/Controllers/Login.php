<?php

namespace App\Controllers;

use App\Models\Konfigurasi_model;
use App\Models\User_model;
use App\Models\Token_model;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    // Homepage
    public function index()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $data = [
            'title'         => 'Member Area',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
        ];
        echo view('login/index', $data);

        // End proses
    }
    // login
    public function login()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[3]',
            ]
        )) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user     = $m_user->login($username, $password);

            // Proses login
            if ($user) {
                // Jika username password benar
                $this->session->set('username', $username);
                $this->session->set('gambar', $user['gambar']);
                $this->session->set('id_user', $user['id_user']);
                $this->session->set('akses_level', $user['akses_level']);
                $this->session->set('nama', $user['nama']);
                $this->session->setFlashdata('sukses', 'Hai ' . $user['nama'] . ', Anda berhasil login');
                //return redirect()->to(base_url('admin/dasbor'));
                $to         = "khaironbiz@gmail.com";
                $subject    = "Login Sukses";
                $alamat_ip  = $_SERVER['REMOTE_ADDR'];
                $time_login = date('Y-m-d H:i:s');
                $browser    = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
                $message    = "
                                 <p>Anda Berhasil Login</p>
                                 <p>Browser   : $browser</p>
                                 <p>IP Address : $alamat_ip</p>
                                 <p>Waktu Login  : $time_login</p>
                                 <p>Jika anda tidak melakukan login dengan akun anda silahkan reset password akun anda, mungkin seseorang telah menggunakan akun anda</p>
                                 ";
                $this->sendMail($to,$subject,$message,2);
                return redirect()->to(base_url());
            }
            // jika username password salah
            $this->session->setFlashdata('warning', 'Username atau password salah');
            return redirect()->to(base_url('login'));
        }
        // End validasi
    }

    // lupa
    public function lupa()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();

        $data = [
            'title'         => 'Lupa Password',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
        ];
        echo view('login/lupa', $data);
    }
    // request password
    public function password_request()
    {
        $session    = \Config\Services::session();
        $m_token    = new Token_model();
        $m_user     = new User_model();

        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
                [
                    'email' => 'required|min_length[3]|valid_email',

                ]
            )) {
            $email              = $this->request->getPost('email');
            $count_email        = $m_user->count_email($email);
            $count_email_user   = $count_email['count'];
            if ($count_email_user>0){
                $user       = $m_user->reset_password($email);
                $id_user    = $user['id_user'];

                $exp_date   = time()+(60*60*24);
                $data       = [
                    'token'         => md5(uniqid()),
                    'created_by'    => $id_user,
                    'exp_date'      => $exp_date,
                    'jenis_token'   => "Reset Password",
                    'created_at'    => date('Y-m-d H:i:s')
                ];
                $add_token  = $m_token->save($data);
                if($add_token){
                    $to = "khaironbiz@gmail.com";
                    $subject = "Login Sukses";
                    $alamat_ip = $_SERVER['REMOTE_ADDR'];
                    $time_login = date('Y-m-d H:i:s');
                    $browser = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
                    $message = "
                                 <p>Anda Berhasil Login</p>
                                 <p>Browser   : $browser</p>
                                 <p>IP Address : $alamat_ip</p>
                                 <p>Waktu Login  : $time_login</p>
                                 <p>Jika anda tidak melakukan login dengan akun anda silahkan reset password akun anda, mungkin seseorang telah menggunakan akun anda</p>
                                 ";
                    $this->sendMail($to, $subject, $message, 2);
                    $this->session->setFlashdata('sukses', 'Hai ' . $user['nama'] . ', permohonan reset password telah dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }else{
                    $this->session->setFlashdata('sukses', 'Hai , permohonan reset password gagal dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }
            }else{

            }
        }
    }
    // Logout
    public function logout()
    {
        $this->session->destroy();

        return redirect()->to(base_url('login?logout=sukses'));
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
    private function get_browser_name($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

        return 'Other';
    }

}
