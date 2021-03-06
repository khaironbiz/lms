<?php

namespace App\Models;

use CodeIgniter\Model;

class Registrasi_model extends Model
{
    
    protected $table                = 'registrasi';
    protected $primaryKey           = 'id_registrasi';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
        'nama','nik','jenis_kelamin','tanggal_lahir','nira','dpw','email','hp','password','created_at','updated_at','has_registrasi','level_akses'
    ];
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing()
    {
        $builder = $this->db->table('registrasi');
        $builder->select('registrasi.*, prov.nama_prov');
        $builder->join('prov', 'prov.id_prov = registrasi.dpw', 'LEFT');
        $builder->orderBy('registrasi.id_registrasi', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // Listing
    public function ready()
    {
        $builder = $this->db->table('registrasi');
        $builder->where('registrasi.password !=', '');
        $builder->orderBy('registrasi.id_registrasi', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function has_registrasi($has_registrasi){
        $builder = $this->db->table('registrasi');
        $builder->select('registrasi.*, prov.nama_prov');
        $builder->join('prov', 'prov.id_prov = registrasi.dpw', 'LEFT');
        $builder->where('registrasi.has_registrasi', $has_registrasi);
        $query = $builder->get();
        return $query->getRowArray();
    }
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
    //count has registrasi
    public function count_has_registrasi($has_registrasi)
    {
        $builder = $this->db->table('registrasi')->where('has_registrasi', $has_registrasi);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // count token
    public function count_token($token)
    {
        $builder = $this->db->table('token');
        $builder->select('COUNT(*) AS count');
        $builder->where([
            'token'    => $token,
            'read_at'  => '0', ]);
        $builder->orderBy('token.id_token', 'DESC');
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
