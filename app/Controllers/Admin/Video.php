<?php

namespace App\Controllers\Admin;

use App\Models\Materi_model;
use App\Models\Video_model;

class Video extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        admin();
        $m_video = new Video_model();
        $video   = $m_video->listing();
        $total   = $m_video->total();

        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'judul' => 'required',
            ]
        )) {
            // masuk database
            $data = [
                'id_user'       => $this->session->get('id_user'),
                'judul'         => $this->request->getPost('judul'),
                'keterangan'    => $this->request->getPost('keterangan'),
                'video'         => $this->request->getPost('video'),
                'tanggal_post'  => date('Y-m-d H:i:s'),
            ];
            $m_video->save($data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah ditambah');

            return redirect()->to(base_url('admin/video'));
        }
        $data = ['title' => 'Video Youtube: ' . $total['total'],
            'video'      => $video,
            'content'    => 'admin/video/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function add($has_materi){
        checklogin();
        admin();
        $m_video    = new Video_model();
        $video      = $m_video->listing();
        $total      = $m_video->total();
        $m_materi   = new Materi_model();
        $materi     = $m_materi->has_materi($has_materi);
        $data = [
            'title'     => 'Video Youtube: ' . $total['total'],
            'materi'    => $materi,
            'video'     => $video,
            'content'   => 'admin/video/add',
        ];
        echo view('admin/layout/wrapper', $data);

    }
    // create
    public function create($has_materi){
        checklogin();
        admin();
        $m_materi       = new Materi_model();
        $materi         = $m_materi->has_materi($has_materi);
        $m_video        = new Video_model();
        $data_validasi = [
            'judul' => 'required',
            'video' => 'required',
        ];
        if ($this->request->getMethod() === 'post') {
            if($this->validate($data_validasi)){
                $data = [
                    'id_user' => $this->session->get('id_user'),
                    'judul' => $this->request->getPost('judul'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'video' => $this->request->getPost('video'),
                ];
                $m_video->save($data);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah ditambahkan');

                return redirect()->to(base_url('admin/materi_file/video/'.$has_materi));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            echo "Anda Tersesat";
        }
    }
    // edit
    public function edit($id_video)
    {
        checklogin();
        admin();
        $m_video = new Video_model();
        $video   = $m_video->detail($id_video);

        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'judul' => 'required|min_length[3]',
            ]
        )) {
            $data = [
                'id_video'      => $id_video,
                'id_user'       => $this->session->get('id_user'),
                'judul'         => $this->request->getPost('judul'),
                'keterangan'    => $this->request->getPost('keterangan'),
                'video'         => $this->request->getPost('video'),
            ];
            $m_video->update($id_video, $data);
            // masuk database
            $this->session->setFlashdata('sukses', 'Data telah diedit');

            return redirect()->to(base_url('admin/video'));
        }
        $data = ['title' => 'Edit Video: ' . $video['judul'],
            'video'      => $video,
            'content'    => 'admin/video/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // delete
    public function delete($id_video)
    {
        checklogin();
        admin();
        $m_video = new Video_model();
        $data    = ['id_video' => $id_video];
        $m_video->delete($data);
        // masuk database
        $this->session->setFlashdata('sukses', 'Data telah dihapus');

        return redirect()->to(base_url('admin/video'));
    }
}
