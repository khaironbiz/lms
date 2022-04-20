<?php

namespace App\Models;

use CodeIgniter\Model;

class Dasbor_model extends Model
{
    // berita
    public function berita()
    {
        $builder = $this->db->table('berita');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    public function event()
    {
        $builder = $this->db->table('berita');
        $builder->where(['jenis_berita'  => 'Event' ]);
        $query   = $builder->get();
        return $query->getNumRows();
    }

    // user
    public function user()
    {
        $builder = $this->db->table('users');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // client
    public function client()
    {
        $builder = $this->db->table('client');
        $query   = $builder->get();

        return $query->getNumRows();
    }
    // url
    public function url()
    {
        $builder = $this->db->table('url');
        $query   = $builder->get();

        return $query->getNumRows();
    }
    // organisasi
    public function op()
    {
        $builder = $this->db->table('organisasi_profesi');
        $query   = $builder->get();

        return $query->getNumRows();
    }
    // statistik
    public function hits()
    {
        $builder = $this->db->table('user_logs');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // galeri
    public function galeri()
    {
        $builder = $this->db->table('galeri');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // video
    public function video()
    {
        $builder = $this->db->table('video');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // download
    public function download()
    {
        $builder = $this->db->table('download');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // staff
    public function staff()
    {
        $builder = $this->db->table('staff');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori_download
    public function kategori_download()
    {
        $builder = $this->db->table('kategori_download');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori
    public function kategori()
    {
        $builder = $this->db->table('kategori');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori_staff
    public function kategori_staff()
    {
        $builder = $this->db->table('kategori_staff');
        $query   = $builder->get();

        return $query->getNumRows();
    }
}
