<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_order extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='wholesaler'){
            redirect('user');
        }

        $this->load->library("pagination");
        $this->load->model('W_order_model', 'wordermodel');
    }

    public function index(){
        // get pending order status id
        $this->db->where('name', 'pending');
        $status_id = $this->db->get('order_status');
        foreach($status_id->result() as $status_row){
            $id = $status_row->id;
        }

        $this->db->where('to', $this->session->userdata('id'));
        $this->db->where('status_id', $id);
        
        $this->db->group_by('order_id');
        $this->db->group_by('to');
        $this->db->order_by('order_id', 'desc');
        $get_order_from_retailer=$this->db->get('order_content');

        // count received order
        $count_order = $get_order_from_retailer->num_rows();

        $hold_order_data = array();
        $order_data = '';

        if($count_order != 0){
            $order_data .= '
            
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark" style="text-transform: lowercase;">New orders from retailers</h6>
                    </div>
                    <div class="pull-right">
                        <!--<a href="#" class="pull-left inline-block refresh mr-15" id="refresh_icon">
                            <i class="zmdi zmdi-replay"></i>
                        </a>-->
                        <a href="#" class="pull-left inline-block full-screen mr-15">
                            <i class="zmdi zmdi-fullscreen"></i>
                        </a>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-wrapper collapse in" id="order_body">
                    
                    <div class="panel-body row pa-0">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-left">ORDER ID</th>
                                            <th class="text-center">FROM</th>
                                            <th class="text-center">PRICE</th>
                                            <th class="text-center">DATE ORDERED</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                    ';
                    
                    foreach($get_order_from_retailer->result() as $order_row){

                        $orderid = $order_row->order_id;

                        // get order number
                        $this->db->where('id', $orderid);
                        $get_order = $this->db->get('order');
                        foreach($get_order->result() as $row_data){
                            $orderid = $row_data->id;
                            $order_number = $row_data->order_number;
                            $from = $row_data->from;
                            $date_ordered = $row_data->date_ordered;
                        }

                        //convert datetime to timestamp
                        $date_order_timestamp=strtotime($date_ordered);

                        // order from data
                        $this->db->where('user', $from);
                        $pharmacy_data = $this->db->get('pharmacy');
                        foreach($pharmacy_data->result() as $pharmacy_row){
                            $pharmacy_name = $pharmacy_row->name;
                        }

                        // order price
                        $this->db->where('to', $this->session->userdata('id'));
                        $this->db->where('order_id', $orderid);
                        
                        $order_price=$this->db->get('order_content');


                        $total_price = 0;
                        foreach($order_price->result() as $price_row){
                            $price = $price_row->price;
                            $total_price+=$price;
                        }

                        $order_data .='
                                    <tr>
                                        <td class="text-left"><span class="txt-dark weight-500">'.$order_number.'</span></td>
                                        <td class="text-center">'.$pharmacy_name.'</td>
                                        
                                        <td class="text-center">
                                            <span class="txt-success">Tsh '.number_format($total_price).'</span>
                                        </td>
                                        
                                        <td class="text-center">
                                            <span class="txt-dark weight-500">'.date('M d, Y H:i', $date_order_timestamp).'</span>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-xs btn-default btn-outline" href="'.base_url('w_order/invoice/').$orderid.'">view</a>
                                            <a class="btn btn-xs btn-success btn-outline" href="'.base_url('w_order/accept/').$orderid.'" ordernumber="">Accept</a>
                                        </td>
                                    </tr>

                        ';
                    }

                    $order_data .='</tbody>
                                        </table>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>';
        }

        $hold_order_data['order_number']=$count_order;
        $hold_order_data['new_order']=$order_data;
        echo json_encode($hold_order_data);
    }

    public function invoice(){
        $context['active']='w_invoice';
        $context['title']='invoice';
        
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Invoice.php');
        $this->load->view('includes/footer/Footer');
    }

    public function accept(){
        $invoice_id=$this->uri->segment(3);
        
        $this->db->where('id', $invoice_id);
        $get_invoice=$this->db->get('order');
        
        // count order
        $count_invoice=$get_invoice->num_rows();
        if($count_invoice==0){
            redirect('w_order/all_invoice');
        }

        // get pending order status id
        $this->db->where('name', 'processing');
        $status_id = $this->db->get('order_status');
        foreach($status_id->result() as $status_row){
            $id = $status_row->id;
        }

        $order_status = array(
            'status_id'=>$id,
        );
        
        // clean data
        $clean_order_status = $this->security->xss_clean($order_status);
        
        // update data
        $this->db->where('order_id', $invoice_id);
        $this->db->where('to', $this->session->userdata('id'));

        $order_content = $this->db->update('order_content', $clean_order_status);
        $this->session->set_flashdata('feedback', 'order accepted successfully');
        redirect("w_order/invoice/$invoice_id");
    }

    public function all_invoice(){
        $sortby = 20;
        if($_GET){
            $sort = $_GET['sort'];
            $sortby = $sort;
        }

        $config = array();
        $config["base_url"] = base_url() . "w_order/all_invoice";
        $config["total_rows"] = $this->wordermodel->count_orders();
        $config["per_page"] = $sortby;
        $config["uri_segment"] = 3;
        
        // CodeIgniter pagination customization
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = "<ul class='pagination' style='float:right;'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="javascript:void(0);" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_link'] = '';
        $config['last_link'] = '';
        $config['next_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $to = $page + $this->pagination->per_page;
        $count = $config['total_rows'];
        
        if ($to > $count) {
            $to = $count;
        }
        
        $context['active']='w_invoice';
        $context['title']='orders';
        $context['status']=$this->wordermodel->get_status();
        $context["orderdata"] = $this->wordermodel->get_order($config["per_page"], $page);
        $context["links"] = $this->pagination->create_links();
        $context['pagermessage'] = 'Showing '.($page+1) . ' to ' . $to . ' from ' . $count . ' results';
        $context['order_no']=$config["total_rows"];

        $context['active']='w_invoice';
        $context['title']='orders';
        
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Order.php');
        $this->load->view('includes/footer/Footer');
    }
}
?>