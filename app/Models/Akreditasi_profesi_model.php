<?php

namespace App\Models;

use CodeIgniter\Model;

class Akreditasi_profesi_model extends Model
{
    
    protected $table                = 'akreditasi_profesi';
    protected $primaryKey           = 'id_akreditasi_profesi';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'id_op',
                                        'level_op',
                                        'id_kelas',
                                        'nominal_skp',
                                        'nomor_skp',
                                        'tanggal_skp',
                                        'keterangan',
                                        'created_by',
                                        'created_at',
                                        'updated_at', 
                                        'has_akreditasi_profesi',
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
        $builder = $this->db->table('akreditasi_profesi');
        $builder->select('akreditasi_profesi.*, organisasi_profesi.nama_op');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = akreditasi_profesi.id_op', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function by_has_akreditasi_profesi($has_akreditasi_profesi)
    {
        $builder = $this->db->table('akreditasi_profesi');
        $builder->select('akreditasi_profesi.*, organisasi_profesi.nama_op, organisasi_profesi.singkatan_op');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = akreditasi_profesi.id_op', 'LEFT');
        $builder->where('has_akreditasi_profesi', $has_akreditasi_profesi);
        $query = $builder->get();
        return $query->getRow();
    }
    // read
    public function by_id_kelas($id_kelas)
    {
        $builder = $this->db->table('akreditasi_profesi');
        $builder->select('akreditasi_profesi.*, organisasi_profesi.nama_op, organisasi_profesi.singkatan_op');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = akreditasi_profesi.id_op', 'LEFT');
        $builder->where('id_kelas', $id_kelas);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    // count
    public function count_id_op($id_op)
    {
        $builder = $this->db->table('akreditasi_profesi')->where('id_op', $id_op);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    //count by id profesi
    public function count_id_kelas($id_kelas)
    {
        $builder = $this->db->table('akreditasi_profesi')->where('id_kelas', $id_kelas);
        $query   = $builder->get();
        return $query->getNumRows();
    }

    
    //duplikasi_skp
    public function duplikasi_skp($id_kelas,$id_op)
    {
        $builder = $this->db->table('akreditasi_profesi');
        $builder -> where('id_kelas', $id_kelas);
        $builder -> where('id_op', $id_op);
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
        $builder = $this->db->table('akreditasi_profesi');
        $builder->insert($data);
    }
    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('akreditasi_profesi');
        $builder->where('has_akreditasi_profesi', $data['has_akreditasi_profesi']);
        $builder->update($data);
    }

}
