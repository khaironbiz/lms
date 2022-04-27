<?php

namespace App\Models;

use CodeIgniter\Model;

class Materi_model extends Model
{
    protected $table         = 'materi';
    protected $primaryKey    = 'id_materi';
    protected $allowedFields = [
                                'id_event',
                                'id_kelas',
                                'materi',
                                'pemateri',
                                'waktu_mulai',
                                'waktu_selesai',
                                'created_by',
                                'created_at',
                                'updated_at',
                                'deleted_at',
                                'blokir',
                                'has_materi',
                            ];

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
    public function kelas($id_kelas)
    {
        $builder = $this->db->table('materi');
        $builder->select('materi.*, users.nama');
        $builder->join('users', 'users.id_user = materi.pemateri', 'LEFT');
        $builder->where(['materi.id_kelas'  => $id_kelas]);
        $builder->orderBy('materi.waktu_mulai', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function has_materi($has_materi)
    {
        $builder = $this->db->table('materi');
        $builder->select('materi.*, users.nama, berita.judul_berita');
        $builder->join('users', 'users.id_user = materi.pemateri', 'LEFT');
        $builder->join('berita', 'berita.id_berita = materi.id_event', 'LEFT');
        $builder->where(['materi.has_materi'  => $has_materi]);
        $query = $builder->get();
        return $query->getRowArray();
    }
    //materi pada kelas
    
    public function by_id_materi($id_materi)
    {
        $builder = $this->db->table('materi');
        $builder->select('materi.*, users.nama, berita.judul_berita');
        $builder->join('users', 'users.id_user = materi.pemateri', 'LEFT');
        $builder->join('berita', 'berita.id_berita = materi.id_event', 'LEFT');
        $builder->where(['materi.id_materi'  => $id_materi]);
        $query = $builder->get();
        return $query->getRowArray();
    }
    //materi pada kelas
    public function event($id_event)
    {
        $builder = $this->db->table('materi');
        $builder->select('materi.*, users.nama, kelas.nama_kelas');
        $builder->join('users', 'users.id_user = materi.pemateri', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = materi.id_kelas', 'LEFT');
        $builder->where(['materi.id_event'  => $id_event]);
        $builder->orderBy('materi.id_event', 'ASC');
        $builder->orderBy('materi.waktu_mulai', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // total
    public function count_id_kelas($id_kelas)
    {
        $builder = $this->db->table('materi')->where('id_kelas', $id_kelas);
        $query   = $builder->get();
        return $query->getNumRows();
    }
}
