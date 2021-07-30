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
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('perusahaan/perusahaan_list', $data);
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
            $this->load->view('perusahaan/perusahaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('perusahaan/create_action'),
	    'id' => set_value('id'),
	    'nama_perusahaan' => set_value('nama_perusahaan'),
	    'alamat_kantor' => set_value('alamat_kantor'),
	    'alamat_plant' => set_value('alamat_plant'),
	);
        $this->load->view('perusahaan/perusahaan_form', $data);
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
            $this->load->view('perusahaan/perusahaan_form', $data);
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

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "perusahaan.xls";
        $judul = "perusahaan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Kantor");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Plant");

	foreach ($this->Perusahaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_kantor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_plant);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=perusahaan.doc");

        $data = array(
            'perusahaan_data' => $this->Perusahaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('perusahaan/perusahaan_doc',$data);
    }

}

/* End of file Perusahaan.php */
/* Location: ./application/controllers/Perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 12:55:14 */
/* http://harviacode.com */
