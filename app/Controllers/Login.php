<?php

namespace App\Controllers;

use App\Models\Konfigurasi_model;
use App\Models\User_model;
use App\Models\Token_model;
use App\Models\Provinsi_model;
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
    public function register()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $m_provinsi     = new Provinsi_model();
        $provinsi       = $m_provinsi->listing();
        $konfigurasi   = $m_konfigurasi->listing();
        $data = [
            'title'         => 'Registrasi',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
            'provinsi'      => $provinsi,
        ];
        echo view('login/register', $data);
        // End proses
    }
    //daftar
    public function daftar(){
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
        ))
        {
            $nama           = $this->request->getVar('nama');
            $jenis_kelamin  = $this->request->getVar('jenis_kelamin');
        }
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
    // change password
    public function reset($token)
    {
        $session        = \Config\Services::session();
        $m_token        = new Token_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $data_token     = $m_token->reset($token);
        $hitung_token   = $m_token->count_token($token);
        if($hitung_token['count']<1){
            $this->session->setFlashdata('warning', 'Halaman tidak ditemukan');
            return redirect()->to(base_url('login'));        
        }else{
            $data = [
            'title'         => 'Lupa Password',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
            'token'         => $data_token['token'],
            'id_token'      => $data_token['id_token'],
            'nama'          => $data_token['nama'],
        ];
        // var_dump($data_token);
        // echo $hitung_token['count'];
        echo view('login/reset', $data);
        }
        
    }
    // change password
    public function reset_password($token)
    {
        $session        = \Config\Services::session();
        $m_token        = new Token_model();
        $m_user         = new User_model();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
                [
                    'password_1' => 'required|min_length[3]|matches[password_2]',
                ]
            )) {
            $password           = $this->request->getPost('password_1');
            $data_token         = $m_token->reset($token);
            $hitung_token       = $m_token->count_token($token);
            if ($hitung_token['count']>0){
                $id_user        = $data_token['created_by'];
                $id_token       = $data_token['id_token'];
                $read_at        = time();
                $isi_token      = [
                    'id_token'  => $data_token['id_token'],
                    'read_at'   => $read_at,
                ];
                $data_user      = [
                    'id_user'   => $data_token['created_by'],
                    'password'  => sha1($password),
                ];
                // var_dump($data_user);
                $m_user->update($id_user, $data_user);
                $m_token->update($id_token, $isi_token);
                $this->session->setFlashdata('sukses', 'Password berhasil dibuat');
                return redirect()->to(base_url('login'));
            }else{
                    $this->session->setFlashdata('warning', 'Periksa Kembali email anda, pastikan email yang anda masukkan terdftar pada sistem kami');
                    return redirect()->to(base_url('login/lupa'));
            }
        }
    }
    // lupa
    public function lupa(){
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
    public function password_request(){
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
                $token      = md5(uniqid());
                $exp_date   = time()+(60*60*24);
                $data       = [
                    'token'         => $token,
                    'created_by'    => $id_user,
                    'exp_date'      => $exp_date,
                    'jenis_token'   => "Reset Password",
                    'created_at'    => date('Y-m-d H:i:s')
                ];
                $add_token  = $m_token->save($data);
                if($add_token){
                    $to         = "khaironbiz@gmail.com";
                    $subject    = "Reset Password";
                    $alamat_ip  = $_SERVER['REMOTE_ADDR'];
                    $time_login = date('Y-m-d H:i:s');
                    $browser    = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
                    $url_reset  = base_url().'/login/reset/'.$token;
                    $link       = "<a href='$url_reset'>Reset</a>";
                    $link_2     = "<a href='$url_reset'>$url_reset</a>";
                    $message    = "
                                    <p>Anda Berhasil Login</p>
                                    <p>$link atau copy tautan dibawah ini</p>
                                    <p>$link_2</p>
                                    <p>Browser   : $browser</p>
                                    <p>IP Address : $alamat_ip</p>
                                    <p>Waktu Reset  : $time_login</p>
                                    <p>Abaikan email ini jika anda tidak merasa mengajukan reset password.</p>
                                ";
                    $this->sendMail($to, $subject, $message, 2);
                    $this->session->setFlashdata('sukses', 'Hai ' . $user['nama'] . ', permohonan reset password telah dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }else{
                    $this->session->setFlashdata('warning', 'Hai , permohonan reset password gagal dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }
            }else{
                    $this->session->setFlashdata('warning', 'Periksa Kembali email anda, pastikan email yang anda masukkan terdftar pada sistem kami');
                    return redirect()->to(base_url('login/lupa'));
            }
        }
    }
    // Logout
    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('login?logout=sukses'));
    }
    //send email
    private function sendMail($to,$subject,$message,$server=1){
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
        if ($email->send()){
            echo 'Email successfully sent';
        }
        else{
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
