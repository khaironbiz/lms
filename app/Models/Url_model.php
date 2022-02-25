<?php

namespace App\Models;

use CodeIgniter\Model;

class Url_model extends Model
{
    protected $table         = 'url';
    protected $primaryKey    = 'id_url';
    protected $allowedFields = [];

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
    // total
    public function count($short)
    {
        $builder = $this->db->table('url')->where('short', $short);
        $query   = $builder->get();
        return $query->getNumRows();
    }
}
