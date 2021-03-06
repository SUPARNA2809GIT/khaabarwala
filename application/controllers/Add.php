<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

   public function __construct() {

        parent::__construct();
        $this->load->helper(array('url','form','html','text'));
        $this->load->library(array('session','form_validation','pagination','email'));
        $this->load->model(array('common_model'));
        if($this->session->userdata('ADMIN_ID') =='') {

         redirect('login');

        }
        
    }
    
    protected $validation_rules = array
    (
        'AddResturant' => array(
                            array(
                                'field' => 'res_name',
                                'label' => 'Resturant Name',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'res_address',
                                'label' => 'Address',
                                'rules' => 'trim|required'
                            )
                            
         ),
        'AddMenu' => array(
                            array(
                                'field' => 'res_id',
                                'label' => 'Resturant Name',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'menu_name',
                                'label' => 'Menu Name',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'menu_price',
                                'label' => 'Menu Price',
                                'rules' => 'trim|required'
                            ), 
                            
         ),
        'AddTicker' => array(
                            array(
                                'field' => 'ticker',
                                'label' => 'Ticker',
                                'rules' => 'trim|required'
                            ),
                            
         ),

        

    );



    public function banner()
    {

        $data=array();

        $data['result'] = $this->db->query("SELECT * FROM tb_banner ORDER BY banner_id DESC")->result();
        if(!empty($_FILES["userfile"]))
        {
            $newname= time();
            $filePath                = 'uploads';
            $config['upload_path']   = $filePath;
            $config['allowed_types'] = '*';
            $config['file_name']     = $newname;
            $config['max_size']      = "";
            $config['max_width']     = "";
            $config['max_height']    = "";
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());     
            }
            else
            {       
                $imgdata = array('upload_data' => $this->upload->data());
            }

            if(!empty($imgdata)){
                $array = array("image_name"=>$imgdata['upload_data']['file_name'],
                             "created_date"=>date('Y-m-d'),
                             "created_time"=>date('H:i:s')
                            );

                $studymaterial_id = $this->common_model->addRecord('tb_banner',$array);
            }
            else
            {
                $message = '<div class="alert alert-danger">Please select an image.</p></div>';
                $this->session->set_flashdata('success', $message);
                redirect('add/banner');
            }

            $message = '<div class="alert alert-success">Banner image has been successfully uploaded.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('add/banner');
        }

        $this->load->view('banner-list',$data);
        
    }


    public function restaurant()
    {
        $data=array();
        $data['result'] = $this->db->query("SELECT * FROM tb_restaurant ORDER BY res_name ASC")->result();
        $this->load->view('resturant-list',$data);
        
    }

    public function addRestaurant()
    {
        $data=array();
        
        $this->form_validation->set_rules($this->validation_rules['AddResturant']);
        if($this->form_validation->run() == true )
        {

            if(!empty($this->input->post('gst_applied')))
            {
                $gst_applied = $this->input->post('gst_applied');
                $gst_amount  = $this->input->post('gst_amount');
            }
            else
            {
                $gst_applied = 'n';
                
            }


            if($gst_applied=='n')
            {
                $gst_amount  = '';
            }
            else
            {
                $gst_amount  = $this->input->post('gst_amount');
            }
            
            $array = array("res_name"=>$this->input->post('res_name'),
                            "res_address"=>$this->input->post('res_address'),
                            "res_icon"=>$this->input->post('res_icon'),
                            "gst_amount"=>$gst_amount,
                            "is_gst_applied"=>$gst_applied,
                            "published"=>1,
                            "created_date"=>date('Y-m-d'),
                            "created_time"=>date('H:i:s')
                            );

            $this->common_model->addRecord('tb_restaurant',$array);
            $message = '<div class="alert alert-success">Restaurant has been successfully added.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('add/restaurant');
    
        }

        $this->load->view('resturant-add',$data);
        
    }

    public function menu()
    {
        
        $data = array();
        $data['result']=$this->db->query("SELECT a.*,b.res_name,c.cuisine_name FROM  tb_menu a 
                                          INNER JOIN tb_restaurant b ON a.res_id=b.res_id 
                                          INNER JOIN tb_cuisine c ON a.cuisine_id=c.cuisine_id
                                          ORDER BY b.res_name ASC")->result();
        $this->load->view('menu-list',$data);
    }

    public function menuAdd()
    {
        $data = array();
        $data['restaurants'] = $this->db->query("SELECT * FROM tb_restaurant ORDER BY res_name ASC")->result();

        $data['cuisine'] = $this->db->query("SELECT * FROM  tb_cuisine WHERE cuisine_name <> '' GROUP BY cuisine_name ORDER BY cuisine_name ASC")->result();

        $this->form_validation->set_rules($this->validation_rules['AddMenu']);
        if($this->form_validation->run() == true )
        {

            $cuisineName = $this->input->post('cuisine_name');
            $res_id      = $this->input->post('res_id');
            $menu_name   = $this->input->post('menu_name');

            $cuisine = $this->db->query("SELECT * FROM tb_cuisine WHERE lower(cuisine_name)='".strtolower(trim($cuisineName))."' AND res_id=".$res_id)->result();

            if(count($cuisine)>0)
            {
                $cuisine_id = $cuisine[0]->cuisine_id;
            }
            else
            {
                $cuisineArray = array("res_id"=>$res_id,
                                        "cuisine_name"=>$cuisineName,
                                        "published"=>1,
                                        "created_date"=>date('Y-m-d'),
                                        "created_time"=>date('H:i:s')
                                        );
                $cuisine_id = $this->common_model->addRecord('tb_cuisine',$cuisineArray);
            }


            $menus = $this->db->query("SELECT * FROM tb_menu WHERE res_id='".$res_id."' AND menu_name='".$menu_name."'")->result();

            if(count($menus)>0)
            {
                $editArray = array("menu_price"=>$this->input->post('menu_price'));
                $this->db->where('menu_id',$menus[0]->menu_id);
                $this->db->update('tb_menu', $editArray);
            }
            else
            {
                $menuArray = array("res_id"=>$res_id,
                                    "cuisine_id"=>$cuisine_id,
                                    "menu_name"=> $menu_name,
                                    "menu_price"=>$this->input->post('menu_price'),
                                    "menu_icon"=>$this->input->post('menu_icon'),
                                    "published"=>1,
                                    "created_date"=>date('Y-m-d'),
                                    "created_time"=>date('H:i:s')
                                    );
               $this->common_model->addRecord('tb_menu',$menuArray);
            }
            $message = '<div class="alert alert-success">Menu has been successfully added.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('add/menu');
    
        }

        $this->load->view('menu-add',$data);
        
    }

    public function ticker()
    {

        $data=array();

        $data['result'] = $this->db->query("SELECT * FROM tb_ticker ORDER BY ticker_id DESC")->result();
        $this->form_validation->set_rules($this->validation_rules['AddTicker']);
        if($this->form_validation->run() == true )
        {
            
            $array = array("ticker"=>$this->input->post('ticker'),
                           "published"=>1,
                           "created_date"=>date('Y-m-d'),
                           "created_time"=>date('H:i:s')
                            );

            $ticker_id = $this->common_model->addRecord('tb_ticker',$array);
            
            $message = '<div class="alert alert-success">Ticker has been successfully added.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('add/ticker');
        }

        $this->load->view('ticker-list',$data);
        
    }


    public function import()
    {
        if(isset($_POST["import"]))
        {

            $filename=$_FILES["file"]["tmp_name"];
            $name = $_FILES["file"]["name"];
            $path_parts = pathinfo($name);
            //file extension
            $fileExtension = $path_parts['extension'];
            //file name
            $fileName = $path_parts['filename'];

            if($fileExtension!='csv')
            {
                $message = '<div class="alert alert-danger"><p>Please upload CSV file.</p></div>';
                $this->session->set_flashdata('success',$message);
                redirect('add/menu');
            }
            else
            {
                $resturant = $this->db->query("SELECT * FROM tb_restaurant WHERE lower(res_name)='".strtolower($fileName)."'")->result();
                if(count($resturant)>0)
                {
                    $res_id=$resturant[0]->res_id;
                }
                else
                {
                    $array = array("res_name"=>$fileName,
                                    "res_address"=>'',
                                    "res_icon"=>'',
                                    "gst_amount"=>'',
                                    "is_gst_applied"=>'n',
                                    "published"=>1,
                                    "created_date"=>date('Y-m-d'),
                                    "created_time"=>date('H:i:s')
                                    );
                    $res_id = $this->common_model->addRecord('tb_restaurant',$array);
                }


                if($_FILES["file"]["size"] > 0)
                {
                    $file = fopen($filename, "r");
                    while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                        
                        if($importdata[1]=='')
                        {
                             
                            $cuisineName = preg_replace('/\s+/', ' ', $importdata[0]);
                            //$cuisineName = $importdata[0];
                            $cuisine = $this->db->query("SELECT * FROM tb_cuisine WHERE lower(cuisine_name)='".strtolower(trim($cuisineName))."' AND res_id=".$res_id)->result();

                            if(count($cuisine)>0)
                            {
                                $cuisine_id = $cuisine[0]->cuisine_id;
                            }
                            else
                            {
                                $cuisineArray = array("res_id"=>$res_id,
                                                        "cuisine_name"=>$cuisineName,
                                                        "published"=>1,
                                                        "created_date"=>date('Y-m-d'),
                                                        "created_time"=>date('H:i:s')
                                                        );
                                $cuisine_id = $this->common_model->addRecord('tb_cuisine',$cuisineArray);
                            }
                            
                            
                             
                        }

                        if((strtolower($importdata[0])!='item' && strtolower($importdata[1])!='rete') && strtolower($importdata[1])!='')
                        {

                            

                            $menu = preg_replace('/\s+/', ' ', $importdata[0]);

                            //$menu = $importdata[0];

                            $str = $importdata[1];
                            $menuPrice = preg_replace("/[^0-9]/", '', $str);


                            $menus = $this->db->query("SELECT * FROM tb_menu WHERE res_id='".$res_id."' AND menu_name LIKE '%".preg_replace('/[^A-Za-z0-9\-]/', '', $menu)."%'")->result();

                            if(count($menus)>0)
                            {
                                $editArray = array("menu_price"=>$menuPrice);
                                $this->db->where('menu_id',$menus[0]->menu_id);
                                $this->db->update('tb_menu', $editArray);
                            }
                            else
                            {
                                $menuArray = array("res_id"=>$res_id,
                                                    "cuisine_id"=>$cuisine_id,
                                                    "menu_name"=> $menu,
                                                    "menu_price"=>$menuPrice,
                                                    "menu_icon"=>'',
                                                    "published"=>1,
                                                    "created_date"=>date('Y-m-d'),
                                                    "created_time"=>date('H:i:s')
                                                    );
                               $this->common_model->addRecord('tb_menu',$menuArray);
                            }
                            
                           
                        }

                        
                    }

                    
                    fclose($file);
                    $message = '<div class="alert alert-success"><p>Data are imported successfully..</p></div>';
                    $this->session->set_flashdata('success',$message);
                    redirect('add/menu');
                }
                else
                {
                    $message = '<div class="alert alert-danger"><p>Something went wrong...</p></div>';
                    $this->session->set_flashdata('success',$message);
                    redirect('add/menu');
                }

            }

      }

    }

    public function bannerPublished()
    {
        $banner_id = $this->uri->segment(3);
        $query = $this->common_model->GetAllWhere("tb_banner",array("banner_id"=>$banner_id));
        $result = $query->result();
        $published = $result[0]->published;
        if($published==1)
        {
            $data['published'] = 0;
        }
        else
        {
            $data['published'] = 1;
        }
        //update data
        $this->db->where('banner_id', $banner_id);
        $this->db->update('tb_banner', $data);

        //echo $this->db->last_query(); die;
        redirect('add/banner');
        
    
    }
    
    
    
    public function orderPublished()
    {
        $order_id = $this->uri->segment(3);
       $query = $this->common_model->GetAllWhere("tb_order",array("order_id"=>$order_id));
        $result = $query->result();
        $is_success = $result[0]->is_success;
        if($is_success==1)
        {
            $data['is_success'] = 0;
        }
        else
        {
            $data['is_success'] = 1;
        }
        //update data
        $this->db->where('order_id',$order_id);
        $this->db->update('tb_order', $data);
       //echo $this->db->last_query(); die;
        //echo $this->db->last_query(); die;
        redirect('view/orders');
        
    
    }


    public function resGST()
    {
        $res_id = $this->uri->segment(3);
        $query = $this->common_model->GetAllWhere("tb_restaurant",array("res_id"=>$res_id));
        $result = $query->result();
        $gst_applied = $result[0]->is_gst_applied;
        if($gst_applied=='y')
        {
            $data['is_gst_applied'] = 'n';
        }
        else
        {
            $data['is_gst_applied'] = 'y';
        }
        //update data
        $this->db->where('res_id', $res_id);
        $this->db->update('tb_restaurant', $data);

        //echo $this->db->last_query(); die;
        redirect('add/restaurant');
        
    
    }



    public function resPublished()
    {
        $res_id = $this->uri->segment(3);
        $query = $this->common_model->GetAllWhere("tb_restaurant",array("res_id"=>$res_id));
        $result = $query->result();
        $published = $result[0]->published;
        if($published==1)
        {
            $data['published'] = 0;
        }
        else
        {
            $data['published'] = 1;
        }
        //update data
        $this->db->where('res_id', $res_id);
        $this->db->update('tb_restaurant', $data);

        //echo $this->db->last_query(); die;
        redirect('add/restaurant');
        
    
    }


    public function menuPublished()
    {
        $menu_id = $this->uri->segment(3);
        $query = $this->common_model->GetAllWhere("tb_menu",array("menu_id"=>$menu_id));
        $result = $query->result();
        $published = $result[0]->published;
        if($published==1)
        {
            $data['published'] = 0;
        }
        else
        {
            $data['published'] = 1;
        }
        //update data
        $this->db->where('menu_id', $menu_id);
        $this->db->update('tb_menu', $data);

       
        redirect('add/menu');
        
    
    }


    public function tickerPublished()
    {

        $ticker_id = $this->uri->segment(3);
        $query = $this->common_model->GetAllWhere("tb_ticker",array("ticker_id"=>$ticker_id));
        $result = $query->result();
        $published = $result[0]->published;
        
        if($published==0)
        {
            $data['published'] = 1;
            $this->db->where('ticker_id', $ticker_id);
            $this->db->update('tb_ticker', $data);



            $data1['published'] = 0;

            $this->db->where('ticker_id !=', $ticker_id);
            $this->db->update('tb_ticker', $data1);
        }
        else
        {
            $data['published'] = 0;
            $this->db->where('ticker_id', $ticker_id);
            $this->db->update('tb_ticker', $data);
        }
        

        
        redirect('add/ticker');
    }


    public function getCuisine()
    {
        if($this->input->post('res_id')!='')
        {
            $cuisine = $this->db->query("SELECT * FROM tb_cuisine WHERE res_id=".$this->input->post('res_id'))->result();
            if(count($cuisine)>0)
            {
                $html=' <input list="browsers" name="cuisine_name" name="cuisine_name" class="form-control" autocomplete="off">
                <datalist id="browsers">';
                foreach($cuisine as $value){ 
                    $html.='<option value="'.$value->cuisine_name.'">';
                 }

                $html.='</datalist>';
            }
            else{
                 $html=' <input list="browsers" name="cuisine_name" name="cuisine_name" class="form-control" autocomplete="off">';
            }

            echo $html;


        }

    }


    public function getMenu()
    {
        if($this->input->post('res_id')!='')
        {
            $menus = $this->db->query("SELECT * FROM tb_menu WHERE res_id=".$this->input->post('res_id'))->result();
            if(count($menus)>0)
            {
                $html=' <input list="browsers" name="menu_name" class="form-control" autocomplete="off">
                <datalist id="browsers">';
                foreach($menus as $menu){ 
                    $html.='<option value="'.$menu->menu_name.'">';
                 }

                $html.='</datalist>';
            }
            else
            {
                 $html=' <input list="browsers" name="menu_name" class="form-control" autocomplete="off">';
            }

            echo $html;


        }

    }


    public function menuIcon()
    {

        $menuId = $this->input->post('menuId');
        $menu_icon = $this->input->post('imageSymbol');

        //update data
        $data['menu_icon'] = $menu_icon;
        $this->db->where('menu_id', $menuId);
        $this->db->update('tb_menu', $data);

        echo 1;


        
    }



}
