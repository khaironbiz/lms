<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelas_model extends Model
{
    protected $table         = 'kelas';
    protected $primaryKey    = 'id_kelas';
    protected $allowedFields = [
                                'pic_kelas',
                                'id_event',
                                'nama_kelas',
                                'kategori_kelas',
                                'tanggal_mulai',
                                'tanggal_selesai',
                                'kuota',
                                'status',
                                'harga_dasar',
                                'harga_jual', 
                                'has_kelas',];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, berita.judul_berita, users.nama');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->join('users', 'users.id_user = kelas.pic_kelas', 'LEFT');
        $builder->orderBy('kelas.id_event', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Event
    public function event($id_event)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, berita.judul_berita');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->where([
                    'kelas.id_event'  => $id_event,
                    'kelas.status'    => '1']);
        $builder->orderBy('kelas.id_kelas', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // kelas by has
    public function by_has_kelas($has_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*');
        
        $builder->where([
                    'kelas.has_kelas'   => $has_kelas,
                    'kelas.status'      => '1']);
        $builder->orderBy('kelas.id_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRow();
    }
    // kelas by id_kelas
    public function by_id_kelas($id_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*');
        $builder->where([
                    'kelas.id_kelas'   => $id_kelas,
                    'kelas.status'     => '1']);
        $query = $builder->get();
        return $query->getRow();
    }
    
    // detail
    public function detail($has_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, kategori_kelas.kategori_kelas as kategori, berita.judul_berita, users.nama');
        $builder->join('kategori_kelas', 'kategori_kelas.id_kategori_kelas = kelas.kategori_kelas', 'LEFT');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->join('users', 'users.id_user = kelas.pic_kelas', 'LEFT');
        $builder->where('kelas.has_kelas', $has_kelas);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // home
    public function beranda()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['status_berita' => 'Publish',
            'jenis_berita'               => 'Berita', ]);
        $builder->orderBy('berita.tanggal_publish', 'DESC');
        $builder->limit(3);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // home
    public function sidebar()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['status_berita' => 'Publish',
            'jenis_berita'               => 'Berita', ]);
        $builder->orderBy('berita.tanggal_publish', 'DESC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // home
    public function home()
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['status_berita' => 'Publish',
            'jenis_berita'               => 'Berita', ]);
        $builder->orderBy('berita.tanggal_publish', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // kategori
    public function kategori($id_kategori)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['status_berita' => 'Publish',
            'jenis_berita'               => 'Berita',
            'berita.id_kategori'         => $id_kategori, ]);
        $builder->orderBy('berita.tanggal_publish', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // kategori
    public function kategori_all($id_kategori)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['berita.id_kategori' => $id_kategori]);
        $builder->orderBy('berita.tanggal_publish', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // total
    public function total_kategori($id_kategori)
    {
        $builder = $this->db->table('berita')->where('id_kategori', $id_kategori);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // author
    public function author_all($id_user)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['berita.id_user' => $id_user]);
        $builder->orderBy('berita.id_berita', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // total
    public function total_author($id_user)
    {
        $builder = $this->db->table('berita')->where('id_user', $id_user);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // kategori
    public function jenis_berita_all($jenis_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['berita.jenis_berita' => $jenis_berita]);
        $builder->orderBy('berita.id_berita', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // total
    public function total_jenis_berita($jenis_berita)
    {
        $builder = $this->db->table('berita')->where('jenis_berita', $jenis_berita);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // status_berita
    public function status_berita_all($status_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where(['berita.status_berita' => $status_berita]);
        $builder->orderBy('berita.id_berita', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // status_berita
    public function total_status_berita($status_berita)
    {
        $builder = $this->db->table('berita')->where('status_berita', $status_berita);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // total
    public function total()
    {
        $builder = $this->db->table('berita');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // read
    public function read($slug_berita)
    {
        $builder = $this->db->table('berita');
        $builder->select('berita.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
        $builder->join('users', 'users.id_user = berita.id_user', 'LEFT');
        $builder->where('berita.slug_berita', $slug_berita);
        $builder->where('berita.status_berita', 'Publish');
        $builder->orderBy('berita.id_berita', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('berita');
        $builder->insert($data);
    }
    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('kelas');
        $builder->where('has_kelas', $data['has_kelas']);
        $builder->update($data);
    }
}
