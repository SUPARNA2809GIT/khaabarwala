<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khabarwala_api extends CI_Controller {

   public function __construct() {

		parent::__construct();
		$this->load->helper(array('url','form','html','text'));
		$this->load->library(array('session','form_validation','pagination','email'));
		$this->load->model(array('common_model'));
		
		
	}

    public function getBanner()
    {
        $banners = $this->db->query("SELECT * FROM tb_banner WHERE published=1")->result();
        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('banners' => $banners));
    }

    public function getRestaurents()
    {
       
        $restaurents = $this->db->query("SELECT * FROM tb_restaurant WHERE published=1 LIMIT 5" )->result();
        $allRes = array();
        
        foreach ($restaurents as $res) {

            $menus = $this->db->query("SELECT * FROM tb_menu WHERE published=1 AND res_id=".$res->res_id." LIMIT 20" )->result();
            $strMenu = '';
            foreach ($menus as $menu) {
                $strMenu.=$menu->menu_name.',';
            }


            // 5 star - 252
			// 4 star - 124
			// 3 star - 40
			// 2 star - 29
			// 1 star - 33
			// (5*252 + 4*124 + 3*40 + 2*29 + 1*33) / (252+124+40+29+33) = 4.11 and change


			$rattings = $this->db->query("SELECT DISTINCT(rate) FROM tb_ratting WHERE res_id=".$res->res_id)->result();

			//print_r($rattings); die;
			$totRate = '';
			$dividedBy = '';
			$finalRate = '';

			if(!empty($rattings))
			{

				foreach($rattings as $rates){
				
					$star = $rates->rate;
					$count = $this->db->query("SELECT * FROM tb_ratting WHERE res_id=".$res->res_id." AND rate=".$rates->rate)->num_rows();

					$totRate+=$star*$count;
					$dividedBy+=$count; 


				}

				$finalRate = ($totRate/$dividedBy);

				$finalRate = number_format((float)$finalRate, 1, '.', '');

			}
			

            $allRes[] = array("res"=>$res,"menu"=>rtrim($strMenu,','),"ratting"=>$finalRate);

        }

  		


        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));
    }


    public function getRestaurentDetails()
    {
        
        $res_id = $this->input->post('resId');

        $restaurents = $this->db->query("SELECT * FROM tb_restaurant WHERE res_id=".$res_id)->result();
        
        $cuisines = $this->db->query("SELECT * FROM tb_cuisine WHERE res_id=".$res_id)->result();

        $allCuisines=array();

        if(!empty($cuisines))
        {
        	foreach ($cuisines as $cuisine) {

	        	$menus = $this->db->query("SELECT * FROM tb_menu WHERE res_id=".$res_id." AND cuisine_id=".$cuisine->cuisine_id)->result();

	        	$allCuisines[] = array("cuisines"=>$cuisine->cuisine_name,"menu"=>$menus);

	        }
        }

		$rattings = $this->db->query("SELECT DISTINCT(rate) FROM tb_ratting WHERE res_id=".$res_id)->result();

		$totRate = '';
		$dividedBy = '';
		$finalRate = '';

		if(!empty($rattings))
		{

			foreach($rattings as $rates)
			{
			
				$star = $rates->rate;
				$count = $this->db->query("SELECT * FROM tb_ratting WHERE res_id=".$res_id." AND rate=".$rates->rate)->num_rows();
				$totRate+=$star*$count;
				$dividedBy+=$count;
			}

			$finalRate = ($totRate/$dividedBy);

			$finalRate = number_format((float)$finalRate, 1, '.', '');

		}
		

        $allRes[] = array("restaurents"=>$restaurents,"allCuisines"=>$allCuisines,"ratting"=>$finalRate);

        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));
    }


    public function getResLazyLoad()
    {
    	$limit = 5;

    	$offset = $this->input->post('restaurentCount');

    	$restaurents = $this->db->query("SELECT * FROM tb_restaurant WHERE LIMIT ".$limit." OFFSET ".$offset)->result();

        $allRes = array();
        
        foreach ($restaurents as $res) {

            $menus = $this->db->query("SELECT * FROM tb_menu WHERE published=1 AND res_id=".$res->res_id." LIMIT 20" )->result();
            $strMenu = '';
            foreach ($menus as $menu) {
                $strMenu.=$menu->menu_name.',';
            }


            // 5 star - 252
			// 4 star - 124
			// 3 star - 40
			// 2 star - 29
			// 1 star - 33
			// (5*252 + 4*124 + 3*40 + 2*29 + 1*33) / (252+124+40+29+33) = 4.11 and change


			$rattings = $this->db->query("SELECT DISTINCT(rate) FROM tb_ratting WHERE res_id=".$res->res_id)->result();

			//print_r($rattings); die;
			$totRate = '';
			$dividedBy = '';
			$finalRate = '';

			if(!empty($rattings))
			{

				foreach($rattings as $rates){
				
					$star = $rates->rate;
					$count = $this->db->query("SELECT * FROM tb_ratting WHERE res_id=".$res->res_id." AND rate=".$rates->rate)->num_rows();

					$totRate+=$star*$count;
					$dividedBy+=$count; 


				}

				$finalRate = ($totRate/$dividedBy);

				$finalRate = number_format((float)$finalRate, 1, '.', '');



			}
			

            $allRes[] = array("res"=>$res,"menu"=>rtrim($strMenu,','),"ratting"=>$finalRate);

        }

        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));



    }

    public function addToCart()
    {
    	//{ restaurant: resturent_id, menu: menu_id, qty: curretn_value, deviceId: device.uuid }
    	$deviceId = $this->input->post('deviceId');
    	$restaurant_id = $this->input->post('restaurant');
    	$menu_id = $this->input->post('menu_id');
    	$qty = $this->input->post('qty');
    	$gst = 0;
    	$gst_amount = 0;

    	//add to cart menu
    	if($qty>0)
    	{

    		$cartCount = $this->db->query("SELECT * FROM tb_cart WHERE device_id=".$device_id." AND restaurant_id!=".$restaurant_id)->num_rows();

	    	if($cartCount>0)
	    	{
	    		 $this->db->delete('tb_cart', array('device_id' => $deviceId));
	    	}

	    	$menu = $this->db->query("SELECT * FROM tb_menu WHERE menu_id=".$menu_id)->row();
	    	$restaurant = $this->db->query("SELECT * FROM tb_restaurant WHERE res_id=".$menu->res_id." WHERE is_gst_applied='y'")->row();
	    	$price = $menu->menu_price;
	    	if(!empty($restaurant))
	    	{
	    		$gst = $restaurant->gst_amount;
	    		$gst_amount = (($qty*$price)*$gst)/100;
	    		
	    	}

	    	$cartMenu = array('device_id' =>$deviceId,
	    					 'restaurant_id'=>$restaurant_id,
	    					 'menu_id'=>$menu_id,
	    					 'quantity'=>$qty,
	    					 'price'=>$price,
	    					 'total_price'=>$qty*$price;
	    					 'gst_amount'=>$gst_amount,
	    					 'amount_w_gst'=>($qty*$price)+$gst_amount,
	    					 'created_time'=>date('h:i:s'),
	    					 'created_date'=>date('Y-m-d'),
	    					);

	    	$cart_id = $this->common_model->addRecord('tb_cart',$cartMenu);


	    	header('Access-Control-Allow-Origin: *');
            echo json_encode(array('cart_id' => $cart_id));
    	}


    	
    }


    public function removeCart()
    {

    	$deviceId = $this->input->post('deviceId');
    	$restaurant_id = $this->input->post('restaurant');
    	$menu_id = $this->input->post('menu_id');

    	$cartCount = $this->db->query("SELECT * FROM tb_cart WHERE device_id=".$device_id)->num_rows();

    	if($cartCount>0)
    	{
    		$this->db->delete('tb_cart', array('device_id' => $deviceId,'restaurant_id'=>$restaurant_id,'menu_id'=>$menu_id));

    		$success=1;
    	}
    	else
    	{
    		$success=0;
    	}

    	header('Access-Control-Allow-Origin: *');
        echo json_encode(array('success' => $success));

    	
    }


    public function addToOrder()
    {
		$deviceId = $this->input->post('deviceId');
		$name     = $this->input->post('name');
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$address  = $this->input->post('address');
		$pin      = $this->input->post('pin');
		$landmark = $this->input->post('landmark');
		$user_id  = $this->input->post('userId');
		$location = $this->input->post('location');

    	//SELECT `user_id`, `name`, `email`, `password`, `address`, `pin`, `landmark`, `created_time`, `created_date` FROM `tb_user` WHERE 1

    	if($user_id=='')
    	{
    		//add user data
	    	$userArray = array('device_id' =>$deviceId,
								'name'=>$name,
								'email'=>$email,
								'password'=>$password,
								'address'=>$address,
								'pin'=>$pin,
								'landmark'=>$landmark,
								'created_time'=>date('h:i:s'),
								'created_date'=>date('Y-m-d'),
								);

	    	$user_id = $this->common_model->addRecord('tb_user',$userArray);
    	}

    	$cartItem = $this->db->query("SELECT * FROM tb_cart WHERE device_id=".$device_id)->result();

    	$orderAmount = '';
    	$gstAmount = '';
    	$subTotal = '';
    	foreach ($cartItem as $crI) {
    		$orderAmount+=$crI->total_price;
    		$gstAmount+=$crI->gst_amount;
    		$subTotal+=$cfT->amount_w_gst;
    	}


    	$order = $this->db->query("SELECT * FROM tb_order ORDER BY order_id DESC LIMIT 1")->row();

    	$orderId = 'KW'.date('Y/m/d').$order->order_id;

    	//add data to order table
    	$orderArray = array('order_gen_id' =>$orderId,
							'user_id'=>$user_id,
							'order_date'=>date('Y-m-d'),
							'order_time'=>date('h:i:s'),
							'order_amount'=>$orderAmount,
							'gst_amount'=>$gstAmount,
							'sub_total'=>$subTotal,
							'created_time'=>date('h:i:s'),
							'created_date'=>date('Y-m-d'),
							);

    	$order_id = $this->common_model->addRecord('tb_order',$userArray);


    	//SELECT `order_menu_id`, `order_id`, `res_id`, `menu_id`, `quantity`, `price`, `created_date`, `created_time` FROM `tb_order_menu` WHERE 1


    	foreach($cartItem as $item){


    		//add data to order table
	    	$orderMenuArray = array('order_id' =>$order_id,
									'res_id'=>$item->restaurant_id,
									'menu_id'=>$item->menu_id,
									'quantity'=>$item->quantity,
									'price'=>$item->price,
									'created_time'=>date('h:i:s'),
									'created_date'=>date('Y-m-d'),
									);

	    	$order_menu_id = $this->common_model->addRecord('tb_order_menu',$orderMenuArray);


    	}



    	//SELECT `location_id`, `order_id`, `user_id`, `location`, `created_time`, `created_date` FROM `tb_user_location` WHERE 1

    	if($location!='')
    	{
    		$orderLocation = array('order_id' =>$order_id,
									'user_id'=>$location,
									'created_time'=>date('h:i:s'),
									'created_date'=>date('Y-m-d'),
									);

	    	$location_id = $this->common_model->addRecord('tb_user_location',$orderLocation);
    	}


    	$this->db->delete('tb_cart', array('device_id' => $deviceId));


    	header('Access-Control-Allow-Origin: *');
        echo json_encode(array('success' => $success));





    }
	
	
}
