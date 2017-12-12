<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
//***********************************************************************************************************////////////////////////////////////*********************************//
																										   	///////////SESSIONS/////////////////
																										   ////////////////////////////////////
	public function __construct(){
		parent:: __construct();
		$this->load->helper('form');
	}
	public function index(){
		//set session data
	}
//***********************************************************************************************************////////////////////////////////////*********************************//
																										   	///////////SESSIONS/////////////////
																										   ////////////////////////////////////
//********************************************************************************************************////////////////////////////////////***********************************//
																										 ///////////CATEGORIES///////////////
																										////////////////////////////////////
	//creates a table with the given name
	//also adds the name in the categories table
	public function categoryAdder(){//creates 
		$categoryName = $this->input->post('category_name');
		if($categoryName == ""){
			redirect(base_url()."index.php/mycontroller/categories");
		}else{
			$this->load->model('mymodel');
			$status = $this->mymodel->categoryAdder($categoryName);
			if($status == true){
				redirect(base_url()."index.php/mycontroller/categories");
			}
		}
	}
	public function categoryRemover(){
		$category_name = $this->input->post('category_name');
		$this->load->model('mymodel');
		$results = $this->mymodel->categoryRemover($category_name);
		if($results == true){
			redirect(base_url().'index.php/mycontroller/categories');
		}
	}
	public function categoryUpdater(){
		echo 'controller is working';
		$old_name = $this->input->post('old_name');
		$new_name = $this->input->post('new_name');		
		$this->load->model('mymodel');
		$results = $this->mymodel->categoryUpdater($old_name,$new_name);
		if($results){
			redirect(base_url().'index.php/mycontroller/categories');
		}
	}
	//fetches all categories and returns contents to caller
	//generic for use whenever needed
	public function getCategories(){
		$this->load->model('mymodel');
		$data['categories'] = $this->mymodel->getCategories();
		return $data;
	}

	public function categories(){
	//loads the view 'categories'
	//passes an array returned by 'getCategories' method
		$this->load->view('categories',$this->getCategories());
	}
	public function category(){
		$cat_name = $this->uri->segment(3);
		$this->load->model('mymodel');
		$data['thisCategory'] = $this->mymodel->findCategory($cat_name);
		$bigData = array_merge($data,$this->getCategories(),array('thisCategoryName'=>$cat_name));
		$this->load->view('category',$bigData);
	}
	public function products(){
		$this->load->model("mymodel");
		$data['allproducts'] = $this->mymodel->getAllProducts();
		$data['categories'] = $this->mymodel->getCategories();
		//$bigData = array_merge($data,$this->mymodel->getCategories());
		$this->load->view('products',$data);
	}
	public function uncategorized(){
		$this->load->model("mymodel");
		$data['uncategorized']=$this->mymodel->uncategorized();
		$data['categories']=$this->mymodel->getCategories();
		//var_dump($data['categories']);
		$this->load->view('uncategorized',$data);
	}
	
	public function productAdder(){
		$prod_name = $this->input->post('prod_name');
		$prod_desc = $this->input->post('prod_desc');
		$filename = $this->input->post('file_name');
		$price = $this->input->post('prod_price');
		$quantity = $this->input->post('quantity');
		$category = $this->input->post('category');
		$currentCategory = $this->input->post('currentCategory');
		$origin =  $this->input->post('origin');
		$user_id = 1;// USER ID FOR NOW!\
		//echo "category =".$current_category;
		if($prod_name == "" && $price == "" && $quantity == "" && $prod_desc == "" && $filename == ""){
			redirect(base_url().'index.php/mycontroller/'.$origin);
		}else{
			$productData = array('product_name'=>$prod_name,'product_description'=>$prod_desc,'filename'=>$filename,'user_id'=>$user_id);
			$this->load->model('mymodel');
				//if($category == "0"){
					//$this->mymodel->productAdder($productData,$currentCategory);
				//}else{
			$this->mymodel->productAdder($productData,$category);
				//}
		}
		if($price != ""){
			$this->load->model('mymodel');
			$product_id = $this->mymodel->getLastProduct();
			$priceData = array('price'=>$price,'product_id'=>$product_id[0]['product_id'],'user_id'=>$user_id);
			$this->mymodel->priceAdder($priceData);
		}
		if($quantity != ""){			
			$this->load->model('mymodel');
			$product_id = $this->mymodel->getLastProduct();
			$quantityData = array('quantity'=>$quantity,'product_id'=>$product_id[0]['product_id'],'user_id'=>$user_id);
			$this->mymodel->quantityAdder($quantityData);
		}
		redirect(base_url().'index.php/mycontroller/'.$origin);
	}
	public function productUpdater(){
		$product_name = $this->input->post('prod_name');
		$price = $this->input->post('prod_price');
		$quantity = $this->input->post('quantity');
		$category = $this->input->post('category');
		$prod_desc = $this->input->post('prod_desc');
		$product_id = $this->input->post('product_id');
		$origin =  $this->input->post('origin');
		$currentCategory = $this->input->post('currentCategory');
		$user_id = 1;// USER ID FOR NOW!
		if($product_name == "" && $prod_desc == ""){
			redirect(base_url().'index.php/mycontroller/'.$origin);
		}else{
			$productData = array('product_name'=>$product_name,'product_description'=>$prod_desc,'user_id'=>$user_id);
			$this->load->model('mymodel');
				//if($category != "0" || $category != $currentCategory){
					$this->mymodel->categoryManger($currentCategory,$category,$product_id);
				//}else{
					//$this->mymodel->categoryManger($currentCategory,$category,$product_id);
				//}
			$this->mymodel->productUpdater($productData,$product_id);
		}
		if($price != ""){
			$this->load->model('mymodel');
			$priceData = array('price'=>$price);
			$this->mymodel->priceUpdater($priceData,$product_id);
		}
		if($quantity != ""){			
			$this->load->model('mymodel');
			$quantityData = array('quantity'=>$quantity);
			$this->mymodel->quantityUpdater($quantityData,$product_id);
		}
			redirect(base_url().'index.php/mycontroller/'.$origin);
	}
	public function productRemover(){
		$product_id = $this->input->post('product_id');
		$category = $this->input->post('currentCategory');
		$origin = $this->input->post('origin');
		$this->load->model('mymodel');
		$results = $this->mymodel->productRemover($product_id,$category);
		if($results){
			redirect(base_url().'index.php/mycontroller/'.$origin);
		}
	}
	
//********************************************************************************************************////////////////////////////////////***********************************//
																										 ///////////CATEGORIES///////////////
																										////////////////////////////////////	

	//ALL UPLOADING CODE **ends here***

}
