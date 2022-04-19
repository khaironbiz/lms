<?php

namespace App\Models;

use CodeIgniter\Model;

class Organisasi_profesi_provinsi_model extends Model
{
    
    protected $table                = 'op_provinsi';
    protected $primaryKey           = 'id_op_provinsi';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'id_op',
                                        'id_provinsi',
                                        'pimpinan_op_provinsi',
                                        'alamat_op_provinsi',
                                        'email_op_provinsi',
                                        'hp_op_provinsi',
                                        'web_op_provinsi',
                                        'created_by',
                                        'created_at',
                                        'updated_at', 
                                        'has_op_provinsi',
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
        $builder = $this->db->table('op_provinsi');
        $builder->select('op_provinsi.*, organisasi_profesi.nama_op, organisasi_profesi.id_profesi, prov.nama_prov');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = op_provinsi.id_op', 'LEFT');
        $builder->join('prov', 'prov.id_prov = op_provinsi.id_provinsi', 'LEFT');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function by_id_op($id_op)
    {
        $builder = $this->db->table('op_provinsi');
        $builder->select('op_provinsi.*');
        $builder->where('id_op', $id_op);
        $query = $builder->get();
        return $query->getRow();
    }
    //detail
    public function detail($has_op_provinsi)
    {
        $builder = $this->db->table('op_provinsi');
        $builder->select('op_provinsi.*, organisasi_profesi.nama_op, organisasi_profesi.id_profesi, prov.nama_prov');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = op_provinsi.id_op', 'LEFT');
        $builder->join('prov', 'prov.id_prov = op_provinsi.id_provinsi', 'LEFT');
        $builder->where('has_op_provinsi', $has_op_provinsi);
        $query = $builder->get();
        return $query->getRow();
    }
    //OP tiap provinsi
    public function provinsi($id_provinsi)
    {
        $builder = $this->db->table('op_provinsi');
        $builder->select('op_provinsi.*, organisasi_profesi.nama_op, organisasi_profesi.id_profesi');
        $builder->join('organisasi_profesi', 'organisasi_profesi.id_op = op_provinsi.id_op', 'LEFT');
        $builder->where('id_provinsi', $id_provinsi);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // count
    public function count_id_provinsi($id_provinsi)
    {
        $builder = $this->db->table('op_provinsi')->where('id_provinsi', $id_provinsi);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    //count by id profesi
    public function count_by_id_profesi($id_profesi)
    {
        $builder = $this->db->table('op_provinsi')->where('id_profesi', $id_profesi);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // total
    public function total()
    {
        $builder = $this->db->table('op_provinsi');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('op_provinsi');
        $builder->insert($data);
    }
    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('op_provinsi');
        $builder->where('has_op_provinsi', $data['has_op_provinsi']);
        $builder->update($data);
    }
}
