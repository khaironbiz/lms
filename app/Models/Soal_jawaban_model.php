<?php

namespace App\Models;

use CodeIgniter\Model;

class Soal_jawaban_model extends Model
{
    
    protected $table                = 'soal_jawaban';
    protected $primaryKey           = 'id_soal_jawaban';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['id_soal','jawaban','created_by','created_at','updated_at', 'has_soal_jawaban'];
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
    public function list_id_soal($id_soal)
    {
        $builder = $this->db->table('soal_jawaban');
        $builder->select('soal_jawaban.*');
        $builder->where('soal_jawaban.id_soal', $id_soal);
        $builder->orderBy('soal_jawaban.id_soal_jawaban', 'RANDOM');
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
    public function count_id_soal($id_soal)
    {
        $builder = $this->db->table('soal_jawaban')->where('id_soal', $id_soal);
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
        $builder = $this->db->table('soal_jawaban');
        $builder->insert($data);
    }

}
