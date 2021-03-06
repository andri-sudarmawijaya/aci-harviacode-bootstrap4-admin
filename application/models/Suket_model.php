<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suket_model extends CI_Model
{

    public $table = 'suket';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,no,suket_bapr_no,nomor_laporan,nomor_sertifikat,tanggal_penerbitan,nomor_suket,kelompok_uji,template,jenis_pesawat,nama_alat,nama_alat_awal,suket_jenis_pemeriksaan,suket_nama_perusahaan,nama_perusahaan_awal,qty,pabrik_pembuat,tempat_pembuatan,tahun_pembuatan,memenuhi_syarat_k3,tanggal_suket,suket_riksa_kembali,suket_riksa_kembali_tahun,suket_riksa_kembali_bulan,keterangan');
        $this->datatables->from('suket');
        //add this line for join
        //$this->datatables->join('table2', 'suket.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('suket/read/$1'),'Read')." | ".anchor(site_url('suket/update/$1'),'Update')." | ".anchor(site_url('suket/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('no', $q);
	$this->db->or_like('suket_bapr_no', $q);
	$this->db->or_like('nomor_laporan', $q);
	$this->db->or_like('nomor_sertifikat', $q);
	$this->db->or_like('tanggal_penerbitan', $q);
	$this->db->or_like('nomor_suket', $q);
	$this->db->or_like('kelompok_uji', $q);
	$this->db->or_like('template', $q);
	$this->db->or_like('jenis_pesawat', $q);
	$this->db->or_like('nama_alat', $q);
	$this->db->or_like('nama_alat_awal', $q);
	$this->db->or_like('suket_jenis_pemeriksaan', $q);
	$this->db->or_like('suket_nama_perusahaan', $q);
	$this->db->or_like('nama_perusahaan_awal', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('pabrik_pembuat', $q);
	$this->db->or_like('tempat_pembuatan', $q);
	$this->db->or_like('tahun_pembuatan', $q);
	$this->db->or_like('memenuhi_syarat_k3', $q);
	$this->db->or_like('tanggal_suket', $q);
	$this->db->or_like('suket_riksa_kembali', $q);
	$this->db->or_like('suket_riksa_kembali_tahun', $q);
	$this->db->or_like('suket_riksa_kembali_bulan', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('no', $q);
	$this->db->or_like('suket_bapr_no', $q);
	$this->db->or_like('nomor_laporan', $q);
	$this->db->or_like('nomor_sertifikat', $q);
	$this->db->or_like('tanggal_penerbitan', $q);
	$this->db->or_like('nomor_suket', $q);
	$this->db->or_like('kelompok_uji', $q);
	$this->db->or_like('template', $q);
	$this->db->or_like('jenis_pesawat', $q);
	$this->db->or_like('nama_alat', $q);
	$this->db->or_like('nama_alat_awal', $q);
	$this->db->or_like('suket_jenis_pemeriksaan', $q);
	$this->db->or_like('suket_nama_perusahaan', $q);
	$this->db->or_like('nama_perusahaan_awal', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('pabrik_pembuat', $q);
	$this->db->or_like('tempat_pembuatan', $q);
	$this->db->or_like('tahun_pembuatan', $q);
	$this->db->or_like('memenuhi_syarat_k3', $q);
	$this->db->or_like('tanggal_suket', $q);
	$this->db->or_like('suket_riksa_kembali', $q);
	$this->db->or_like('suket_riksa_kembali_tahun', $q);
	$this->db->or_like('suket_riksa_kembali_bulan', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Suket_model.php */
/* Location: ./application/models/Suket_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:00:23 */
/* http://harviacode.com */