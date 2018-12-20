<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khabarwala_api extends CI_Controller {

   public function __construct() 
   {
		parent::__construct();
		$this->load->helper(array('url','form','html','text'));
		$this->load->library(array('session','form_validation','pagination','email'));
		$this->load->model(array('common_model'));
		$this->load->model(array('Common_mdl'));
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

		}
		

        $allRes[] = array("restaurents"=>$restaurents,"allCuisines"=>$allCuisines,"ratting"=>round($finalRate,1));

        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));
    }
    public function getResLazyLoad()
    {
    	$limit = 5;
    	$offset = $this->input->post('restaurentCount');
    	$restaurents = $this->db->query("SELECT * FROM tb_restaurant LIMIT ".$limit." OFFSET ".$offset)->result();
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
			}
            $allRes[] = array("res"=>$res,"menu"=>rtrim($strMenu,','),"ratting"=>round($finalRate,1));
        }
        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));
    }	
	function ticker()
	{
		$tickerDetails = $this->db->query("select * from tb_ticker where published=1")->result();
		header('Access-Control-Allow-Origin: *');
        echo json_encode(array('tickerDetails' => $tickerDetails));	
	}
	function add_cart()
	{
		$restaurant = $this->input->post('restaurant');
		$menu = $this->input->post('menu');
		$qty = $this->input->post('qty');
		$deviceId = $this->input->post('deviceId');
		
		$menuDetail = $this->db->query("select * from tb_menu where menu_id='$menu'")->row();
		$res_id = $menuDetail->res_id;
		
		$restaurantDetail = $this->db->query("select * from tb_restaurant where res_id='$res_id'")->row();		
		$res_gst = $restaurantDetail->gst_amount;
		
		$total_price = ($menuDetail->menu_price*$qty); //200
		$gst_amount = ($total_price*$res_gst)/100; //10
		$amount_w_gst = $total_price+$gst_amount;
		
		$cartCheck = $this->db->query("select * from tb_cart where device_id='$deviceId' and restaurant_id='$restaurant' and menu_id='$menu'")->row();
		
		if($cartCheck)
		{
			$cart_id = $cartCheck->cart_id;
			if($qty>0)
			{
				
				$fields = array(
					'quantity' => $qty,
					'price' => $menuDetail->menu_price,
					'total_price' => $total_price,
					'gst_amount' => $gst_amount,
					'amount_w_gst' => $amount_w_gst,
					'created_time' => date('h:i a'),
					'created_date' => date('Y-m-d')
					);
				$table['name'] = 'tb_cart';
				$data = $this->Common_mdl->save_data($table,$fields,$cart_id,'cart_id');
			}
			else
			{
				$table['name'] = 'tb_cart';
				$this->Common_mdl->delete_data($table,$cart_id,'cart_id');
			}			
		}
		else
		{
			$fields = array(
				'device_id' => $deviceId,
				'restaurant_id' => $restaurant,
				'menu_id' => $menu,
				'quantity' => $qty,
				'price' => $menuDetail->menu_price,
				'total_price' => $total_price,
				'gst_amount' => $gst_amount,
				'amount_w_gst' => $amount_w_gst,
				'created_time' => date('h:i a'),
				'created_date' => date('Y-m-d')
				);
			$table['name'] = 'tb_cart';
			$data = $this->Common_mdl->save_data($table,$fields,'','cart_id');
		}
		
		$cartCount = $this->db->query("select * from tb_cart where device_id='$deviceId'")->num_rows();
		header('Access-Control-Allow-Origin: *');
        echo json_encode(array('success' => 1,'cartCount'=>$cartCount));
	}
}