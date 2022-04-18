<?php

namespace App\Models;

use CodeIgniter\Model;

class Organisasi_profesi_model extends Model
{
    
    protected $table                = 'organisasi_profesi';
    protected $primaryKey           = 'id_op';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'nama_op',
                                        'singkatan_op',
                                        'id_profesi',
                                        'pimpinan_op',
                                        'alamat_op',
                                        'email_op',
                                        'hp_op',
                                        'web_op',
                                        'created_by',
                                        'created_at',
                                        'updated_at', 
                                        'has_op',
                                    ];
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
        $builder = $this->db->table('organisasi_profesi');
        $builder->select('organisasi_profesi.*, profesi.nama_profesi');
        $builder->join('profesi', 'profesi.id_profesi = organisasi_profesi.id_profesi', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function by_id_pofesi($id_profesi)
    {
        $builder = $this->db->table('organisasi_profesi');
        $builder->select('organisasi_profesi.*, profesi.nama_profesi');
        $builder->join('profesi', 'profesi.id_profesi = organisasi_profesi.id_profesi', 'LEFT');
        $builder->where('id_profesi', $id_profesi);
        $query = $builder->get();
        return $query->getRow();
    }
    //detail
    public function by_has_op($has_op)
    {
        $builder = $this->db->table('organisasi_profesi');
        $builder->select('organisasi_profesi.*, profesi.nama_profesi');
        $builder->join('profesi', 'profesi.id_profesi = organisasi_profesi.id_profesi', 'LEFT');
        $builder->where('has_op', $has_op);
        $query = $builder->get();
        return $query->getRow();
    }
    
    public function has_op($has_op)
    {
        $builder = $this->db->table('organisasi_profesi');
        $builder->select('organisasi_profesi.*');
        $builder->where('has_op', $has_op);
        $query = $builder->get();
        return $query->getRow();
    }
    // count
    public function count($nama_op)
    {
        $builder = $this->db->table('organisasi_profesi')->where('nama_op', $nama_op);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    //count by id profesi
    public function count_by_id_profesi($id_profesi)
    {
        $builder = $this->db->table('organisasi_profesi')->where('id_profesi', $id_profesi);
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
        $builder = $this->db->table('organisasi_profesi');
        $builder->insert($data);
    }
    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('organisasi_profesi');
        $builder->where('has_op', $data['has_op']);
        $builder->update($data);
    }

}
