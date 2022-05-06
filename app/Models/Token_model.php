<?php

namespace App\Models;

use CodeIgniter\Model;

class Token_model extends Model
{
    
    protected $table                = 'token';
    protected $primaryKey           = 'id_token';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'jenis_token',
                                        'token',
                                        'created_by',
                                        'created_at',
                                        'exp_date',
                                        'read_at'
                                    ];
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
        return $query->getRowArray();
    }
    // read
    public function reset($token)
    {
        $builder = $this->db->table('token');
        $builder->select('token.*, users.nama');
        $builder->join('users', 'users.id_user = token.created_by', 'LEFT');
        $builder->where('token.token', $token);
        $builder->orderBy('token.id_token', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count token
    public function count_token($token)
    {
        $builder = $this->db->table('token')->where('token', $token)->where('read_at', 0);
        $query   = $builder->get();
        return $query->getNumRows();
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
