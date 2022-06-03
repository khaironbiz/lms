<?php

namespace App\Models;

use CodeIgniter\Model;

class Tugas_kelas_model extends Model
{
    
    protected $table                = 'tugas_kelas';
    protected $primaryKey           = 'id_tugas_kelas';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['id_kelas', 'id_tugas', 'id_metode'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing($order='tugas_kelas.id_tugas_kelas', $direction='DESC')
    {
        $builder = $this->db->table('tugas_kelas');
        $builder->select('tugas_kelas.*, users.nama, kelas.nama_kelas, tugas.nama_tugas, tugas_metode.nama_metode');
        $builder->join('users', 'users.id_user = tugas_kelas.created_by', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = tugas_kelas.id_kelas', 'LEFT');
        $builder->join('tugas', 'tugas.id_tugas = tugas_kelas.id_tugas', 'LEFT');
        $builder->join('tugas_metode', 'tugas_metode.id_tugas_metode = tugas_kelas.id_metode', 'LEFT');
        $builder->orderBy($order, $direction);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // read
    public function list_by_id_kelas($id_kelas)
    {
        $builder = $this->db->table('tugas_kelas');
        $builder->select('tugas_kelas.*, users.nama, kelas.nama_kelas, tugas.nama_tugas');
        $builder->join('users', 'users.id_user = tugas_kelas.created_by', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = tugas_kelas.id_kelas', 'LEFT');
        $builder->join('tugas', 'tugas.id_tugas = tugas_kelas.id_tugas', 'LEFT');
        $builder->where('tugas_kelas.id_kelas', $id_kelas);
        $query = $builder->get();
        return $query->getResultArray();
    }
    // detail
    public function detail($has_tugas_kelas)
    {
        $builder = $this->db->table('tugas_kelas');
        $builder->select('tugas_kelas.*, users.nama, kelas.nama_kelas, tugas.nama_tugas, tugas_metode.nama_metode');
        $builder->join('users', 'users.id_user = tugas_kelas.created_by', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = tugas_kelas.id_kelas', 'LEFT');
        $builder->join('tugas', 'tugas.id_tugas = tugas_kelas.id_tugas', 'LEFT');
        $builder->join('tugas_metode', 'tugas_metode.id_tugas_metode = tugas_kelas.id_metode', 'LEFT');
        $builder->where('tugas_kelas.has_tugas_kelas', $has_tugas_kelas);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function detail_id_kelas($id_kelas)
    {
        $builder = $this->db->table('tugas_kelas');
        $builder->select('tugas_kelas.*, users.nama, kelas.nama_kelas, tugas.nama_tugas, tugas_metode.nama_metode');
        $builder->join('users', 'users.id_user = tugas_kelas.created_by', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = tugas_kelas.id_kelas', 'LEFT');
        $builder->join('tugas', 'tugas.id_tugas = tugas_kelas.id_tugas', 'LEFT');
        $builder->join('tugas_metode', 'tugas_metode.id_tugas_metode = tugas_kelas.id_metode', 'LEFT');
        $builder->where('tugas_kelas.id_kelas', $id_kelas);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // count
    public function count_id_kelas($id_kelas)
    {
        $builder = $this->db->table('tugas_kelas')->where('id_kelas', $id_kelas);
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
        $builder = $this->db->table('tugas_kelas');
        $builder->insert($data);
    }
    // edit
    public function edit($data)
    {
        $builder = $this->db->table('tugas_kelas');
        $builder->where('has_tugas_kelas', $data['has_tugas_kelas']);
        $builder->update($data);
    }
}
