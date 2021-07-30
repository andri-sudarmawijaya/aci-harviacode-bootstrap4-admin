<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TChainHoist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TChainHoist_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Chain Hoist';
        $data['last_update'] = date('D d/M/Y', time());
        $this->load->view('tchainhoist/TChainHoist_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->TChainHoist_model->json();
    }

    public function read($id) 
    {
        $row = $this->TChainHoist_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'suket_no' => $row->suket_no,
		'nama_perusahaan' => $row->nama_perusahaan,
		'digunakan_untuk' => $row->digunakan_untuk,
	    );
            $this->load->view('tchainhoist/TChainHoist_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tchainhoist'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tchainhoist/create_action'),
	    'id' => set_value('id'),
	    'suket_no' => set_value('suket_no'),
	    'nama_perusahaan' => set_value('nama_perusahaan'),
	    'digunakan_untuk' => set_value('digunakan_untuk'),
	);
        $this->load->view('tchainhoist/TChainHoist_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'suket_no' => $this->input->post('suket_no',TRUE),
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'digunakan_untuk' => $this->input->post('digunakan_untuk',TRUE),
	    );

            $this->TChainHoist_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tchainhoist'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->TChainHoist_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tchainhoist/update_action'),
		'id' => set_value('id', $row->id),
		'suket_no' => set_value('suket_no', $row->suket_no),
		'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
		'digunakan_untuk' => set_value('digunakan_untuk', $row->digunakan_untuk),
	    );
            $this->load->view('tchainhoist/TChainHoist_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tchainhoist'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'suket_no' => $this->input->post('suket_no',TRUE),
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'digunakan_untuk' => $this->input->post('digunakan_untuk',TRUE),
	    );

            $this->TChainHoist_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tchainhoist'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->TChainHoist_model->get_by_id($id);

        if ($row) {
            $this->TChainHoist_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tchainhoist'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tchainhoist'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('suket_no', 'suket no', 'trim|required');
	$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('digunakan_untuk', 'digunakan untuk', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "TChainHoist.xls";
        $judul = "TChainHoist";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Suket No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Digunakan Untuk");

	foreach ($this->TChainHoist_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->digunakan_untuk);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=TChainHoist.doc");

        $data = array(
            'TChainHoist_data' => $this->TChainHoist_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tchainhoist/TChainHoist_doc',$data);
    }

}

/* End of file TChainHoist.php */
/* Location: ./application/controllers/TChainHoist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:01:54 */
/* http://harviacode.com */
