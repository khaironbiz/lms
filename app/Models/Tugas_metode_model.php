<?php

namespace App\Models;

use CodeIgniter\Model;

class Tugas_metode_model extends Model
{
    
    protected $table                = 'tugas_metode';
    protected $primaryKey           = 'id_tugas_metode';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_metode','created_by','created_at','updated_at', 'has_tugas_metode'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing($order='tugas_metode.id_tugas_metode', $direction='DESC')
    {
        $builder = $this->db->table('tugas_metode');
        $builder->select('tugas_metode.*');
        $builder->orderBy($order, $direction);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function detail($has_tugas_metode)
    {
        $builder = $this->db->table('tugas_metode');
        $builder->select('tugas_metode.*');
        $builder->where('has_tugas_metode', $has_tugas_metode);
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
        $builder = $this->db->table('tugas_metode');
        $builder->insert($data);
    }
    // edit
    public function edit($data)
    {
        $builder = $this->db->table('tugas_metode');
        $builder->where('has_tugas_metode', $data['has_tugas_metode']);
        $builder->update($data);
    }
}
