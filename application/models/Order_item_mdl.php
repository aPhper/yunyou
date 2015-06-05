<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Order_item_mdl extends CI_Model {
	const TABLE='user_order_item';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//create_order_item
//remove_order_item
//get_order_item
//get_order_item_list
