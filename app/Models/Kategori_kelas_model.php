<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori_kelas_model extends Model
{
    protected $table              = 'kategori_kelas';
    protected $primaryKey         = 'id_kategori_kelas';
    protected $returnType         = 'array';
    protected $useSoftDeletes     = false;
    protected $allowedFields      = [
                                    'id_kategori_kelas', 
                                    'nama_kategori_kelas', 
                                    'slug_kategori_kelas', 
                                    'urutan', 
                                    'hits',
                                    'created_by',
                                    'created_at',
                                    'updated_at',
                                    'deleted_at',
                                    'has_kategori_kelas'
                                ];
    protected $useTimestamps      = false;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    // Index
    public function index()
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->where('deleted_at', '0000-00-00 00:00:00');
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    // listing
    public function listing()
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->where('deleted_at', '0000-00-00 00:00:00');
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count
    public function count($nama_kategori_kelas)
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->select('COUNT(*) AS count');
        $builder->where('nama_kategori_kelas', $nama_kategori_kelas);
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    // detail
    public function detail($has_kategori_kelas)
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->where('has_kategori_kelas', $has_kategori_kelas);
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // detail
    public function by_id($id_kategori_kelas)
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->where('id_kategori_kelas', $id_kategori_kelas);
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // read
    public function read($slug_kategori_kelas)
    {
        $builder = $this->db->table('kategori_kelas');
        $builder->where('slug_kategori_kelas', $slug_kategori_kelas);
        $builder->orderBy('kategori_kelas.id_kategori_kelas', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    
}
