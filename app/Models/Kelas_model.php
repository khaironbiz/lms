<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelas_model extends Model
{
    protected $table         = 'kelas';
    protected $primaryKey    = 'id_kelas';
    protected $allowedFields = [
                                'pic_kelas',
                                'id_event',
                                'nama_kelas',
                                'kategori_kelas',
                                'tanggal_mulai',
                                'tanggal_selesai',
                                'kuota',
                                'status',
                                'poster',
                                'harga_dasar',
                                'harga_jual', 
                                'has_kelas',];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, berita.judul_berita, users.nama');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->join('users', 'users.id_user = kelas.pic_kelas', 'LEFT');
        $builder->orderBy('kelas.id_event', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    //soon
    public function soon()
    {
        $date_now = date('Y-m-d');
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, berita.judul_berita, users.nama');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->join('users', 'users.id_user = kelas.pic_kelas', 'LEFT');
        $builder->orderBy('kelas.id_event', 'DESC');
        $builder->where('tanggal_selesai >=', $date_now);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    // Event
    public function event($id_event)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, berita.judul_berita');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->where([
                    'kelas.id_event'  => $id_event,
                    'kelas.status'    => '1']);
        $builder->orderBy('kelas.id_kelas', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // kelas by has
    public function by_has_kelas($has_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, kategori_kelas.nama_kategori_kelas, berita.id_berita, berita.id_client, client.nama as nama_client');
        $builder->join('kategori_kelas', 'kategori_kelas.id_kategori_kelas=kelas.kategori_kelas');
        $builder->join('berita', 'berita.id_berita=kelas.id_event');
        $builder->join('client', 'client.id_client=berita.id_client');
        $builder->where([
                    'kelas.has_kelas'   => $has_kelas,
                    'kelas.status'      => '1']);
        $query = $builder->get();
        return $query->getRow();
    }
    // kelas by id_kelas
    public function by_id_kelas($id_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*');
        $builder->select('kelas.*, kategori_kelas.nama_kategori_kelas, berita.id_berita, berita.id_client, client.nama as nama_client');
        $builder->join('kategori_kelas', 'kategori_kelas.id_kategori_kelas=kelas.kategori_kelas');
        $builder->join('berita', 'berita.id_berita=kelas.id_event');
        $builder->join('client', 'client.id_client=berita.id_client');
        $builder->where([
                    'kelas.id_kelas'   => $id_kelas,
                    'kelas.status'     => '1']);
        $query = $builder->get();
        return $query->getRow();
    }
    
    // detail
    public function detail($has_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.*, kategori_kelas.nama_kategori_kelas as kategori, berita.judul_berita, users.nama');
        $builder->join('kategori_kelas', 'kategori_kelas.id_kategori_kelas = kelas.kategori_kelas', 'LEFT');
        $builder->join('berita', 'berita.id_berita = kelas.id_event', 'LEFT');
        $builder->join('users', 'users.id_user = kelas.pic_kelas', 'LEFT');
        $builder->where('kelas.has_kelas', $has_kelas);
        $query = $builder->get();
        return $query->getRowArray();
    }


    // status_berita
    public function total_status_berita($status_berita)
    {
        $builder = $this->db->table('berita')->where('status_berita', $status_berita);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // total
    public function total()
    {
        $builder = $this->db->table('berita');
        $query   = $builder->get();
        return $query->getNumRows();
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('kelas');
        $builder->where('has_kelas', $data['has_kelas']);
        $builder->update($data);
    }
}
