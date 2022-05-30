<?php

namespace App\Models;

use CodeIgniter\Model;

class Tugas_model extends Model
{
    
    protected $table                = 'tugas';
    protected $primaryKey           = 'id_tugas';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_tugas','created_by','created_at','updated_at', 'has_tugas'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing($order='tugas.id_tugas', $direction='DESC')
    {
        $builder = $this->db->table('tugas');
        $builder->select('tugas.*');
        $builder->orderBy($order, $direction);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function has_tugas($has_tugas)
    {
        $builder = $this->db->table('tugas');
        $builder->select('tugas.*');
        $builder->where('has_tugas', $has_tugas);
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
        $builder = $this->db->table('tugas');
        $builder->insert($data);
    }
    // edit
    public function edit($data)
    {
        $builder = $this->db->table('tugas');
        $builder->where('has_tugas', $data['has_tugas']);
        $builder->update($data);
    }
}
