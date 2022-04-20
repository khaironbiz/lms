<?php

namespace App\Models;

use CodeIgniter\Model;

class File_model extends Model
{
    protected $table         = 'files';
    protected $primaryKey    = 'id_file';
    protected $allowedFields = [
                                'nama_file',
                                'lokasi_file',
                                'created_at',
                                'updated_at',
                                'deleted_at',
                                'created_by',
                                'hit_file',
                                'has_file',
                            ];
    // Listing
    public function listing()
    {
        $builder = $this->db->table('files');
        $builder->select('files.*');
        $builder->orderBy('files.id_file', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // has 
    public function has_file($has_file)
    {
        $builder = $this->db->table('files');
        $builder->select('files.*');
        $builder->where(['files.has_file'  => $has_file]);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // edit
    public function edit($data)
    {
        $builder = $this->db->table('files');
        $builder->where('id_file', $data['id_file']);
        $builder->update($data);
    }
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('files');
        $builder->insert($data);
    }
}
