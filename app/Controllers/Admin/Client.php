<?php

namespace App\Controllers\Admin;

use App\Models\Client_model;

class Client extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        admin();
        $m_client = new Client_model();
        $client   = $m_client->listing();
        $total    = $m_client->total();
        $data = [
            'title'     => 'Data Client: ' . $total['total'],
            'client'    => $client,
            'content'   => 'admin/client/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        checklogin();
        admin();
        $m_client = new Client_model();
        $client   = $m_client->listing();
        $total    = $m_client->total();

        // Start validasi
        if ($this->request->getMethod() === 'post'){
            $data_validasi = [
                'nama' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ];
            if($this->validate($data_validasi)){
                if (! empty($_FILES['gambar']['name'])) {
                    // Image upload
                    $avatar   = $this->request->getFile('gambar');
                    $namabaru = str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/client/', $namabaru);
                    // Create thumb
                    $image = \Config\Services::image()
                        ->withFile('assets/upload/client/' . $namabaru)
                        ->fit(100, 100, 'center')
                        ->save('assets/upload/client/thumbs/' . $namabaru);
                    // masuk database
                    // masuk database
                    $data = ['id_user'  => $this->session->get('id_user'),
                        'jenis_client'  => $this->request->getPost('jenis_client'),
                        'nama'          => $this->request->getPost('nama'),
                        'pimpinan'      => $this->request->getPost('pimpinan'),
                        'alamat'        => $this->request->getPost('alamat'),
                        'telepon'       => $this->request->getPost('telepon'),
                        'website'       => $this->request->getPost('website'),
                        'email'         => $this->request->getPost('email'),
                        'isi_testimoni' => $this->request->getPost('isi_testimoni'),
                        'gambar'        => $namabaru,
                        'status_client' => $this->request->getPost('status_client'),
                        'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
                        'tanggal_lahir' => date('Y-m-d', strtotime($this->request->getPost('tanggal_lahir'))),
                        'tanggal_post'  => date('Y-m-d H:i:s'),
                        'has_client'    => md5(uniqid()),
                    ];
                    $m_client->tambah($data);
                    // masuk database
                    $this->session->setFlashdata('sukses', 'Data telah ditambah');
    
                    return redirect()->to(base_url('admin/client'));
                }else{
                    // masuk database
                    $data = [
                        'id_user'       => $this->session->get('id_user'),
                        'jenis_client'  => $this->request->getPost('jenis_client'),
                        'nama'          => $this->request->getPost('nama'),
                        'pimpinan'      => $this->request->getPost('pimpinan'),
                        'alamat'        => $this->request->getPost('alamat'),
                        'telepon'       => $this->request->getPost('telepon'),
                        'website'       => $this->request->getPost('website'),
                        'email'         => $this->request->getPost('email'),
                        'isi_testimoni' => $this->request->getPost('isi_testimoni'),
                        // 'gambar'		=> $namabaru,
                        'status_client' => $this->request->getPost('status_client'),
                        'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
                        'tanggal_lahir' => date('Y-m-d', strtotime($this->request->getPost('tanggal_lahir'))),
                        'tanggal_post'  => date('Y-m-d H:i:s'),
                        'has_client'    => md5(uniqid()),
                    ];
                    $m_client->tambah($data);
                    // masuk database
                    $this->session->setFlashdata('sukses', 'Data telah ditambah');
                    return redirect()->to(base_url('admin/client'));
                }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
           
          $this->session->setFlashdata('warning', 'Akses Illegal');
          return redirect()->to(base_url('admin/client'));
        }
    }
    // edit
    public function edit($has_client){
        checklogin();
        admin();
        $m_client = new Client_model();
        $client   = $m_client->has_client($has_client);
        $data = [
            'title'     => 'Edit Data Client: ' . $client['nama'],
            'client'    => $client,
            'content'   => 'admin/client/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function update($has_client){
        checklogin();
        admin();
        $m_client = new Client_model();
        $client   = $m_client->has_client($has_client);
        // Start validasi
        if ($this->request->getMethod() === 'post'){
            $data_validasi = [
                'nama'      => 'required',
                'gambar'    => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ];
            if($this->validate($data_validasi)){
                if (! empty($_FILES['gambar']['name'])) {
                    // Image upload
                    $avatar   = $this->request->getFile('gambar');
                    $namabaru = str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/client/', $namabaru);
                    // Create thumb
                    $image = \Config\Services::image()
                        ->withFile('assets/upload/client/' . $namabaru)
                        ->fit(500, 500, 'center')
                        ->save('assets/upload/client/thumbs/' . $namabaru);
                    $image_midle = \Config\Services::image()
                        ->withFile('assets/upload/client/' . $namabaru)
                        ->fit(600, 400, 'center')
                        ->save('assets/upload/client/midle/' . $namabaru);
                    // masuk database
                    // masuk database
                    $data = [
                        'id_client'         => $client['id_client'],
                        'id_user'           => $this->session->get('id_user'),
                        'jenis_client'      => $this->request->getPost('jenis_client'),
                        'nama'              => $this->request->getPost('nama'),
                        'pimpinan'          => $this->request->getPost('pimpinan'),
                        'alamat'            => $this->request->getPost('alamat'),
                        'telepon'           => $this->request->getPost('telepon'),
                        'website'           => $this->request->getPost('website'),
                        'email'             => $this->request->getPost('email'),
                        'isi_testimoni'     => $this->request->getPost('isi_testimoni'),
                        'gambar'            => $namabaru,
                        'status_client'     => $this->request->getPost('status_client'),
                        'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
                        'tanggal_lahir'     => date('Y-m-d', strtotime($this->request->getPost('tanggal_lahir'))),
                        'has_client'        => md5(uniqid()),
                    ];
                    
                    // masuk database
                }else{
                // masuk database
                $data = [
                    'id_client'         => $client['id_client'],
                    'id_user'           => $this->session->get('id_user'),
                    'jenis_client'      => $this->request->getPost('jenis_client'),
                    'nama'              => $this->request->getPost('nama'),
                    'pimpinan'          => $this->request->getPost('pimpinan'),
                    'alamat'            => $this->request->getPost('alamat'),
                    'telepon'           => $this->request->getPost('telepon'),
                    'website'           => $this->request->getPost('website'),
                    'email'             => $this->request->getPost('email'),
                    'isi_testimoni'     => $this->request->getPost('isi_testimoni'),
                    'status_client'     => $this->request->getPost('status_client'),
                    'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir'     => date('Y-m-d', strtotime($this->request->getPost('tanggal_lahir'))),
                    'has_client'        => md5(uniqid()),
                ];
                
                }
                $update_klien = $m_client->edit($data);
                $this->session->setFlashdata('sukses', 'Data telah disimpan');
                return redirect()->to(base_url('admin/client'));
                    if($update_klien ='NULL'){
                        $this->session->setFlashdata('warning', 'Data gagal disimpan');
                        return redirect()->to(base_url('admin/client'));
                    }else{
                        
                    }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }
    }

    // delete
    public function delete($id_client)
    {
        checklogin();
        admin();
        $m_client = new Client_model();
        $data     = ['id_client' => $id_client];
        $m_client->delete($data);
        // masuk database
        $this->session->setFlashdata('sukses', 'Data telah dihapus');

        return redirect()->to(base_url('admin/client'));
    }
}
