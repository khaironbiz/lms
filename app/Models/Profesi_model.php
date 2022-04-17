<?php

namespace App\Models;

use CodeIgniter\Model;

class Profesi_model extends Model
{
    
    protected $table                = 'profesi';
    protected $primaryKey           = 'id_profesi';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_profesi','created_by','created_at','updated_at', 'has_profesi'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing()
    {
        $builder = $this->db->table('profesi');
        $builder->select('profesi.*');
        $builder->orderBy('profesi.id_profesi', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function ly($short)
    {
        $builder = $this->db->table('url');
        $builder->select('url.*');
        $builder->where('short', $short);
        $builder->orderBy('id_url', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    //detail
    public function has_profesi($has_profesi)
    {
        $builder = $this->db->table('profesi');
        $builder->select('profesi.*');
        $builder->where('has_profesi', $has_profesi);
        $query = $builder->get();
        return $query->getRow();
    }
    // count
    public function count($nama_profesi)
    {
        $builder = $this->db->table('profesi')->where('nama_profesi', $nama_profesi);
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
        $builder = $this->db->table('url');
        $builder->insert($data);
    }
    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('profesi');
        $builder->where('has_profesi', $data['has_profesi']);
        $builder->update($data);
    }

}
