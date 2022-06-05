<?php

namespace App\Models;

use CodeIgniter\Model;

class Akses_model extends Model
{
    
    protected $table                = 'akses';
    protected $primaryKey           = 'id_akses';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_akses','created_by','created_at','updated_at', 'has_akses'];
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
        $builder = $this->db->table('akses');
        $builder->select('akses.*');
        $builder->orderBy('akses.id_akses', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function detail($has_akses)
    {
        $builder = $this->db->table('akses');
        $builder->select('akses.*');
        $builder->where('has_akses', $has_akses);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // count
    public function count($id_akses)
    {
        $builder = $this->db->table('akses')->where('id_akses', $id_akses);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // total
    public function total()
    {
        $builder = $this->db->table('akses');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('akses');
        $builder->insert($data);
    }

}
