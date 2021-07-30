<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Baprfoto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Baprfoto_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('baprfoto/baprfoto_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Baprfoto_model->json();
    }

    public function read($id) 
    {
        $row = $this->Baprfoto_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nomor_bapr' => $row->nomor_bapr,
		'pengujian' => $row->pengujian,
		'keterangan' => $row->keterangan,
		'path' => $row->path,
	    );
            $this->load->view('baprfoto/baprfoto_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('baprfoto'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('baprfoto/create_action'),
	    'id' => set_value('id'),
	    'nomor_bapr' => set_value('nomor_bapr'),
	    'pengujian' => set_value('pengujian'),
	    'keterangan' => set_value('keterangan'),
	    'path' => set_value('path'),
	);
        $this->load->view('baprfoto/baprfoto_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomor_bapr' => $this->input->post('nomor_bapr',TRUE),
		'pengujian' => $this->input->post('pengujian',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'path' => $this->input->post('path',TRUE),
	    );

            $this->Baprfoto_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('baprfoto'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Baprfoto_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('baprfoto/update_action'),
		'id' => set_value('id', $row->id),
		'nomor_bapr' => set_value('nomor_bapr', $row->nomor_bapr),
		'pengujian' => set_value('pengujian', $row->pengujian),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'path' => set_value('path', $row->path),
	    );
            $this->load->view('baprfoto/baprfoto_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('baprfoto'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nomor_bapr' => $this->input->post('nomor_bapr',TRUE),
		'pengujian' => $this->input->post('pengujian',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'path' => $this->input->post('path',TRUE),
	    );

            $this->Baprfoto_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('baprfoto'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Baprfoto_model->get_by_id($id);

        if ($row) {
            $this->Baprfoto_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('baprfoto'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('baprfoto'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomor_bapr', 'nomor bapr', 'trim|required');
	$this->form_validation->set_rules('pengujian', 'pengujian', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('path', 'path', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "baprfoto.xls";
        $judul = "baprfoto";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Bapr");
	xlsWriteLabel($tablehead, $kolomhead++, "Pengujian");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Path");

	foreach ($this->Baprfoto_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_bapr);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pengujian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->path);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=baprfoto.doc");

        $data = array(
            'baprfoto_data' => $this->Baprfoto_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('baprfoto/baprfoto_doc',$data);
    }

}

/* End of file Baprfoto.php */
/* Location: ./application/controllers/Baprfoto.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:02:25 */
/* http://harviacode.com */