<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bapr extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bapr_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Berita Acara Pemeriksaan Pekerjaan';
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('bapr/bapr_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bapr_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bapr_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'bapr_no' => $row->bapr_no,
		'bapr_spd_no' => $row->bapr_spd_no,
		'bapr_tanggal' => $row->bapr_tanggal,
		'lokasi_objek' => $row->lokasi_objek,
		'text_hari' => $row->text_hari,
		'text_tanggal' => $row->text_tanggal,
		'text_bulan' => $row->text_bulan,
		'text_tahun' => $row->text_tahun,
		'kelompok_uji' => $row->kelompok_uji,
		'bapr_nama_alat' => $row->bapr_nama_alat,
		'merk' => $row->merk,
		'serie' => $row->serie,
		'type' => $row->type,
		'model' => $row->model,
		'nomor_unit' => $row->nomor_unit,
		'kapasitas' => $row->kapasitas,
	    );
            $this->load->view('bapr/bapr_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bapr'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bapr/create_action'),
	    'id' => set_value('id'),
	    'bapr_no' => set_value('bapr_no'),
	    'bapr_spd_no' => set_value('bapr_spd_no'),
	    'bapr_tanggal' => set_value('bapr_tanggal'),
	    'lokasi_objek' => set_value('lokasi_objek'),
	    'text_hari' => set_value('text_hari'),
	    'text_tanggal' => set_value('text_tanggal'),
	    'text_bulan' => set_value('text_bulan'),
	    'text_tahun' => set_value('text_tahun'),
	    'kelompok_uji' => set_value('kelompok_uji'),
	    'bapr_nama_alat' => set_value('bapr_nama_alat'),
	    'merk' => set_value('merk'),
	    'serie' => set_value('serie'),
	    'type' => set_value('type'),
	    'model' => set_value('model'),
	    'nomor_unit' => set_value('nomor_unit'),
	    'kapasitas' => set_value('kapasitas'),
	);
        $this->load->view('bapr/bapr_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'bapr_no' => $this->input->post('bapr_no',TRUE),
		'bapr_spd_no' => $this->input->post('bapr_spd_no',TRUE),
		'bapr_tanggal' => $this->input->post('bapr_tanggal',TRUE),
		'lokasi_objek' => $this->input->post('lokasi_objek',TRUE),
		'text_hari' => $this->input->post('text_hari',TRUE),
		'text_tanggal' => $this->input->post('text_tanggal',TRUE),
		'text_bulan' => $this->input->post('text_bulan',TRUE),
		'text_tahun' => $this->input->post('text_tahun',TRUE),
		'kelompok_uji' => $this->input->post('kelompok_uji',TRUE),
		'bapr_nama_alat' => $this->input->post('bapr_nama_alat',TRUE),
		'merk' => $this->input->post('merk',TRUE),
		'serie' => $this->input->post('serie',TRUE),
		'type' => $this->input->post('type',TRUE),
		'model' => $this->input->post('model',TRUE),
		'nomor_unit' => $this->input->post('nomor_unit',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->Bapr_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bapr'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bapr_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bapr/update_action'),
		'id' => set_value('id', $row->id),
		'bapr_no' => set_value('bapr_no', $row->bapr_no),
		'bapr_spd_no' => set_value('bapr_spd_no', $row->bapr_spd_no),
		'bapr_tanggal' => set_value('bapr_tanggal', $row->bapr_tanggal),
		'lokasi_objek' => set_value('lokasi_objek', $row->lokasi_objek),
		'text_hari' => set_value('text_hari', $row->text_hari),
		'text_tanggal' => set_value('text_tanggal', $row->text_tanggal),
		'text_bulan' => set_value('text_bulan', $row->text_bulan),
		'text_tahun' => set_value('text_tahun', $row->text_tahun),
		'kelompok_uji' => set_value('kelompok_uji', $row->kelompok_uji),
		'bapr_nama_alat' => set_value('bapr_nama_alat', $row->bapr_nama_alat),
		'merk' => set_value('merk', $row->merk),
		'serie' => set_value('serie', $row->serie),
		'type' => set_value('type', $row->type),
		'model' => set_value('model', $row->model),
		'nomor_unit' => set_value('nomor_unit', $row->nomor_unit),
		'kapasitas' => set_value('kapasitas', $row->kapasitas),
	    );
            $this->load->view('bapr/bapr_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bapr'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'bapr_no' => $this->input->post('bapr_no',TRUE),
		'bapr_spd_no' => $this->input->post('bapr_spd_no',TRUE),
		'bapr_tanggal' => $this->input->post('bapr_tanggal',TRUE),
		'lokasi_objek' => $this->input->post('lokasi_objek',TRUE),
		'text_hari' => $this->input->post('text_hari',TRUE),
		'text_tanggal' => $this->input->post('text_tanggal',TRUE),
		'text_bulan' => $this->input->post('text_bulan',TRUE),
		'text_tahun' => $this->input->post('text_tahun',TRUE),
		'kelompok_uji' => $this->input->post('kelompok_uji',TRUE),
		'bapr_nama_alat' => $this->input->post('bapr_nama_alat',TRUE),
		'merk' => $this->input->post('merk',TRUE),
		'serie' => $this->input->post('serie',TRUE),
		'type' => $this->input->post('type',TRUE),
		'model' => $this->input->post('model',TRUE),
		'nomor_unit' => $this->input->post('nomor_unit',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->Bapr_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bapr'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bapr_model->get_by_id($id);

        if ($row) {
            $this->Bapr_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bapr'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bapr'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('bapr_no', 'bapr no', 'trim|required');
	$this->form_validation->set_rules('bapr_spd_no', 'bapr spd no', 'trim|required');
	$this->form_validation->set_rules('bapr_tanggal', 'bapr tanggal', 'trim|required');
	$this->form_validation->set_rules('lokasi_objek', 'lokasi objek', 'trim|required');
	$this->form_validation->set_rules('text_hari', 'text hari', 'trim|required');
	$this->form_validation->set_rules('text_tanggal', 'text tanggal', 'trim|required');
	$this->form_validation->set_rules('text_bulan', 'text bulan', 'trim|required');
	$this->form_validation->set_rules('text_tahun', 'text tahun', 'trim|required');
	$this->form_validation->set_rules('kelompok_uji', 'kelompok uji', 'trim|required');
	$this->form_validation->set_rules('bapr_nama_alat', 'bapr nama alat', 'trim|required');
	$this->form_validation->set_rules('merk', 'merk', 'trim|required');
	$this->form_validation->set_rules('serie', 'serie', 'trim|required');
	$this->form_validation->set_rules('type', 'type', 'trim|required');
	$this->form_validation->set_rules('model', 'model', 'trim|required');
	$this->form_validation->set_rules('nomor_unit', 'nomor unit', 'trim|required');
	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bapr.xls";
        $judul = "bapr";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Bapr No");
	xlsWriteLabel($tablehead, $kolomhead++, "Bapr Spd No");
	xlsWriteLabel($tablehead, $kolomhead++, "Bapr Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Text Hari");
	xlsWriteLabel($tablehead, $kolomhead++, "Text Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Text Bulan");
	xlsWriteLabel($tablehead, $kolomhead++, "Text Tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelompok Uji");
	xlsWriteLabel($tablehead, $kolomhead++, "Bapr Nama Alat");
	xlsWriteLabel($tablehead, $kolomhead++, "Merk");
	xlsWriteLabel($tablehead, $kolomhead++, "Serie");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Model");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Unit");
	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas");

	foreach ($this->Bapr_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bapr_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bapr_spd_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bapr_tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->text_hari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->text_tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->text_bulan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->text_tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelompok_uji);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bapr_nama_alat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->merk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->serie);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->model);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_unit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kapasitas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bapr.doc");

        $data = array(
            'bapr_data' => $this->Bapr_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bapr/bapr_doc',$data);
    }

}

/* End of file Bapr.php */
/* Location: ./application/controllers/Bapr.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:01:13 */
/* http://harviacode.com */
