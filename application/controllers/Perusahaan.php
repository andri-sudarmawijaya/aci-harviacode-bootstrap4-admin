<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Perusahaan';

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('perusahaan/perusahaan_list', $data);
        //$this->load->view('_layout/footer');

    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Perusahaan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		      'id' => $row->id,
		      'nama_perusahaan' => $row->nama_perusahaan,
		      'alamat_kantor' => $row->alamat_kantor,
		      'alamat_plant' => $row->alamat_plant,
	        );

            $data['title'] = 'Data Perusahaan - ' . $data['nama_perusahaan'];

            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar', $data);
            $this->load->view('_layout/topbar', $data);
            $this->load->view('perusahaan/perusahaan_read', $data);
            $this->load->view('_layout/footer', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('perusahaan/create_action'),
	        'id' => set_value('id'),
	        'nama_perusahaan' => set_value('nama_perusahaan'),
	        'alamat_kantor' => set_value('alamat_kantor'),
	        'alamat_plant' => set_value('alamat_plant'),
	    );
        $data['title'] = 'Buat Perusahaan';

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('perusahaan/perusahaan_form', $data);
        $this->load->view('_layout/footer', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		        'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		        'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		        'alamat_plant' => $this->input->post('alamat_plant',TRUE),
	        );

            $this->Perusahaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('perusahaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('perusahaan/update_action'),
		        'id' => set_value('id', $row->id),
		            'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
		            'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
		            'alamat_plant' => set_value('alamat_plant', $row->alamat_plant),
	            );
            $data['title'] = 'Update Data Perusahaan - ' . $data['nama_perusahaan'];

            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar', $data);
            $this->load->view('_layout/topbar', $data);
            $this->load->view('perusahaan/perusahaan_form', $data);
            $this->load->view('_layout/footer', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		'alamat_plant' => $this->input->post('alamat_plant',TRUE),
	    );

            $this->Perusahaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('perusahaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $this->Perusahaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perusahaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim|required');
	$this->form_validation->set_rules('alamat_plant', 'alamat plant', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Perusahaan.php */
/* Location: ./application/controllers/Perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-29 06:04:00 */
/* http://harviacode.com */
