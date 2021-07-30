<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Suket_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Surat Keterangan';
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('suket/suket_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Suket_model->json();
    }

    public function read($id) 
    {
        $row = $this->Suket_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no' => $row->no,
		'suket_bapr_no' => $row->suket_bapr_no,
		'nomor_laporan' => $row->nomor_laporan,
		'nomor_sertifikat' => $row->nomor_sertifikat,
		'tanggal_penerbitan' => $row->tanggal_penerbitan,
		'nomor_suket' => $row->nomor_suket,
		'kelompok_uji' => $row->kelompok_uji,
		'template' => $row->template,
		'jenis_pesawat' => $row->jenis_pesawat,
		'nama_alat' => $row->nama_alat,
		'nama_alat_awal' => $row->nama_alat_awal,
		'suket_jenis_pemeriksaan' => $row->suket_jenis_pemeriksaan,
		'suket_nama_perusahaan' => $row->suket_nama_perusahaan,
		'nama_perusahaan_awal' => $row->nama_perusahaan_awal,
		'qty' => $row->qty,
		'pabrik_pembuat' => $row->pabrik_pembuat,
		'tempat_pembuatan' => $row->tempat_pembuatan,
		'tahun_pembuatan' => $row->tahun_pembuatan,
		'memenuhi_syarat_k3' => $row->memenuhi_syarat_k3,
		'tanggal_suket' => $row->tanggal_suket,
		'suket_riksa_kembali' => $row->suket_riksa_kembali,
		'suket_riksa_kembali_tahun' => $row->suket_riksa_kembali_tahun,
		'suket_riksa_kembali_bulan' => $row->suket_riksa_kembali_bulan,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('suket/suket_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suket'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('suket/create_action'),
	    'id' => set_value('id'),
	    'no' => set_value('no'),
	    'suket_bapr_no' => set_value('suket_bapr_no'),
	    'nomor_laporan' => set_value('nomor_laporan'),
	    'nomor_sertifikat' => set_value('nomor_sertifikat'),
	    'tanggal_penerbitan' => set_value('tanggal_penerbitan'),
	    'nomor_suket' => set_value('nomor_suket'),
	    'kelompok_uji' => set_value('kelompok_uji'),
	    'template' => set_value('template'),
	    'jenis_pesawat' => set_value('jenis_pesawat'),
	    'nama_alat' => set_value('nama_alat'),
	    'nama_alat_awal' => set_value('nama_alat_awal'),
	    'suket_jenis_pemeriksaan' => set_value('suket_jenis_pemeriksaan'),
	    'suket_nama_perusahaan' => set_value('suket_nama_perusahaan'),
	    'nama_perusahaan_awal' => set_value('nama_perusahaan_awal'),
	    'qty' => set_value('qty'),
	    'pabrik_pembuat' => set_value('pabrik_pembuat'),
	    'tempat_pembuatan' => set_value('tempat_pembuatan'),
	    'tahun_pembuatan' => set_value('tahun_pembuatan'),
	    'memenuhi_syarat_k3' => set_value('memenuhi_syarat_k3'),
	    'tanggal_suket' => set_value('tanggal_suket'),
	    'suket_riksa_kembali' => set_value('suket_riksa_kembali'),
	    'suket_riksa_kembali_tahun' => set_value('suket_riksa_kembali_tahun'),
	    'suket_riksa_kembali_bulan' => set_value('suket_riksa_kembali_bulan'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->load->view('suket/suket_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'suket_bapr_no' => $this->input->post('suket_bapr_no',TRUE),
		'nomor_laporan' => $this->input->post('nomor_laporan',TRUE),
		'nomor_sertifikat' => $this->input->post('nomor_sertifikat',TRUE),
		'tanggal_penerbitan' => $this->input->post('tanggal_penerbitan',TRUE),
		'nomor_suket' => $this->input->post('nomor_suket',TRUE),
		'kelompok_uji' => $this->input->post('kelompok_uji',TRUE),
		'template' => $this->input->post('template',TRUE),
		'jenis_pesawat' => $this->input->post('jenis_pesawat',TRUE),
		'nama_alat' => $this->input->post('nama_alat',TRUE),
		'nama_alat_awal' => $this->input->post('nama_alat_awal',TRUE),
		'suket_jenis_pemeriksaan' => $this->input->post('suket_jenis_pemeriksaan',TRUE),
		'suket_nama_perusahaan' => $this->input->post('suket_nama_perusahaan',TRUE),
		'nama_perusahaan_awal' => $this->input->post('nama_perusahaan_awal',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'pabrik_pembuat' => $this->input->post('pabrik_pembuat',TRUE),
		'tempat_pembuatan' => $this->input->post('tempat_pembuatan',TRUE),
		'tahun_pembuatan' => $this->input->post('tahun_pembuatan',TRUE),
		'memenuhi_syarat_k3' => $this->input->post('memenuhi_syarat_k3',TRUE),
		'tanggal_suket' => $this->input->post('tanggal_suket',TRUE),
		'suket_riksa_kembali' => $this->input->post('suket_riksa_kembali',TRUE),
		'suket_riksa_kembali_tahun' => $this->input->post('suket_riksa_kembali_tahun',TRUE),
		'suket_riksa_kembali_bulan' => $this->input->post('suket_riksa_kembali_bulan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Suket_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('suket'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Suket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('suket/update_action'),
		'id' => set_value('id', $row->id),
		'no' => set_value('no', $row->no),
		'suket_bapr_no' => set_value('suket_bapr_no', $row->suket_bapr_no),
		'nomor_laporan' => set_value('nomor_laporan', $row->nomor_laporan),
		'nomor_sertifikat' => set_value('nomor_sertifikat', $row->nomor_sertifikat),
		'tanggal_penerbitan' => set_value('tanggal_penerbitan', $row->tanggal_penerbitan),
		'nomor_suket' => set_value('nomor_suket', $row->nomor_suket),
		'kelompok_uji' => set_value('kelompok_uji', $row->kelompok_uji),
		'template' => set_value('template', $row->template),
		'jenis_pesawat' => set_value('jenis_pesawat', $row->jenis_pesawat),
		'nama_alat' => set_value('nama_alat', $row->nama_alat),
		'nama_alat_awal' => set_value('nama_alat_awal', $row->nama_alat_awal),
		'suket_jenis_pemeriksaan' => set_value('suket_jenis_pemeriksaan', $row->suket_jenis_pemeriksaan),
		'suket_nama_perusahaan' => set_value('suket_nama_perusahaan', $row->suket_nama_perusahaan),
		'nama_perusahaan_awal' => set_value('nama_perusahaan_awal', $row->nama_perusahaan_awal),
		'qty' => set_value('qty', $row->qty),
		'pabrik_pembuat' => set_value('pabrik_pembuat', $row->pabrik_pembuat),
		'tempat_pembuatan' => set_value('tempat_pembuatan', $row->tempat_pembuatan),
		'tahun_pembuatan' => set_value('tahun_pembuatan', $row->tahun_pembuatan),
		'memenuhi_syarat_k3' => set_value('memenuhi_syarat_k3', $row->memenuhi_syarat_k3),
		'tanggal_suket' => set_value('tanggal_suket', $row->tanggal_suket),
		'suket_riksa_kembali' => set_value('suket_riksa_kembali', $row->suket_riksa_kembali),
		'suket_riksa_kembali_tahun' => set_value('suket_riksa_kembali_tahun', $row->suket_riksa_kembali_tahun),
		'suket_riksa_kembali_bulan' => set_value('suket_riksa_kembali_bulan', $row->suket_riksa_kembali_bulan),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->load->view('suket/suket_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suket'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'suket_bapr_no' => $this->input->post('suket_bapr_no',TRUE),
		'nomor_laporan' => $this->input->post('nomor_laporan',TRUE),
		'nomor_sertifikat' => $this->input->post('nomor_sertifikat',TRUE),
		'tanggal_penerbitan' => $this->input->post('tanggal_penerbitan',TRUE),
		'nomor_suket' => $this->input->post('nomor_suket',TRUE),
		'kelompok_uji' => $this->input->post('kelompok_uji',TRUE),
		'template' => $this->input->post('template',TRUE),
		'jenis_pesawat' => $this->input->post('jenis_pesawat',TRUE),
		'nama_alat' => $this->input->post('nama_alat',TRUE),
		'nama_alat_awal' => $this->input->post('nama_alat_awal',TRUE),
		'suket_jenis_pemeriksaan' => $this->input->post('suket_jenis_pemeriksaan',TRUE),
		'suket_nama_perusahaan' => $this->input->post('suket_nama_perusahaan',TRUE),
		'nama_perusahaan_awal' => $this->input->post('nama_perusahaan_awal',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'pabrik_pembuat' => $this->input->post('pabrik_pembuat',TRUE),
		'tempat_pembuatan' => $this->input->post('tempat_pembuatan',TRUE),
		'tahun_pembuatan' => $this->input->post('tahun_pembuatan',TRUE),
		'memenuhi_syarat_k3' => $this->input->post('memenuhi_syarat_k3',TRUE),
		'tanggal_suket' => $this->input->post('tanggal_suket',TRUE),
		'suket_riksa_kembali' => $this->input->post('suket_riksa_kembali',TRUE),
		'suket_riksa_kembali_tahun' => $this->input->post('suket_riksa_kembali_tahun',TRUE),
		'suket_riksa_kembali_bulan' => $this->input->post('suket_riksa_kembali_bulan',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Suket_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('suket'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Suket_model->get_by_id($id);

        if ($row) {
            $this->Suket_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('suket'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suket'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no', 'no', 'trim|required');
	$this->form_validation->set_rules('suket_bapr_no', 'suket bapr no', 'trim|required');
	$this->form_validation->set_rules('nomor_laporan', 'nomor laporan', 'trim|required');
	$this->form_validation->set_rules('nomor_sertifikat', 'nomor sertifikat', 'trim|required');
	$this->form_validation->set_rules('tanggal_penerbitan', 'tanggal penerbitan', 'trim|required');
	$this->form_validation->set_rules('nomor_suket', 'nomor suket', 'trim|required');
	$this->form_validation->set_rules('kelompok_uji', 'kelompok uji', 'trim|required');
	$this->form_validation->set_rules('template', 'template', 'trim|required');
	$this->form_validation->set_rules('jenis_pesawat', 'jenis pesawat', 'trim|required');
	$this->form_validation->set_rules('nama_alat', 'nama alat', 'trim|required');
	$this->form_validation->set_rules('nama_alat_awal', 'nama alat awal', 'trim|required');
	$this->form_validation->set_rules('suket_jenis_pemeriksaan', 'suket jenis pemeriksaan', 'trim|required');
	$this->form_validation->set_rules('suket_nama_perusahaan', 'suket nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('nama_perusahaan_awal', 'nama perusahaan awal', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('pabrik_pembuat', 'pabrik pembuat', 'trim|required');
	$this->form_validation->set_rules('tempat_pembuatan', 'tempat pembuatan', 'trim|required');
	$this->form_validation->set_rules('tahun_pembuatan', 'tahun pembuatan', 'trim|required');
	$this->form_validation->set_rules('memenuhi_syarat_k3', 'memenuhi syarat k3', 'trim|required');
	$this->form_validation->set_rules('tanggal_suket', 'tanggal suket', 'trim|required');
	$this->form_validation->set_rules('suket_riksa_kembali', 'suket riksa kembali', 'trim|required');
	$this->form_validation->set_rules('suket_riksa_kembali_tahun', 'suket riksa kembali tahun', 'trim|required');
	$this->form_validation->set_rules('suket_riksa_kembali_bulan', 'suket riksa kembali bulan', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "suket.xls";
        $judul = "suket";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Bapr No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Laporan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Sertifikat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Penerbitan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Suket");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelompok Uji");
	xlsWriteLabel($tablehead, $kolomhead++, "Template");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pesawat");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Alat");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Alat Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Jenis Pemeriksaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Nama Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Perusahaan Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Pabrik Pembuat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Pembuatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Pembuatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Memenuhi Syarat K3");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Suket");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Riksa Kembali");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Riksa Kembali Tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Suket Riksa Kembali Bulan");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Suket_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_bapr_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_laporan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_sertifikat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_penerbitan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_suket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kelompok_uji);
	    xlsWriteLabel($tablebody, $kolombody++, $data->template);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pesawat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_alat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_alat_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_jenis_pemeriksaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_nama_perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_perusahaan_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->qty);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pabrik_pembuat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_pembuatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_pembuatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->memenuhi_syarat_k3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_suket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_riksa_kembali);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_riksa_kembali_tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->suket_riksa_kembali_bulan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=suket.doc");

        $data = array(
            'suket_data' => $this->Suket_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('suket/suket_doc',$data);
    }

}

/* End of file Suket.php */
/* Location: ./application/controllers/Suket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 13:00:23 */
/* http://harviacode.com */
