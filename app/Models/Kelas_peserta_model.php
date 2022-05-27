<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelas_peserta_model extends Model
{
    
    protected $table                = 'kelas_peserta';
    protected $primaryKey           = 'id_kelas_peserta';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'id_invoice',
                                        'id_user',
                                        'id_kelas',
                                        'id_event',
                                        'harga',
                                        'nama_sertifikat',
                                        'email_peserta',
                                        'hp_peserta',
                                        'status',
                                        'created_at',
                                        'updated_at', 
                                        'created_by',
                                        'has_kelas_peserta'];
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
        $builder = $this->db->table('kelas_peserta');
        $builder->select('kelas_peserta.*, users.nama, kelas.nama_kelas');
        $builder->join('users', 'users.id_user = kelas_peserta.id_user', 'LEFT');
        $builder->join('kelas', 'kelas.id_kelas = kelas_peserta.id_kelas', 'LEFT');
        $builder->orderBy('kelas_peserta.id_kelas_peserta', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing by id kelas
    public function list_by_id_kelas($id_kelas, $order='kelas_peserta.id_kelas_peserta', $direction='DESC')
    {
        $builder = $this->db->table('kelas_peserta');
        $builder->select('kelas_peserta.*, kelas.nama_kelas');
        $builder->join('kelas', 'kelas.id_kelas = kelas_peserta.id_kelas', 'LEFT');
        $builder->where('kelas_peserta.id_kelas', $id_kelas);
        $builder->orderBy($order, $direction);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    // Listing by id user
    public function list_by_id_user($id_user)
    {
        $builder = $this->db->table('kelas_peserta');
        $builder->select('kelas_peserta.*, kelas.nama_kelas,kelas.tanggal_mulai,kelas.tanggal_selesai,kelas.has_kelas, kelas.poster');
        $builder->join('kelas', 'kelas.id_kelas = kelas_peserta.id_kelas', 'LEFT');
        $builder->where('kelas_peserta.id_user', $id_user);
        $builder->orderBy('kelas_peserta.id_kelas_peserta');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing by id user soon
    public function list_by_id_user_soon($id_user)
    {
        $now = date('Y:m-d');
        $builder = $this->db->table('kelas_peserta');
        $builder->select('kelas_peserta.*, kelas.nama_kelas,kelas.tanggal_mulai,kelas.tanggal_selesai,kelas.has_kelas, kelas.poster');
        $builder->join('kelas', 'kelas.id_kelas = kelas_peserta.id_kelas', 'LEFT');
        $builder->where('kelas_peserta.id_user', $id_user);
        $builder->where('kelas.tanggal_selesai >', $now);
        $builder->orderBy('kelas_peserta.id_kelas_peserta', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function kelas_user($id_user)
    {
        $builder = $this->db->table('kelas_peserta');
        $builder->select('kelas_peserta.*, user.nama, kelas.nama_kelas, berita.judul_berita');
        $builder->join('kelas', 'kelas.id_kelas = kelas_peserta.id_kelas', 'LEFT');
        $builder->join('users', 'users.id_user = kelas_peserta.id_user', 'LEFT');
        $builder->join('berita', 'berita.id_berita = kelas_peserta.id_event', 'LEFT');
        $builder->where('kelas_peserta.id_user', $id_user);
        $query = $builder->get();
        return $query->getRowArray();
    }
    //detail
    public function by_has_kelas_peserta($has_kelas_peserta)
    {
        $builder = $this->db->table('kelas_peserta');
        $builder->select('*');
        $builder->where('has_url', $has_url);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count
    public function count_id_kelas($id_kelas)
    {
        $builder = $this->db->table('kelas_peserta')->where('id_kelas', $id_kelas);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // total
    public function total()
    {
        $builder = $this->db->table('kelas_peserta');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('kelas_peserta');
        $builder->insert($data);
    }

}
