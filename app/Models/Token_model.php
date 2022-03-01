<?php

namespace App\Models;

use CodeIgniter\Model;

class Token_model extends Model
{
    
    protected $table                = 'token';
    protected $primaryKey           = 'id_token';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['jenis_token','token','created_by','created_at','exp_date'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function detail($token)
    {
        $builder = $this->db->table('token');
        $builder->select('token.*, users.nama');
        $builder->where('token', $token);
        $builder->join('users', 'users.id_user = token.created_by', 'LEFT');
        $builder->orderBy('token.id_token', 'DESC');
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
    // count
    public function count($id_user)
    {
        $builder = $this->db->table('token');
        $builder->where([
            'created_by'    => $id_user,
            'read_at'       => '0', ]);
        $builder->select('COUNT(*) AS total');
        $query   = $builder->get();
        return $query->getNumRows();
    }


}
