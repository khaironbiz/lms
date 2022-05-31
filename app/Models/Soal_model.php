<?php

namespace App\Models;

use CodeIgniter\Model;

class Soal_model extends Model
{
    
    protected $table                = 'soal';
    protected $primaryKey           = 'id_soal';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['soal','id_jawaban','jawaban','created_by','created_at','updated_at', 'has_soal'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing($id_user)
    {
        $builder = $this->db->table('url');
        $builder->select('url.*, users.nama');
        $builder->where('created_by', $id_user);
        $builder->join('users', 'users.id_user = url.created_by', 'LEFT');
        $builder->orderBy('url.id_url', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing
    public function list_id_tugas_kelas($id_tugas_kelas)
    {
        $builder = $this->db->table('soal');
        $builder->select('soal.*, users.nama, kelas.nama_kelas, tugas_kelas.time_start, tugas_kelas.time_finish');
        $builder->join('users', 'users.id_user = soal.created_by', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = soal.id_kelas', 'LEFT');
        $builder->join('tugas_kelas', 'tugas_kelas.id_tugas_kelas = soal.id_tugas_kelas', 'LEFT');
        $builder->where('soal.id_tugas_kelas', $id_tugas_kelas);
        $builder->orderBy('soal.id_soal', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function detail($has_soal)
    {
        $builder = $this->db->table('soal');
        $builder->select('soal.*');
        $builder->where('has_soal', $has_soal);
        $query = $builder->get();
        return $query->getRowArray();
    }
    //detail
    public function has_url($has_url)
    {
        $builder = $this->db->table('url');
        $builder->select('*');
        $builder->where('has_url', $has_url);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count
    public function count($short)
    {
        $builder = $this->db->table('url')->where('short', $short);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // total
    public function total()
    {
        $builder = $this->db->table('url');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('soal');
        $builder->insert($data);
    }

}
