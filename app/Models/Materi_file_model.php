<?php

namespace App\Models;

use CodeIgniter\Model;

class Materi_file_model extends Model
{
    protected $table         = 'materi_file';
    protected $primaryKey    = 'id_materi_file';
    protected $allowedFields = [
                                'id_event',
                                'id_kelas',
                                'id_materi',
                                'id_file',
                                'created_by',
                                'created_at',
                                'updated_at',
                                'has_materi_file',
                            ];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('materi_file');
        $builder->select('materi_file.*, materi.materi');
        $builder->join('materi', 'materi.id_materi = materi_file.id_materi', 'LEFT');
        $builder->orderBy('materi_file.id_materi_file', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // file
    public function file()
    {
        $builder = $this->db->table('materi_file');
        $builder->select('materi_file.*, materi.materi, files.judul_file');
        $builder->join('materi', 'materi.id_materi = materi_file.id_materi', 'LEFT');
        $builder->join('files', 'files.id_file = materi_file.id_file', 'LEFT');
        $builder->where(['materi_file.id_vidio'  => '0']);
        $builder->orderBy('materi_file.id_materi_file', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing by id materi
    public function list_by_id_materi($id_materi)
    {
        $builder = $this->db->table('materi_file');
        $builder->select('materi_file.*, materi.materi, files.judul_file, files.nama_file, files.hit_file');
        $builder->join('materi', 'materi.id_materi = materi_file.id_materi', 'LEFT');
        $builder->join('files', 'files.id_file = materi_file.id_file', 'LEFT');
        $builder->where(['materi_file.id_materi'  => $id_materi]);
        $builder->orderBy('materi_file.id_materi_file', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing by id kelas
    public function list_by_id_kelas($id_kelas)
    {
        $builder = $this->db->table('materi_file');
        $builder->select('materi_file.*, materi.materi');
        $builder->join('materi', 'materi.id_materi = materi_file.id_materi', 'LEFT');
        $builder->where(['materi_file.id_kelas'  => $id_kelas]);
        $builder->orderBy('materi_file.id_materi_file', 'DESC');
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
        $builder->select('materi.*, users.nama');
        $builder->join('users', 'users.id_user = materi.pemateri', 'LEFT');
        $builder->where(['materi.has_materi'  => $has_materi]);
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
}
