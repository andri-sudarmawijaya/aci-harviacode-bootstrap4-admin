<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Po extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Po_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('po/po_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Po_model->json();
    }

    public function read($id) 
    {
        $row = $this->Po_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'po_nomor' => $row->po_nomor,
		'po_nama_perusahaan' => $row->po_nama_perusahaan,
		'po_tanggal' => $row->po_tanggal,
		'dibuat' => $row->dibuat,
		'diubah' => $row->diubah,
	    );
            $this->load->view('po/po_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('po/create_action'),
	    'id' => set_value('id'),
	    'po_nomor' => set_value('po_nomor'),
	    'po_nama_perusahaan' => set_value('po_nama_perusahaan'),
	    'po_tanggal' => set_value('po_tanggal'),
	    'dibuat' => set_value('dibuat'),
	    'diubah' => set_value('diubah'),
	);
        $this->load->view('po/po_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'po_nomor' => $this->input->post('po_nomor',TRUE),
		'po_nama_perusahaan' => $this->input->post('po_nama_perusahaan',TRUE),
		'po_tanggal' => $this->input->post('po_tanggal',TRUE),
		'dibuat' => $this->input->post('dibuat',TRUE),
		'diubah' => $this->input->post('diubah',TRUE),
	    );

            $this->Po_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('po'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Po_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('po/update_action'),
		'id' => set_value('id', $row->id),
		'po_nomor' => set_value('po_nomor', $row->po_nomor),
		'po_nama_perusahaan' => set_value('po_nama_perusahaan', $row->po_nama_perusahaan),
		'po_tanggal' => set_value('po_tanggal', $row->po_tanggal),
		'dibuat' => set_value('dibuat', $row->dibuat),
		'diubah' => set_value('diubah', $row->diubah),
	    );
            $this->load->view('po/po_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'po_nomor' => $this->input->post('po_nomor',TRUE),
		'po_nama_perusahaan' => $this->input->post('po_nama_perusahaan',TRUE),
		'po_tanggal' => $this->input->post('po_tanggal',TRUE),
		'dibuat' => $this->input->post('dibuat',TRUE),
		'diubah' => $this->input->post('diubah',TRUE),
	    );

            $this->Po_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('po'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Po_model->get_by_id($id);

        if ($row) {
            $this->Po_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('po'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('po'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('po_nomor', 'po nomor', 'trim|required');
	$this->form_validation->set_rules('po_nama_perusahaan', 'po nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('po_tanggal', 'po tanggal', 'trim|required');
	$this->form_validation->set_rules('dibuat', 'dibuat', 'trim|required');
	$this->form_validation->set_rules('diubah', 'diubah', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "po.xls";
        $judul = "po";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Po Nomor");
	xlsWriteLabel($tablehead, $kolomhead++, "Po Nama Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Po Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Dibuat");
	xlsWriteLabel($tablehead, $kolomhead++, "Diubah");

	foreach ($this->Po_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->po_nomor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->po_nama_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->po_tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dibuat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->diubah);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=po.doc");

        $data = array(
            'po_data' => $this->Po_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('po/po_doc',$data);
    }

}

/* End of file Po.php */
/* Location: ./application/controllers/Po.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:02:13 */
/* http://harviacode.com */