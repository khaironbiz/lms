<?php

namespace App\Models;

use CodeIgniter\Model;

class File_hitter_model extends Model
{
    protected $table         = 'file_hitter';
    protected $primaryKey    = 'id_file_hitter';
    protected $allowedFields = ['id_file', 'created_at', 'created_by', 'ip'];
    // Listing
    public function listing()
    {
        $builder = $this->db->table('file_hitter');
        $builder->select('file_hitter.*');
        $builder->orderBy('file_hitter.id_file_hitter', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function list_id_user($id_user)
    {
        $builder = $this->db->table('file_hitter');
        $builder->select('file_hitter.*');
        $builder->where(['file_hitter.created_by'  => $id_user]);
        $builder->orderBy('file_hitter.id_file_hitter', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('files');
        $builder->insert($data);
    }
}
