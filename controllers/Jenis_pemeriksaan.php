<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_pemeriksaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_pemeriksaan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Jenis Pemeriksaan';
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('jenis_pemeriksaan/jenis_pemeriksaan_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jenis_pemeriksaan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jenis_pemeriksaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_jenis_pemeriksaan' => $row->nama_jenis_pemeriksaan,
		'header_jenis_pemeriksaan' => $row->header_jenis_pemeriksaan,
		'kop_jenis_pemeriksaan' => $row->kop_jenis_pemeriksaan,
	    );
            $this->load->view('jenis_pemeriksaan/jenis_pemeriksaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pemeriksaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_pemeriksaan/create_action'),
	    'id' => set_value('id'),
	    'nama_jenis_pemeriksaan' => set_value('nama_jenis_pemeriksaan'),
	    'header_jenis_pemeriksaan' => set_value('header_jenis_pemeriksaan'),
	    'kop_jenis_pemeriksaan' => set_value('kop_jenis_pemeriksaan'),
	);
        $this->load->view('jenis_pemeriksaan/jenis_pemeriksaan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jenis_pemeriksaan' => $this->input->post('nama_jenis_pemeriksaan',TRUE),
		'header_jenis_pemeriksaan' => $this->input->post('header_jenis_pemeriksaan',TRUE),
		'kop_jenis_pemeriksaan' => $this->input->post('kop_jenis_pemeriksaan',TRUE),
	    );

            $this->Jenis_pemeriksaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_pemeriksaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_pemeriksaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_pemeriksaan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_jenis_pemeriksaan' => set_value('nama_jenis_pemeriksaan', $row->nama_jenis_pemeriksaan),
		'header_jenis_pemeriksaan' => set_value('header_jenis_pemeriksaan', $row->header_jenis_pemeriksaan),
		'kop_jenis_pemeriksaan' => set_value('kop_jenis_pemeriksaan', $row->kop_jenis_pemeriksaan),
	    );
            $this->load->view('jenis_pemeriksaan/jenis_pemeriksaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pemeriksaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_jenis_pemeriksaan' => $this->input->post('nama_jenis_pemeriksaan',TRUE),
		'header_jenis_pemeriksaan' => $this->input->post('header_jenis_pemeriksaan',TRUE),
		'kop_jenis_pemeriksaan' => $this->input->post('kop_jenis_pemeriksaan',TRUE),
	    );

            $this->Jenis_pemeriksaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_pemeriksaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_pemeriksaan_model->get_by_id($id);

        if ($row) {
            $this->Jenis_pemeriksaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_pemeriksaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pemeriksaan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jenis_pemeriksaan', 'nama jenis pemeriksaan', 'trim|required');
	$this->form_validation->set_rules('header_jenis_pemeriksaan', 'header jenis pemeriksaan', 'trim|required');
	$this->form_validation->set_rules('kop_jenis_pemeriksaan', 'kop jenis pemeriksaan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jenis_pemeriksaan.xls";
        $judul = "jenis_pemeriksaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jenis Pemeriksaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Header Jenis Pemeriksaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kop Jenis Pemeriksaan");

	foreach ($this->Jenis_pemeriksaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jenis_pemeriksaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->header_jenis_pemeriksaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kop_jenis_pemeriksaan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jenis_pemeriksaan.doc");

        $data = array(
            'jenis_pemeriksaan_data' => $this->Jenis_pemeriksaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('jenis_pemeriksaan/jenis_pemeriksaan_doc',$data);
    }

}

/* End of file Jenis_pemeriksaan.php */
/* Location: ./application/controllers/Jenis_pemeriksaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:01:41 */
/* http://harviacode.com */
