<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Daftar Order';
        $data['last_update'] = date('D/M/Y', time());
        $this->load->view('orders/orders_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Orders_model->json();
    }

    public function read($id) 
    {
        $row = $this->Orders_model->get_by_id($id);
        if ($row) {
            $data = array(
		'orderNumber' => $row->orderNumber,
		'orderDate' => $row->orderDate,
		'requiredDate' => $row->requiredDate,
		'shippedDate' => $row->shippedDate,
		'status' => $row->status,
		'comments' => $row->comments,
		'customerNumber' => $row->customerNumber,
	    );
            $this->load->view('orders/orders_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('orders/create_action'),
	    'orderNumber' => set_value('orderNumber'),
	    'orderDate' => set_value('orderDate'),
	    'requiredDate' => set_value('requiredDate'),
	    'shippedDate' => set_value('shippedDate'),
	    'status' => set_value('status'),
	    'comments' => set_value('comments'),
	    'customerNumber' => set_value('customerNumber'),
	);
        $this->load->view('orders/orders_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'orderDate' => $this->input->post('orderDate',TRUE),
		'requiredDate' => $this->input->post('requiredDate',TRUE),
		'shippedDate' => $this->input->post('shippedDate',TRUE),
		'status' => $this->input->post('status',TRUE),
		'comments' => $this->input->post('comments',TRUE),
		'customerNumber' => $this->input->post('customerNumber',TRUE),
	    );

            $this->Orders_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('orders'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Orders_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('orders/update_action'),
		'orderNumber' => set_value('orderNumber', $row->orderNumber),
		'orderDate' => set_value('orderDate', $row->orderDate),
		'requiredDate' => set_value('requiredDate', $row->requiredDate),
		'shippedDate' => set_value('shippedDate', $row->shippedDate),
		'status' => set_value('status', $row->status),
		'comments' => set_value('comments', $row->comments),
		'customerNumber' => set_value('customerNumber', $row->customerNumber),
	    );
            $this->load->view('orders/orders_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('orderNumber', TRUE));
        } else {
            $data = array(
		'orderDate' => $this->input->post('orderDate',TRUE),
		'requiredDate' => $this->input->post('requiredDate',TRUE),
		'shippedDate' => $this->input->post('shippedDate',TRUE),
		'status' => $this->input->post('status',TRUE),
		'comments' => $this->input->post('comments',TRUE),
		'customerNumber' => $this->input->post('customerNumber',TRUE),
	    );

            $this->Orders_model->update($this->input->post('orderNumber', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('orders'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Orders_model->get_by_id($id);

        if ($row) {
            $this->Orders_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('orders'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('orderDate', 'orderdate', 'trim|required');
	$this->form_validation->set_rules('requiredDate', 'requireddate', 'trim|required');
	$this->form_validation->set_rules('shippedDate', 'shippeddate', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('comments', 'comments', 'trim|required');
	$this->form_validation->set_rules('customerNumber', 'customernumber', 'trim|required');

	$this->form_validation->set_rules('orderNumber', 'orderNumber', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "orders.xls";
        $judul = "orders";
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
	xlsWriteLabel($tablehead, $kolomhead++, "OrderDate");
	xlsWriteLabel($tablehead, $kolomhead++, "RequiredDate");
	xlsWriteLabel($tablehead, $kolomhead++, "ShippedDate");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Comments");
	xlsWriteLabel($tablehead, $kolomhead++, "CustomerNumber");

	foreach ($this->Orders_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->orderDate);
	    xlsWriteLabel($tablebody, $kolombody++, $data->requiredDate);
	    xlsWriteLabel($tablebody, $kolombody++, $data->shippedDate);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->comments);
	    xlsWriteNumber($tablebody, $kolombody++, $data->customerNumber);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=orders.doc");

        $data = array(
            'orders_data' => $this->Orders_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('orders/orders_doc',$data);
    }

}

/* End of file Orders.php */
/* Location: ./application/controllers/Orders.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-30 11:15:05 */
/* http://harviacode.com */
