<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ajax extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->library('session');
		$this->load->model(array('user_model','search_model','serial_model','product_model'));
		$this->load->library('form_validation');
		$this->load->model('comman_model');
		$this->load->model('product_model');
		$this->load->library("pagination");
		$this->load->helper('date');
		$this->load->helper('av_helper');
	}

	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		
    }
	
	function autosuggest_searchpartnumber($Search="")
	{
	
		$term = $Search;
		$term=htmlspecialchars($term); 
		$searchresarr=array();
		if($term!="")
		{
			$products = $this->comman_model->query_result("SELECT kgt_ref_number,fmsi_ref_number,knect,filtron,purflux,mann,mecafilter,oem_part_number,fleet,baldwin,wva,others FROM tbl_products WHERE kgt_ref_number like '$term%' OR fmsi_ref_number like '$term%' OR knect like '$term%' OR filtron like '$term%' OR purflux like '$term%' OR mann like '$term%' OR mecafilter like '$term%' OR oem_part_number like '$term%' OR fleet like '$term%' OR baldwin like '$term%'  OR wva like '$term%' OR others like '$term%' ");
			//echo "SELECT oem_part_number FROM tbl_products WHERE oem_part_number like '%$term%'";
			
			$term = strtolower($term);
			foreach($products as $product)
			{
				if(strpos(strtolower($product['kgt_ref_number']),$term)===0)
				{
					$searchresarrelem['display']=$product['kgt_ref_number'];
					$searchresarrelem['title']='KGT Ref Number';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;				
				}
				if(strpos(strtolower($product['fmsi_ref_number']),$term)===0)
				{
					$searchresarrelem['display']=$product['fmsi_ref_number'];
					$searchresarrelem['title']='FMSI Ref';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['knect']),$term)===0)
				{
					$searchresarrelem['display']=$product['knect'];
					$searchresarrelem['title']='KNECT';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['filtron']),$term)===0)
				{
					$searchresarrelem['display']=$product['filtron'];
					$searchresarrelem['title']='Filtron';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['purflux']),$term)===0)
				{
					$searchresarrelem['display']=$product['purflux'];
					$searchresarrelem['title']='Purflux';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['mann']),$term)===0)
				{
					$searchresarrelem['display']=$product['mann'];
					$searchresarrelem['title']='MANN';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['mecafilter']),$term)===0)
				{
					$searchresarrelem['display']=$product['mecafilter'];
					$searchresarrelem['title']='Mecafilter';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['oem_part_number']),$term)===0)
				{
					$searchresarrelem['display']=$product['oem_part_number'];
					$searchresarrelem['title']='OEM Part Number';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['fleet']),$term)===0)
				{
					$searchresarrelem['display']=$product['fleet'];
					$searchresarrelem['title']='Fleetguard';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['baldwin']),$term)===0)
				{
					$searchresarrelem['display']=$product['baldwin'];
					$searchresarrelem['title']='Baldwin';
					$searchresarrelem['value']=$product['kgt_ref_number'];
					$searchresarr[]=$searchresarrelem;							
				}
				if(strpos(strtolower($product['wva']),$term)===0)
				{
					$searchresarrelem['display']=$product['wva'];
					$searchresarrelem['title']='WVA';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}
				if(strpos(strtolower($product['others']),$term)===0)
				{
					$searchresarrelem['display']=$product['others'];
					$searchresarrelem['title']='Others';
					$searchresarrelem['value']=$product['kgt_ref_number'];	
					$searchresarr[]=$searchresarrelem;						
				}			
			}

			
			
		}
		if(!empty($searchresarr))
		{
			usort($searchresarr, "avalphabetialsort");
			foreach($searchresarr as $searchelem)
			{
			
				$searchelem['value']=str_replace('/','_',$searchelem['value']);
				echo '<a href="javascript:void(0);" onClick="testsearch(this);" rel="'.htmlentities($searchelem['value']).'"><li style="border-bottom:1px solid;">'.$searchelem['display'].'-'.$searchelem['title'].'</li></a>';
				
			}
		}
		else
		{

			echo '<a href="javascript:void(0);" class="noresult" onClick="noresultsearch(this);" rel="'.$Search.'"><li style="border-bottom:1px solid;">Part number is not recognized</li></a>';

		}
		
	}
	function product_category_details($id='')//todo
	{
         if(!empty($id)) {
             $product_type = str_replace('_', ' ', $id);
             $category_details = $this->comman_model->get_vehicle_categories($product_type);
         } else {
            $category_details = $this->product_model->get_product_category_by_typeid($id);
         }
		// var_dump($category_details);
		 echo '<select name="vehicle_category_id[]" id="vehicle_category_id" class="form-control selectpicker">';
		 	//echo '<option value="">All</option>';
		 foreach($category_details as $category)
		 {
            if(!empty($id))  {
                echo '<option value="'.$category->id .'">'.$category->category_name .'</option>';
            } else {
                echo '<option value="'.$category['id'].'">'.$category['category_name'].'</option>';
            }

		 } 
		 echo '</select>';
	}
	function product_maker_details($id='')
	{
		//category
		 $category = $this->input->post('category');
         $vehicle_type_ids = array();

         if(strlen($id) < 4 ) {
             $vehicle_type = $this->comman_model->get_vichle_type_by_id($id);
             $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);
             foreach ($vehicle_type_details as $details)
             {

                if (!empty($details))
                    $vehicle_type_ids[] = isset($details->id) ? $details->id : '';
             }
         }else {
             $vehicle_type = str_replace('_', ' ', $id);
             $vehicle_type_details = $this->comman_model->get_vehicle_type_details_by_name($vehicle_type);
            foreach ($vehicle_type_details as $details) {

                if (!empty($details))
                    $vehicle_type_ids[] = isset($details->id) ? $details->id : '';
            }

         }


		 $makers_details = $this->product_model->get_all_makers_by_type($vehicle_type_ids,$category);
		 
		 //var_dump($makers_details);
		 echo '<select name="maker_id[]" id="maker_id" class="form-control selectpicker" >';
		// echo '<option value="">All</option>';
		 foreach($makers_details as $maker)
		 {
		 	echo '<option value="'.$maker['id'].'">'.$maker['maker_name'].'</option>';
		 }
		 echo '</select>';
	}
	function product_model_details($maker_id)
	{
		 //$makers_details = $this->product_model->get_all_model_by_type($type_id,$maker_id);
		// $model_details = $this->comman_model->get_all_data_by_id('tbl_models',array('maker_id'=>$maker_id));
		 $model_details = $this->product_model->get_all_model_by_markers($maker_id);
		 //var_dump($model_details);
		 echo '<select name="model_id[]" id="model_id" class="form-control selectpicker" >';
		// echo '<option value="">All</option>';
		 foreach($model_details as $model)
		 {
		 	echo '<option value="'.$model['id'].'">'.$model['model_name'].'</option>';
		 }
		 echo '</select>';
	}
	 function product_type_details($id='')
	{
        if(!empty($id)) {
            $category_details = $this->product_model->get_product_type_by_typename(array(0 => $id));
        } else {
            $category_details = $this->comman_model->get_product_type_for_menu();
        }
		// var_dump($category_details);
		 echo '<select name="product_type_id[]" id="product_type_id" class="form-control selectpicker">';
		 //	echo '<option value="">All</option>';
		 foreach($category_details as $category)
		 {
		 	if($id=='') {
                echo '<option value="' . strtolower(str_replace(' ', '_', $category->product_type_name)) . '">' . $category->product_type_name . '</option>';
            } else {
                echo '<option value="' . $category['id'] . '">' . $category['product_type_name'] . '</option>';
            }
		 } 
		 echo '</select>';
	}
	function sendenquiry()
	{
		$html1 = '';
		$html1.= '<html><body><div style="border:solid #666"><div style="background-color:#000;color:#FFF;text-align:center;">';
		$html1.= '<h1 style="margin:0px;line-height:70px;font-style:italic">New Product Enquiry </h1></div>';
		$html1.= '<div style="background-color:#FFF;color:#000;"><h3 style="margin-left:20px;line-height:50px;">Dear Admin,</h3>';
		$html1.= '<div style="background-color:#999;color:#FFF;padding:20px">';
		$html1.= 'a new product Inquiry hasbeen received in the website';
		$html1.= '<h2>Requester Information</h2>';
		$html1.= '<table>';
		$html1.= '<tr><td>Name</td><td>'.$_POST['name'].'</td></tr>';
		$html1.= '<tr><td>Part Number</td><td>'.$_POST['enquirypart_number'].'</td></tr>';
		$html1.= '<tr><td>Phone</td><td>'.$_POST['telephone'].'</td></tr>';
		$html1.= '<tr><td>Email</td><td>'.$_POST['email'].'</td></tr>';
		$html1.= '</table>';
		$html1.= '</div><div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px"><p  style="font-size:12px;font-weight:bold">Regards,<br><br>KGT HR Department</p>';
		$html1.= '</div></div></body></html>';
		
		$this->load->library('email');
		$config = array (
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'priority' => '1'
		   );
		$this->email->initialize($config);
		//for admin mail
		$this->email->from($_POST['email'], 'Enquiry');
		//$this->email->to('sushant.goralkar@gmail.com');
		
		$homepage_data = $this->comman_model->search_serial_data('home_page');		
		
		$fromadminemail=$this->config->item('fromemailaddress');
			
		$from=isset($homepage_data[0]['admin_mail'])?$homepage_data[0]['admin_mail']:$fromadminemail;		
		//$this->email->to('riadhmsttl@gmail.com','riadhslimane2012@yahoo.com','procurement@kondarglobal.ca','riadh@kondarglobal.ca');
		$this->email->to($from);

		$this->email->subject("Enquiry");			
		$this->email->message($html1);
		$this->email->send();				
	}
}
