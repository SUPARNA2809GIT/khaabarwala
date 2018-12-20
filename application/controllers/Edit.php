<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

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



    );







	public function banner()

	{



		$id = $this->uri->segment(3);

		$data['result'] = $this->db->query("SELECT * FROM tb_banner ORDER BY banner_id DESC")->result();

        $data['row'] = $this->db->query("SELECT * FROM tb_banner WHERE banner_id=".$id)->row();

		

		if(!empty($_FILES["userfile"]))

        {

             unlink("uploads/1543235119.jpg");





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



            //print_r($error); die;



            if(!empty($imgdata)){



               

                $array = array("image_name"=>$imgdata['upload_data']['file_name'] );

                $this->db->where('banner_id', $id);

                $this->db->update('tb_banner', $array);

            }

             else

            {

                $message = '<div class="alert alert-danger">Please select an image.</p></div>';

                $this->session->set_flashdata('success', $message);

                redirect('edit/banner/'.$id);

            }

            



            $message = '<div class="alert alert-success">Banner image has been successfully uploaded.</p></div>';

            $this->session->set_flashdata('success', $message);

            redirect('edit/banner/'.$id);

        }

		$this->load->view('banner-edit',$data);

	}





	public function restaurant()

    {

        $data=array();

        $id = $this->uri->segment(3);

        $data['row'] = $this->db->query("SELECT * FROM tb_restaurant WHERE res_id=".$id)->row();



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

                           "is_gst_applied"=>$gst_applied

                          );



           

            $this->db->where('res_id',$id);

            $this->db->update('tb_restaurant', $array);



            

            $message = '<div class="alert alert-success">Resturant has been successfully modified.</p></div>';

            $this->session->set_flashdata('success', $message);

            redirect('add/restaurant');

    

        }



        $this->load->view('resturant-edit',$data);

        

    }

    public function menu()
    {

        $data = array();

        $id = $this->uri->segment(3);

        $data['restaurants'] = $this->db->query("SELECT * FROM tb_restaurant ORDER BY res_name ASC")->result();

        $data['cuisine'] = $this->db->query("SELECT * FROM  tb_cuisine WHERE cuisine_name <> '' GROUP BY cuisine_name ORDER BY cuisine_name ASC")->result();

        $data['row'] = $this->db->query("SELECT * FROM tb_menu WHERE menu_id=".$id)->row();

        $this->form_validation->set_rules($this->validation_rules['AddMenu']);

        if($this->form_validation->run() == true )
        {


            $cuisineName = $this->input->post('cuisine_name');
            $res_id      = $this->input->post('res_id');
            $menu_name   = $this->input->post('menu_name');

            $cuisine = $this->db->query("SELECT * FROM tb_cuisine WHERE lower(cuisine_name)='".strtolower($cuisineName)."' AND res_id=".$res_id)->result();
            
            //echo $this->db->last_query(); die;

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

            $array = array("res_id"=>$res_id,
                            "cuisine_id"=>$cuisine_id,
                            "menu_name"=> $menu_name,
                            "menu_price"=>$this->input->post('menu_price'),
                            "menu_icon"=>$this->input->post('menu_icon')
                            );
             $this->db->where('menu_id',$id);
             $this->db->update('tb_menu', $array);

            $message = '<div class="alert alert-success">Menu has been successfully modified.</p></div>';
            $this->session->set_flashdata('success', $message);
            redirect('add/menu');
        }


        $this->load->view('menu-edit',$data);

        

    }





}



