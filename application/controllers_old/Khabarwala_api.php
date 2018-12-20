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
    	//get all banner
        $banners = $this->db->query("SELECT * FROM tb_banner WHERE published=1")->result();
        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('banners' => $banners));
    }

    public function getRestaurents()
    {

    	//get restaurant
        $restaurents = $this->db->query("SELECT * FROM tb_restaurant WHERE published=1 LIMIT 20" )->result();
        $allRes = array();
        foreach ($restaurents as $res) {

        	//get menus by restaurant
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
			//(5*252 + 4*124 + 3*40 + 2*29 + 1*33) / (252+124+40+29+33) = 4.11
            $ratting = $this->db->query("SELECT DISTINCT(rate) FROM tb_ratting WHERE res_id=".$res->res_id)->result();
            $allCount = '';
            $dividedBy = '';
            foreach($ratting as $key => $rate){
            	$star = $rate->rate;
            	$count = $this->db->query("SELECT * FROM tb_ratting WHERE res_id=".$res->res_id." AND rate='".$rate->rate."'")->num_rows();
            	$allCount+=$star*$count;
            	$dividedBy+=$count;
            }
            $finalRate = ($allCount/$dividedBy);
            $allRes[] = array("res"=>$res,"menu"=>rtrim($strMenu,','),"rate"=>$finalRate);
        }
        header('Access-Control-Allow-Origin: *');
        echo json_encode(array('restaurents' => $allRes));
    }



}
