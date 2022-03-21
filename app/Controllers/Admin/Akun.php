<?php

namespace App\Controllers\Admin;

use App\Models\User_model;

class Akun extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        checklogin();
        $id_user = $this->session->get('id_user');
        $m_user  = new User_model();
        $user    = $m_user->detail($id_user);

        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'id_user' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            if (! empty($_FILES['gambar']['name'])) {
                // Image upload
                $avatar   = $this->request->getFile('gambar');
                $namabaru = $avatar->getRandomName();
                $avatar->move('assets/upload/image/', $namabaru);
                // Create thumb
                $image = \Config\Services::image()
                    ->withFile('assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save('assets/upload/image/thumbs/' . $namabaru);
                // masuk database
                // masuk database
                if (strlen($this->request->getPost('password')) >= 6 && strlen($this->request->getPost('password')) <= 32) {
                    $data = [
                        'nama'      => $this->request->getPost('nama'),
                        'email'     => $this->request->getPost('email'),
                        'username'  => $this->request->getPost('username'),
                        'password'  => sha1($this->request->getPost('password')),
                        'gambar'    => $namabaru,
                    ];
                } else {
                    $data = [
                        'nama'      => $this->request->getPost('nama'),
                        'email'     => $this->request->getPost('email'),
                        'username'  => $this->request->getPost('username'),
                        'gambar'    => $namabaru,
                    ];
                }
            } else {
                // masuk database
                if (strlen($this->request->getPost('password')) >= 6 && strlen($this->request->getPost('password')) <= 32) {
                    $data = [
                        'nama'      => $this->request->getPost('nama'),
                        'email'     => $this->request->getPost('email'),
                        'username'  => $this->request->getPost('username'),
                        'password'  => sha1($this->request->getPost('password')),
                    ];
                } else {
                    $data = [
                        'nama'      => $this->request->getPost('nama'),
                        'email'     => $this->request->getPost('email'),
                        'username'  => $this->request->getPost('username'),
                    ];
                }
            }
            $m_user->update($id_user, $data);
            //file attachment
            $attachment = base_url('asstets/upload/file/Daftar_Harga_Kursus_2020_v2.pdf');
            //html message untuk body email
            $message = "<h1>Invoice Pembelian</h1>Kepada Berikut Invoice atas pembelian";
            //memanggil private function sendEmail
            $this->sendEmail($attachment, 'khaironbiz@gmail.com', 'Invoice', $message);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah diedit');
            return redirect()->to(base_url('admin/akun'));
        }
        $data = [
            'title'     => 'Update Profile: ' . $user['nama'],
            'user'      => $user,
            'content'   => 'admin/akun/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    //send email
    private function sendEmail($attachment, $to, $title, $message){

		$this->email->setFrom('hpii.ppni@gmail.com','khairon');
		$this->email->setTo($to);

		$this->email->attach($attachment);

		$this->email->setSubject($title);
		$this->email->setMessage($message);

		if(! $this->email->send()){
			return false;
		}else{
			return true;
		}
	}
}
