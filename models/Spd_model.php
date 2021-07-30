<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spd_model extends CI_Model
{

    public $table = 'spd';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,spd_nomor_po,spd_no,spd_tanggal,spd_id_perusahaan,spd_nama_perusahaan,spd_hari_mulai,spd_tanggal_mulai,spd_hari_selesai,spd_tanggal_selesai,petugas1,petugas2,petugas3,petugas4,petugas5,alat1,jumlah1,alat2,jumlah2,alat3,jumlah3,alat4,jumlah4,alat5,jumlah5,alat6,jumlah6,alat7,jumlah7,alat8,jumlah8,alat9,jumlah9,alat10,jumlah10');
        $this->datatables->from('spd');
        //add this line for join
        //$this->datatables->join('table2', 'spd.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('spd/read/$1'),'Read')." | ".anchor(site_url('spd/update/$1'),'Update')." | ".anchor(site_url('spd/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
	$this->db->or_like('spd_nomor_po', $q);
	$this->db->or_like('spd_no', $q);
	$this->db->or_like('spd_tanggal', $q);
	$this->db->or_like('spd_id_perusahaan', $q);
	$this->db->or_like('spd_nama_perusahaan', $q);
	$this->db->or_like('spd_hari_mulai', $q);
	$this->db->or_like('spd_tanggal_mulai', $q);
	$this->db->or_like('spd_hari_selesai', $q);
	$this->db->or_like('spd_tanggal_selesai', $q);
	$this->db->or_like('petugas1', $q);
	$this->db->or_like('petugas2', $q);
	$this->db->or_like('petugas3', $q);
	$this->db->or_like('petugas4', $q);
	$this->db->or_like('petugas5', $q);
	$this->db->or_like('alat1', $q);
	$this->db->or_like('jumlah1', $q);
	$this->db->or_like('alat2', $q);
	$this->db->or_like('jumlah2', $q);
	$this->db->or_like('alat3', $q);
	$this->db->or_like('jumlah3', $q);
	$this->db->or_like('alat4', $q);
	$this->db->or_like('jumlah4', $q);
	$this->db->or_like('alat5', $q);
	$this->db->or_like('jumlah5', $q);
	$this->db->or_like('alat6', $q);
	$this->db->or_like('jumlah6', $q);
	$this->db->or_like('alat7', $q);
	$this->db->or_like('jumlah7', $q);
	$this->db->or_like('alat8', $q);
	$this->db->or_like('jumlah8', $q);
	$this->db->or_like('alat9', $q);
	$this->db->or_like('jumlah9', $q);
	$this->db->or_like('alat10', $q);
	$this->db->or_like('jumlah10', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('spd_nomor_po', $q);
	$this->db->or_like('spd_no', $q);
	$this->db->or_like('spd_tanggal', $q);
	$this->db->or_like('spd_id_perusahaan', $q);
	$this->db->or_like('spd_nama_perusahaan', $q);
	$this->db->or_like('spd_hari_mulai', $q);
	$this->db->or_like('spd_tanggal_mulai', $q);
	$this->db->or_like('spd_hari_selesai', $q);
	$this->db->or_like('spd_tanggal_selesai', $q);
	$this->db->or_like('petugas1', $q);
	$this->db->or_like('petugas2', $q);
	$this->db->or_like('petugas3', $q);
	$this->db->or_like('petugas4', $q);
	$this->db->or_like('petugas5', $q);
	$this->db->or_like('alat1', $q);
	$this->db->or_like('jumlah1', $q);
	$this->db->or_like('alat2', $q);
	$this->db->or_like('jumlah2', $q);
	$this->db->or_like('alat3', $q);
	$this->db->or_like('jumlah3', $q);
	$this->db->or_like('alat4', $q);
	$this->db->or_like('jumlah4', $q);
	$this->db->or_like('alat5', $q);
	$this->db->or_like('jumlah5', $q);
	$this->db->or_like('alat6', $q);
	$this->db->or_like('jumlah6', $q);
	$this->db->or_like('alat7', $q);
	$this->db->or_like('jumlah7', $q);
	$this->db->or_like('alat8', $q);
	$this->db->or_like('jumlah8', $q);
	$this->db->or_like('alat9', $q);
	$this->db->or_like('jumlah9', $q);
	$this->db->or_like('alat10', $q);
	$this->db->or_like('jumlah10', $q);
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

/* End of file Spd_model.php */
/* Location: ./application/models/Spd_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 12:55:02 */
/* http://harviacode.com */