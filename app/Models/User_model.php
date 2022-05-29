<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table              = 'users';
    protected $primaryKey         = 'id_user';
    protected $returnType         = 'array';
    protected $useSoftDeletes     = false;
    protected $allowedFields      = [
                                    'id_user',
                                    'nik',
                                    'nama',
                                    'gelar_depan',
                                    'gelar_belakang',
                                    'email', 
                                    'username', 
                                    'password', 
                                    'akses_level', 
                                    'kode_rahasia', 
                                    'gambar', 
                                    'keterangan', 
                                    'tanggal_post',
                                    'status',
                                    'has_user'
                                    ];
    protected $useTimestamps      = false;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    // login
    public function login($username, $password)
    {
        return $this->asArray()
            ->where([
                'email'     => $username,
                'password'  => sha1($password), 
                ])
            ->first();
    }
    //ambil password
    public function reset_password($email)
    {
        return $this->asArray()
            ->where(['email' => $email, ])
            ->first();
    }
    
    // count email
    public function count_email($email)
    {
        $builder = $this->db->table('users');
        $builder->where('email', $email);
        $builder->select('COUNT(*) AS count');
        $builder->orderBy('users.id_user', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // listing
    public function listing()
    {
        $builder = $this->db->table('users');
        $builder->orderBy('id_user', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    
    // total
    public function total()
    {
        $builder = $this->db->table('users');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('users.id_user', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // detail
    public function by_id($id_user)
    {
        $builder = $this->db->table('users');
        $builder->where('id_user', $id_user);
        $query = $builder->get();
        return $query->getRow();
    }
    // detail
    public function has_user($has_user)
    {
        $builder = $this->db->table('users');
        $builder->where('has_user', $has_user);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // detail
    public function detail($id_user)
    {
        $builder = $this->db->table('users');
        $builder->where('id_user', $id_user);
        $builder->orderBy('users.id_user', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // tambah  log
    public function user_log($data)
    {
        $builder = $this->db->table('user_logs');
        $builder->insert($data);
    }
}
