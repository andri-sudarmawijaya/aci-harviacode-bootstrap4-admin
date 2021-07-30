<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Spd_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Berita Surat Perjalanan Dinas';
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('spd/spd_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Spd_model->json();
    }

    public function read($id) 
    {
        $row = $this->Spd_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'spd_nomor_po' => $row->spd_nomor_po,
		'spd_no' => $row->spd_no,
		'spd_tanggal' => $row->spd_tanggal,
		'spd_id_perusahaan' => $row->spd_id_perusahaan,
		'spd_nama_perusahaan' => $row->spd_nama_perusahaan,
		'spd_hari_mulai' => $row->spd_hari_mulai,
		'spd_tanggal_mulai' => $row->spd_tanggal_mulai,
		'spd_hari_selesai' => $row->spd_hari_selesai,
		'spd_tanggal_selesai' => $row->spd_tanggal_selesai,
		'petugas1' => $row->petugas1,
		'petugas2' => $row->petugas2,
		'petugas3' => $row->petugas3,
		'petugas4' => $row->petugas4,
		'petugas5' => $row->petugas5,
		'alat1' => $row->alat1,
		'jumlah1' => $row->jumlah1,
		'alat2' => $row->alat2,
		'jumlah2' => $row->jumlah2,
		'alat3' => $row->alat3,
		'jumlah3' => $row->jumlah3,
		'alat4' => $row->alat4,
		'jumlah4' => $row->jumlah4,
		'alat5' => $row->alat5,
		'jumlah5' => $row->jumlah5,
		'alat6' => $row->alat6,
		'jumlah6' => $row->jumlah6,
		'alat7' => $row->alat7,
		'jumlah7' => $row->jumlah7,
		'alat8' => $row->alat8,
		'jumlah8' => $row->jumlah8,
		'alat9' => $row->alat9,
		'jumlah9' => $row->jumlah9,
		'alat10' => $row->alat10,
		'jumlah10' => $row->jumlah10,
	    );
            $this->load->view('spd/spd_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spd'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('spd/create_action'),
	    'id' => set_value('id'),
	    'spd_nomor_po' => set_value('spd_nomor_po'),
	    'spd_no' => set_value('spd_no'),
	    'spd_tanggal' => set_value('spd_tanggal'),
	    'spd_id_perusahaan' => set_value('spd_id_perusahaan'),
	    'spd_nama_perusahaan' => set_value('spd_nama_perusahaan'),
	    'spd_hari_mulai' => set_value('spd_hari_mulai'),
	    'spd_tanggal_mulai' => set_value('spd_tanggal_mulai'),
	    'spd_hari_selesai' => set_value('spd_hari_selesai'),
	    'spd_tanggal_selesai' => set_value('spd_tanggal_selesai'),
	    'petugas1' => set_value('petugas1'),
	    'petugas2' => set_value('petugas2'),
	    'petugas3' => set_value('petugas3'),
	    'petugas4' => set_value('petugas4'),
	    'petugas5' => set_value('petugas5'),
	    'alat1' => set_value('alat1'),
	    'jumlah1' => set_value('jumlah1'),
	    'alat2' => set_value('alat2'),
	    'jumlah2' => set_value('jumlah2'),
	    'alat3' => set_value('alat3'),
	    'jumlah3' => set_value('jumlah3'),
	    'alat4' => set_value('alat4'),
	    'jumlah4' => set_value('jumlah4'),
	    'alat5' => set_value('alat5'),
	    'jumlah5' => set_value('jumlah5'),
	    'alat6' => set_value('alat6'),
	    'jumlah6' => set_value('jumlah6'),
	    'alat7' => set_value('alat7'),
	    'jumlah7' => set_value('jumlah7'),
	    'alat8' => set_value('alat8'),
	    'jumlah8' => set_value('jumlah8'),
	    'alat9' => set_value('alat9'),
	    'jumlah9' => set_value('jumlah9'),
	    'alat10' => set_value('alat10'),
	    'jumlah10' => set_value('jumlah10'),
	);
        $this->load->view('spd/spd_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'spd_nomor_po' => $this->input->post('spd_nomor_po',TRUE),
		'spd_no' => $this->input->post('spd_no',TRUE),
		'spd_tanggal' => $this->input->post('spd_tanggal',TRUE),
		'spd_id_perusahaan' => $this->input->post('spd_id_perusahaan',TRUE),
		'spd_nama_perusahaan' => $this->input->post('spd_nama_perusahaan',TRUE),
		'spd_hari_mulai' => $this->input->post('spd_hari_mulai',TRUE),
		'spd_tanggal_mulai' => $this->input->post('spd_tanggal_mulai',TRUE),
		'spd_hari_selesai' => $this->input->post('spd_hari_selesai',TRUE),
		'spd_tanggal_selesai' => $this->input->post('spd_tanggal_selesai',TRUE),
		'petugas1' => $this->input->post('petugas1',TRUE),
		'petugas2' => $this->input->post('petugas2',TRUE),
		'petugas3' => $this->input->post('petugas3',TRUE),
		'petugas4' => $this->input->post('petugas4',TRUE),
		'petugas5' => $this->input->post('petugas5',TRUE),
		'alat1' => $this->input->post('alat1',TRUE),
		'jumlah1' => $this->input->post('jumlah1',TRUE),
		'alat2' => $this->input->post('alat2',TRUE),
		'jumlah2' => $this->input->post('jumlah2',TRUE),
		'alat3' => $this->input->post('alat3',TRUE),
		'jumlah3' => $this->input->post('jumlah3',TRUE),
		'alat4' => $this->input->post('alat4',TRUE),
		'jumlah4' => $this->input->post('jumlah4',TRUE),
		'alat5' => $this->input->post('alat5',TRUE),
		'jumlah5' => $this->input->post('jumlah5',TRUE),
		'alat6' => $this->input->post('alat6',TRUE),
		'jumlah6' => $this->input->post('jumlah6',TRUE),
		'alat7' => $this->input->post('alat7',TRUE),
		'jumlah7' => $this->input->post('jumlah7',TRUE),
		'alat8' => $this->input->post('alat8',TRUE),
		'jumlah8' => $this->input->post('jumlah8',TRUE),
		'alat9' => $this->input->post('alat9',TRUE),
		'jumlah9' => $this->input->post('jumlah9',TRUE),
		'alat10' => $this->input->post('alat10',TRUE),
		'jumlah10' => $this->input->post('jumlah10',TRUE),
	    );

            $this->Spd_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('spd'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Spd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('spd/update_action'),
		'id' => set_value('id', $row->id),
		'spd_nomor_po' => set_value('spd_nomor_po', $row->spd_nomor_po),
		'spd_no' => set_value('spd_no', $row->spd_no),
		'spd_tanggal' => set_value('spd_tanggal', $row->spd_tanggal),
		'spd_id_perusahaan' => set_value('spd_id_perusahaan', $row->spd_id_perusahaan),
		'spd_nama_perusahaan' => set_value('spd_nama_perusahaan', $row->spd_nama_perusahaan),
		'spd_hari_mulai' => set_value('spd_hari_mulai', $row->spd_hari_mulai),
		'spd_tanggal_mulai' => set_value('spd_tanggal_mulai', $row->spd_tanggal_mulai),
		'spd_hari_selesai' => set_value('spd_hari_selesai', $row->spd_hari_selesai),
		'spd_tanggal_selesai' => set_value('spd_tanggal_selesai', $row->spd_tanggal_selesai),
		'petugas1' => set_value('petugas1', $row->petugas1),
		'petugas2' => set_value('petugas2', $row->petugas2),
		'petugas3' => set_value('petugas3', $row->petugas3),
		'petugas4' => set_value('petugas4', $row->petugas4),
		'petugas5' => set_value('petugas5', $row->petugas5),
		'alat1' => set_value('alat1', $row->alat1),
		'jumlah1' => set_value('jumlah1', $row->jumlah1),
		'alat2' => set_value('alat2', $row->alat2),
		'jumlah2' => set_value('jumlah2', $row->jumlah2),
		'alat3' => set_value('alat3', $row->alat3),
		'jumlah3' => set_value('jumlah3', $row->jumlah3),
		'alat4' => set_value('alat4', $row->alat4),
		'jumlah4' => set_value('jumlah4', $row->jumlah4),
		'alat5' => set_value('alat5', $row->alat5),
		'jumlah5' => set_value('jumlah5', $row->jumlah5),
		'alat6' => set_value('alat6', $row->alat6),
		'jumlah6' => set_value('jumlah6', $row->jumlah6),
		'alat7' => set_value('alat7', $row->alat7),
		'jumlah7' => set_value('jumlah7', $row->jumlah7),
		'alat8' => set_value('alat8', $row->alat8),
		'jumlah8' => set_value('jumlah8', $row->jumlah8),
		'alat9' => set_value('alat9', $row->alat9),
		'jumlah9' => set_value('jumlah9', $row->jumlah9),
		'alat10' => set_value('alat10', $row->alat10),
		'jumlah10' => set_value('jumlah10', $row->jumlah10),
	    );
            $this->load->view('spd/spd_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spd'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'spd_nomor_po' => $this->input->post('spd_nomor_po',TRUE),
		'spd_no' => $this->input->post('spd_no',TRUE),
		'spd_tanggal' => $this->input->post('spd_tanggal',TRUE),
		'spd_id_perusahaan' => $this->input->post('spd_id_perusahaan',TRUE),
		'spd_nama_perusahaan' => $this->input->post('spd_nama_perusahaan',TRUE),
		'spd_hari_mulai' => $this->input->post('spd_hari_mulai',TRUE),
		'spd_tanggal_mulai' => $this->input->post('spd_tanggal_mulai',TRUE),
		'spd_hari_selesai' => $this->input->post('spd_hari_selesai',TRUE),
		'spd_tanggal_selesai' => $this->input->post('spd_tanggal_selesai',TRUE),
		'petugas1' => $this->input->post('petugas1',TRUE),
		'petugas2' => $this->input->post('petugas2',TRUE),
		'petugas3' => $this->input->post('petugas3',TRUE),
		'petugas4' => $this->input->post('petugas4',TRUE),
		'petugas5' => $this->input->post('petugas5',TRUE),
		'alat1' => $this->input->post('alat1',TRUE),
		'jumlah1' => $this->input->post('jumlah1',TRUE),
		'alat2' => $this->input->post('alat2',TRUE),
		'jumlah2' => $this->input->post('jumlah2',TRUE),
		'alat3' => $this->input->post('alat3',TRUE),
		'jumlah3' => $this->input->post('jumlah3',TRUE),
		'alat4' => $this->input->post('alat4',TRUE),
		'jumlah4' => $this->input->post('jumlah4',TRUE),
		'alat5' => $this->input->post('alat5',TRUE),
		'jumlah5' => $this->input->post('jumlah5',TRUE),
		'alat6' => $this->input->post('alat6',TRUE),
		'jumlah6' => $this->input->post('jumlah6',TRUE),
		'alat7' => $this->input->post('alat7',TRUE),
		'jumlah7' => $this->input->post('jumlah7',TRUE),
		'alat8' => $this->input->post('alat8',TRUE),
		'jumlah8' => $this->input->post('jumlah8',TRUE),
		'alat9' => $this->input->post('alat9',TRUE),
		'jumlah9' => $this->input->post('jumlah9',TRUE),
		'alat10' => $this->input->post('alat10',TRUE),
		'jumlah10' => $this->input->post('jumlah10',TRUE),
	    );

            $this->Spd_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('spd'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Spd_model->get_by_id($id);

        if ($row) {
            $this->Spd_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('spd'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('spd'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('spd_nomor_po', 'spd nomor po', 'trim|required');
	$this->form_validation->set_rules('spd_no', 'spd no', 'trim|required');
	$this->form_validation->set_rules('spd_tanggal', 'spd tanggal', 'trim|required');
	$this->form_validation->set_rules('spd_id_perusahaan', 'spd id perusahaan', 'trim|required');
	$this->form_validation->set_rules('spd_nama_perusahaan', 'spd nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('spd_hari_mulai', 'spd hari mulai', 'trim|required');
	$this->form_validation->set_rules('spd_tanggal_mulai', 'spd tanggal mulai', 'trim|required');
	$this->form_validation->set_rules('spd_hari_selesai', 'spd hari selesai', 'trim|required');
	$this->form_validation->set_rules('spd_tanggal_selesai', 'spd tanggal selesai', 'trim|required');
	$this->form_validation->set_rules('petugas1', 'petugas1', 'trim|required');
	$this->form_validation->set_rules('petugas2', 'petugas2', 'trim|required');
	$this->form_validation->set_rules('petugas3', 'petugas3', 'trim|required');
	$this->form_validation->set_rules('petugas4', 'petugas4', 'trim|required');
	$this->form_validation->set_rules('petugas5', 'petugas5', 'trim|required');
	$this->form_validation->set_rules('alat1', 'alat1', 'trim|required');
	$this->form_validation->set_rules('jumlah1', 'jumlah1', 'trim|required');
	$this->form_validation->set_rules('alat2', 'alat2', 'trim|required');
	$this->form_validation->set_rules('jumlah2', 'jumlah2', 'trim|required');
	$this->form_validation->set_rules('alat3', 'alat3', 'trim|required');
	$this->form_validation->set_rules('jumlah3', 'jumlah3', 'trim|required');
	$this->form_validation->set_rules('alat4', 'alat4', 'trim|required');
	$this->form_validation->set_rules('jumlah4', 'jumlah4', 'trim|required');
	$this->form_validation->set_rules('alat5', 'alat5', 'trim|required');
	$this->form_validation->set_rules('jumlah5', 'jumlah5', 'trim|required');
	$this->form_validation->set_rules('alat6', 'alat6', 'trim|required');
	$this->form_validation->set_rules('jumlah6', 'jumlah6', 'trim|required');
	$this->form_validation->set_rules('alat7', 'alat7', 'trim|required');
	$this->form_validation->set_rules('jumlah7', 'jumlah7', 'trim|required');
	$this->form_validation->set_rules('alat8', 'alat8', 'trim|required');
	$this->form_validation->set_rules('jumlah8', 'jumlah8', 'trim|required');
	$this->form_validation->set_rules('alat9', 'alat9', 'trim|required');
	$this->form_validation->set_rules('jumlah9', 'jumlah9', 'trim|required');
	$this->form_validation->set_rules('alat10', 'alat10', 'trim|required');
	$this->form_validation->set_rules('jumlah10', 'jumlah10', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "spd.xls";
        $judul = "spd";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Nomor Po");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd No");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Id Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Nama Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Hari Mulai");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Tanggal Mulai");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Hari Selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "Spd Tanggal Selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas1");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas2");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas3");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas4");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas5");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat1");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah1");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat2");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah2");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat3");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah3");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat4");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah4");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat5");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah5");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat6");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah6");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat7");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah7");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat8");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah8");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat9");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah9");
	xlsWriteLabel($tablehead, $kolomhead++, "Alat10");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah10");

	foreach ($this->Spd_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_nomor_po);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_tanggal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->spd_id_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_nama_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_hari_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_tanggal_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_hari_selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->spd_tanggal_selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas4);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas5);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat1);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat3);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat4);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah4);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat5);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah5);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat6);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah6);
	    xlsWriteNumber($tablebody, $kolombody++, $data->alat7);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah7);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat8);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah8);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alat9);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah9);
	    xlsWriteNumber($tablebody, $kolombody++, $data->alat10);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah10);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=spd.doc");

        $data = array(
            'spd_data' => $this->Spd_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('spd/spd_doc',$data);
    }

}

/* End of file Spd.php */
/* Location: ./application/controllers/Spd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 12:55:02 */
/* http://harviacode.com */
