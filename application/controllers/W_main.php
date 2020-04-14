<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_main extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='wholesaler'){
            redirect('user');
        }

        // load model
        $this->load->model('W_main_model', 'w_mainmodel');
        $this->load->model('Admin_model', 'adminmodel');
    }
    
    public function index(){
        //auto cancel order
        // $this->billing->auto_cancel_order();
        
        // $left_rt_dash['leftRtDash']='active';
        // $left_rt_dash['title']='Retailer Dashboard';
        $context['active']='seller_detail';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Home.php');
        $this->load->view('includes/footer/Footer');
    }

    public function add(){
        $context['active']='add_product';
        $context['title']='add product';
        $context['category']=$this->adminmodel->get_category();
        $context['selling_package']=$this->adminmodel->get_selling_package();
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Add_product.php');
        $this->load->view('includes/footer/Footer');
    }

    public function save_product(){
        $product_name = $this->input->post('product_name');
        $generic_name = $this->input->post('generic_name');
        $category = $this->input->post('category');
        $selling_package = $this->input->post('selling_package');
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $country = $this->input->post('country');
        $industry = $this->input->post('industry');
        $quantity=$this->input->post('qty');
        $description = $this->input->post('description');

        if($discount==''){
            $new_discount=0;
        }else{
            $new_discount=$discount;
        }

        if($price<$new_discount){
            echo '<h2 style = "color: red;">discount price must small than original price</h2>';
            exit();
        }
        
        if($price==$new_discount){
            $new_discount=0;
        }
        
        if($quantity==''){
            $new_quantity=0;
        }else{
            $new_quantity=$quantity;
        }

        // product details
        $product_data=array(
            'user'=>$this->session->userdata('id'),
            'brand_name'=>$product_name,
            'generic_name'=>$generic_name,
            'category'=>$category,
            'selling_package'=>$selling_package,
            'price'=>$price,
            'discount'=>$new_discount,
            'country'=>$country,
            'industry'=>$industry,
            'quantity'=>$new_quantity,
            'description'=>$description,
        );

        // clean data
        $clean_product_data = $this->security->xss_clean($product_data);
        
        $saved_object=$this->w_mainmodel->save_product($clean_product_data);
        
        //check if user browse image
        if(empty(implode($_FILES['files']['name']))){

            $this->session->set_flashdata('feedback', 'product was added successfully');
            redirect('w_main/add');
            exit();
        }
        
        //save uploaded image
        if(isset($_FILES['files'])){
            $hold_not_img_file = array();
            $hold_uploaded_img= array();
            $hold_great_img_file=array();
            $all_img=0;
            $ext_error_img=0;
            $size_error=0;
            $uploaded_img=0;
            
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name){
                $all_img++;
                
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];
                
                $extensions = array("jpeg","jpg","png");
                
                $file_ext=pathinfo($file_name, PATHINFO_EXTENSION);
                $file_ext = strtolower($file_ext);
                
                if(!empty($file_name)){
                    
                    $file_name=$this->session->userdata('unique_user_id').'_'.time().$file_name;
                    $file_name=str_replace(' ', '_', $file_name);
                    $desired_directory="./assets/app/img/original_files/".$file_name;
                    
                    $not_img_file = "";
                    if(in_array($file_ext,$extensions) === false){ //verify image file extension
                        $ext_error_img++;
                        $not_img_file = $_FILES['files']['name'][$key];
                        $hold_not_img_file[] = $not_img_file;
                    }else{ //only image file allowed .start
                        //convert filesize to MB : 1 MB = 1048576 Bytes
                        $mb_size = ($file_size)/1048576;
                        
                        $file_uploaded="";
                        $great_img_file="";
                        if($mb_size<=5){ //accept image size less than or equal to 5MB .start
                            $uploaded_img++;
                            
                            $file_uploaded = $file_name;
                            
                            // Compress Image
                            $source=$file_tmp;
                            
                            $info = getimagesize($source);
                            
                            if($info['mime'] == 'image/jpeg'){
                                $image = imagecreatefromjpeg($source);
                            }else if($info['mime'] == 'image/gif'){
                                $image = imagecreatefromgif($source);
                            }else if($info['mime'] == 'image/png'){
                                $image = imagecreatefrompng($source);
                            }

                            imagejpeg($image, $desired_directory, 20); //20 = is image quality
                            
                            ################################################################
                            ## get saved image and resize to W > 900px and H > 1000px .start
                            ################################################################
                            
                            $saved_file_image = "assets/app/img/original_files/".$file_name;
                            $image_size = getimagesize($saved_file_image);
                            $ratio = $image_size[0]/$image_size[1]; // width/height
                            
                            if($ratio > 1) {
                            //get saved file and resize to 900PX * 1000PX
                                $width = 1000;
                                $height = 1000/$ratio;
                            }else{
                                $width = 1000*$ratio;
                                $height = 1000;
                            }
                            if($width<1000 || $height<1000){
                                $min_size=min($width, $height);
                                $gap_no=1000-$min_size;
                                
                                //update both width and height
                                $width = $width+$gap_no;
                                $height = $height+$gap_no;
                            }
                            
                            $src = imagecreatefromstring(file_get_contents($saved_file_image));
                            $dst = imagecreatetruecolor($width,$height);
                            imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$image_size[0],$image_size[1]);
                            imagedestroy($src);
                            
                            //save to folder
                            $temp_file_name = "temp_".$file_name;
                            $desired_directory2="assets/app/img/900_1000_files/".$temp_file_name;
                            
                            imagejpeg($dst, $desired_directory2, 40); //save image to file
                            imagedestroy($dst);
                            
                            ##############################################################
                            ## get saved image and resize to W > 900px and H > 1000px .end
                            ##############################################################
                            
                            ####################################################
                            ## get saved image and crop to 920px * 1000px .start
                            ####################################################
                            
                            $newimg = "assets/app/img/900_1000_files/".$temp_file_name;
                            $new = imagecreatefromjpeg($newimg);
                            
                            $crop_width = imagesx($new);
                            $crop_height = imagesy($new);
                            
                            $new_width = 920;
                            $new_height = 1000;
                            
                            if($crop_width >= $crop_height){
                                $newx= ($crop_width-$crop_height)/2;
                                
                                $im2 = imagecrop($new, ['x' => $newx, 'y' => 0, 'width' => $new_width, 'height' => $new_height]);
                            }else{
                                $newy= ($crop_height-$crop_width)/2;
                                
                                $im2 = imagecrop($new, ['x' => 0, 'y' => $newy, 'width' => $new_width, 'height' => $new_height]);
                            }
                            
                            $desired_directory3="assets/app/img/900_1000_files/".$file_name;
                            imagejpeg($im2, $desired_directory3, 20); //compress and save
                            
                            //delete temp_ file
                            $temp_filename = "assets/app/img/900_1000_files/temp_".$file_name;
                            if(file_exists($temp_filename)){
                                unlink($temp_filename);
                            }
                            
                            ##################################################
                            ## get saved image and crop to 920px * 1000px .end
                            ##################################################
                            
                            ###############################################################
                            ## get saved image and resize to W > 285px and H > 285px .start
                            ###############################################################
                            
                            $saved_file_image02 = "assets/app/img/900_1000_files/".$file_name;
                            $image_size02 = getimagesize($saved_file_image02);
                            $ratio02 = $image_size02[0]/$image_size02[1]; // width/height
                            
                            if($ratio02 > 1) {
                            //get saved file and resize to 900PX * 1000PX
                                $width02 = 285;
                                $height02 = 285/$ratio;
                            }else{
                                $width02 = 285*$ratio;
                                $height02 = 285;
                            }
                            
                            if($width02<285 || $height02<285){
                                $min_size02=min($width02, $height02);
                                $gap_no02=285-$min_size02;
                                
                                //update both width and height
                                $width02 = $width02+$gap_no02;
                                $height02 = $height02+$gap_no02;
                            }
                            
                            $src02 = imagecreatefromstring(file_get_contents($saved_file_image02));
                            $dst02 = imagecreatetruecolor($width02,$height02);
                            imagecopyresampled($dst02,$src02,0,0,0,0,$width02,$height02,$image_size02[0],$image_size02[1]);
                            imagedestroy($src02);
                            
                            //save to folder
                            $temp_file_name02 = "temp02_".$file_name;
                            $desired_directory4="assets/app/img/285_files/".$temp_file_name02;
                            
                            imagejpeg($dst02, $desired_directory4, 60); //save image to file
                            imagedestroy($dst02);
                            
                            #############################################################
                            ## get saved image and resize to W > 285px and H > 285px .end
                            #############################################################
                            
                            ###################################################
                            ## get saved image and crop to 285px * 285px .start
                            ###################################################
                            
                            $newimg02 = "assets/app/img/285_files/".$temp_file_name02;
                            $new02 = imagecreatefromjpeg($newimg02);
                            
                            $crop_width02 = imagesx($new02);
                            $crop_height02 = imagesy($new02);
                            
                            $new_width02 = 285;
                            $new_height02 = 285;
                            
                            if($crop_width02 >= $crop_height02){
                                $newx02= ($crop_width02-$crop_height02)/2;
                                
                                $im202 = imagecrop($new02, ['x' => $newx02, 'y' => 0, 'width' => $new_width02, 'height' => $new_height02]);
                            }else{
                                $newy02= ($crop_height02-$crop_width02)/2;
                                
                                $im202 = imagecrop($new02, ['x' => 0, 'y' => $newy02, 'width' => $new_width02, 'height' => $new_height02]);
                            }
                            
                            $desired_directory05="assets/app/img/285_files/".$file_name;
                            imagejpeg($im202, $desired_directory05, 40); //compress and save
                            
                            //delete temp_ file
                            $temp_filename = "assets/app/img/285_files/temp02_".$file_name;
                            if(file_exists($temp_filename)){
                                unlink($temp_filename);
                            }
                            
                            #################################################
                            ##get saved image and crop to 285px * 285px .end
                            #################################################
                            
                        }else{
                            $size_error++;
                            //file which is not uploaded coz its greater than 5MB
                            $great_img_file=$_FILES['files']['name'][$key];
                        } //accept image size less than or equal to 5MB .end
                        
                        //hold data in array
                        
                        $hold_uploaded_img[] = $file_uploaded;
                        $hold_great_img_file[] = $great_img_file;
                        
                    } //only image file allowed .end
                    
                }else{
                    continue;
                }
                
            } //end foreach
            
            //remove empty values from array
            $clean_not_img_file = array_filter($hold_not_img_file);
            $clean_uploaded_img = array_filter($hold_uploaded_img);
            $clean_great_img_file = array_filter($hold_great_img_file);
            
            //sort array id to be in sequence order
            sort($clean_not_img_file);
            sort($clean_uploaded_img);
            sort($clean_great_img_file);
            
            if($uploaded_img>0){
                
                for($img_file=0; $img_file<$uploaded_img; $img_file++){
                    $saved_img=$clean_uploaded_img[$img_file];
                    
                    $hold_img_data=array(
                        'product'=>$saved_object,
                        'filename'=>$saved_img
                    );
                    //clean data
                    $clean_img_data=$this->security->xss_clean($hold_img_data);
                    $this->db->insert("product_image",$clean_img_data);
                }
                
            }
            
            $this->session->set_flashdata('feedback', 'product was added successfully');
            redirect("w_main/add?all=$all_img&pass=$uploaded_img&ext_error=$ext_error_img&size_error=$size_error");
        }
    }

}
?>