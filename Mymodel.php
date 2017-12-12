<?php
defined('BASEPATH') OR exit('NO direct scripts allowed on this here server, not ever');

class Mymodel extends CI_Model{



	public function __construct(){

		parent::__construct();
		//$this->load_database();
		$this->load->database();

	}
//***********************************************************************************************************////////////////////////////////////*********************************//
																										   	///////////SESSIONS/////////////////
																										   ////////////////////////////////////




//***********************************************************************************************************////////////////////////////////////*********************************//
																										   	///////////SESSIONS/////////////////
																										   ////////////////////////////////////

//********************************************************************************************************////////////////////////////////////***********************************//
																										 ///////////CATEGORIES///////////////
																										////////////////////////////////////
	//creates a table with the given name
	//also adds the name in the categories table	
	public function categoryAdder($category_name){
		$sql = "CREATE TABLE ".$category_name." (category_id int(20) auto_increment primary key not null,
				product_id varchar(200) not null,user_id int(20) not null, created_on timestamp not null)";
        $this->db->query($sql);

        $this->db->set('created_on','NOW()',false);
        $this->db->insert('allcategories',array('cat_name'=>$category_name,'user_id'=>'1'));
        return true;
	}
	//we need to copy all contents of category table to uncategorized
	//remove from allcategories table.
	//drop table
	public function categoryRemover($category_name){
		$query = $this->db->select('*')->from($category_name)->get();
		$res = $query->result();
		foreach ($res as $row) {
			$categoryData = array('product_id'=>$row->product_id,'user_id'=>$row->user_id,'created_on'=>$row->created_on);	
			$this->db->insert('uncategorized',$categoryData);
		}
		$this->db->where('cat_name',$category_name);
		$this->db->delete('allcategories');
		
		$this->load->dbforge();
		$this->dbforge->drop_table($category_name,true);

		return true;
	}
	public function categoryUpdater($old_name,$new_name){
		$this->db->where('cat_name',$old_name);
		$this->db->update('allcategories',array('cat_name'=>$new_name));
		$this->load->dbforge();
		$this->dbforge->rename_table($old_name, $new_name);
		return true;
	}
	public function getCategories(){
		$query = $this->db->select('*')->from('allcategories')->get();
		return $query->result();
	}
	public function findCategory($cat_name){
		$query = $this->db->select('product_id')->from($cat_name)->get();
		if($query->num_rows() > 0){
		
			$productIds = array_column($query->result_array(), 'product_id');
			$this->db->select('*')->from('allproducts');
			$query2 = $this->db->where_in('product_id',$productIds)->get();

			$this->db->select('price')->from('price');
			$query3 = $this->db->where_in('product_id',$productIds)->get();

			$this->db->select('quantity')->from('quantity');
			$query4 = $this->db->where_in('product_id',$productIds)->get();
			
			$arr1 = $query2->result();
			$arr2 = $query3->result();
			$arr3 = $query4->result();
			//echo "arr1  products varDump<br>";
			//var_dump($arr1);
			//echo "arr2 prices varDump<br>";
			//var_dump($arr2);
			//echo "arr3 quantity varDump<br>";
			//var_dump($arr3);
			$all['products'] = $arr1;
			$all['price']=$arr2;
			$all['quantity']=$arr3;
			return $all;

		return $query->result();
		}

	}
	public function uncategorized(){
		$query = $this->db->select('*')->from('uncategorized')->get();
		if($query->num_rows() > 0){
			$result = array_column($query->result_array(), 'product_id');

			$this->db->select('*')->from('allproducts');
			$query2 = $this->db->where_in('product_id',$result)->get();

			$this->db->select('price')->from('price');
			$query3 = $this->db->where_in('product_id',$result)->get();

			$this->db->select('quantity')->from('quantity');
			$query4 = $this->db->where_in('product_id',$result)->get();
			
			$arr1 = $query2->result();
			$arr2 = $query3->result();
			$arr3 = $query4->result();
			//echo "arr1  products varDump<br>";
			//var_dump($arr1);
			//echo "arr2 prices varDump<br>";
			//var_dump($arr2);
			//echo "arr3 quantity varDump<br>";
			//var_dump($arr3);
			$all['products'] = $arr1;
			$all['price']=$arr2;
			$all['quantity']=$arr3;
			return $all;
		}else{
			return $query->result();;
		}
	}
	
	public function getAllProducts(){
		$query = $this->db->select('*')->from('allproducts')->get();
		return $query->result();
	}
	public function getLastProduct(){
		$query = $this->db->query("SELECT * FROM allproducts ORDER BY product_id DESC LIMIT 1");
		$result = $query->result_array();
		return $result;
	}
	public function productAdder($productData,$category){
		//we want to add the product in the main products table, named 'allproducts'
		$this->db->set('created_on','NOW()',false);//sets time to current time
		$this->db->insert('allproducts',$productData);//inserts the product data into the table 'allproducts'

		//we also want to add a record in a category table
		$product_id = $this->getLastProduct();
		$this->db->set('created_on','NOW()',false);
		$categoryData = array('product_id'=>$product_id[0]['product_id'],'user_id'=>$productData['user_id']);	
		$this->db->insert($category,$categoryData);
		return true;
	}
	public function priceAdder($priceData){
		$this->db->set('created_on','NOW()',false);
		$this->db->insert('price',$priceData);
		return true;
	}
	public function priceUpdater($priceData,$product_id){
		$this->db->where('product_id',$product_id);
		$this->db->update('price',$priceData);
		return true;
	}
	public function quantityAdder($quantityData){
		$this->db->set('created_on','NOW()',false);
		$this->db->insert('quantity',$quantityData);
		return true;
	}
	public function quantityUpdater($quantityData,$product_id){
		$this->db->where('product_id',$product_id);
		$this->db->update('quantity',$quantityData);
		return true;
	}
	public function productUpdater($productData,$product_id){

		$this->db->where('product_id',$product_id);
		$this->db->update('allproducts',$productData);
		return true;
	}
	public function categoryManger($currentCategory,$category,$product_id){
		//var_dump($productData);
		$this->db->select('product_id,user_id,created_on');
		$this->db->from($currentCategory);
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		$res = $query->result_array();
		//var_dump($res);

		$this->db->insert($category,array('product_id'=>$res[0]['product_id'],'user_id'=>$res[0]['user_id'],'created_on'=>$res[0]['created_on']));

		$this->db->where('product_id',$product_id);
		$this->db->delete($currentCategory);
		return true;
	}
	public function productRemover($product_id,$category){
		//first delete products from the allproducts table

		$this->db->where('product_id',$product_id);
		$this->db->delete('allproducts');

		//then delete its entry in the category table its hails from.
		//so a requesting page will have to give the product id and the categoryname
		$this->db->where('product_id',$product_id);
		$this->db->delete($category);
		return true;
	}
	
//********************************************************************************************************////////////////////////////////////***********************************//
																										 ///////////CATEGORIES///////////////
																										////////////////////////////////////

	//*****************************ENDS HERE***********************************//
	//CODE RESPONSIBLE FOR CREATING TABLES FOR OUR CATEGORIES TO GROUP PRODUCTS|



}


?>