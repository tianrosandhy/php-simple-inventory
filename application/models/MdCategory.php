<?php
defined("BASEPATH") or exit();

Class MdCategory extends CI_Model{

	public function __construct(){
		parent::__construct();

		//default_category list
		$this->tb_content = array();
		$this->tb_structure = array(
			array(
				"field" => "#",
				"show" => 0,
				"type" => "text",
				"attr" => ""
			),
			array(
				"field" => "name",
				"show" => 1,
				"type" => "text",
				"class" => "slug-toggle"
			),
			array(
				"field" => "slug",
				"show" => 1,
				"type" => "text",
				"attr" => "",
				"class" => "slug-target"
			),

			array(
				"field" => "description",
				"show" => 1,
				"type" => "textarea",
				"attr" => ""
			),

			array(
				"field" => "Status",
				"show" => 0,
				"type" => "text",
				"attr" => ""
			),

			array(
				"field" => "",
				"show" => 0
			)

		);
	}


	public function show_query($current_page=1, $addQuery="", $limit=0, $order_by="id", $ord="DESC"){

		//manage default value
		if($limit == 0)
			$limit = get_setting("backend_paging");

		$offset = ($current_page - 1) * $limit;

		$sql = "SELECT * FROM cms_category WHERE stat <= 1 $addQuery ORDER BY $order_by $ord";

		$run = query($sql);
		if($run->num_rows() > 0){
			$return = array();
			$no = 0;
			foreach($run->result_array() as $row){

				if($row['stat'] == 0){
					$hd = "
						<a href='backend/page/show/$row[id]/category' class='show-button btn btn-sm btn-success'><span class='fa fa-eye'></span> Show</a> ";
				}
				else{
					$hd = "
						<a href='backend/page/hide/$row[id]/category' class='hide-button btn btn-sm btn-warning'><span class='fa fa-eye-slash'></span> Hide</a> ";
				}

				if($row['stat'] == 1){
					$stt = "Active";
				}
				else
					$stt = "Hidden";


				$return[$no] = array(
					"#" 
						=> $no+1,
					"title" 
						=> $row['name'],
					"slug"
						=> $row['slug'],
					"description" 
						=> cut_text($row['description']),
					"stat" 
						=> $stt,
					"action" 
						=> "

						<a href='backend/page/category_edit/$row[id]' class='btn btn-sm btn-info'><span class='fa fa-pencil'></span> Update</a> 
						$hd
						<a href='backend/page/delete/$row[id]/category' class='delete-button btn btn-sm btn-danger'><span class='fa fa-trash'></span> Delete</a> "
				);
				$no++;
			}

			$this->tb_content = $return;
		}

	}


	public function cek_exists($title, $slug, $except=null){
		$addQ = "";
		if(strlen($except)>0)
			$addQ = "AND id <> ".intval($except);

		$sql = query("SELECT id FROM cms_category WHERE (name = ".quote($title)." OR slug = ".quote($slug).") $addQ AND stat <> 9");
		if($sql->num_rows() > 0)
			return false;
		return true;
	}


	public function post_process($post, $type="add", $id=null){
		$tgl = date("Y-m-d H:i:s");
		$desc = htmlentities($post['description']);
		$show = 0;
		if(isset($post['show']))
			$show = 1;


		$data = array(
			"id" => null,
			"name" => $post['name'],
			"slug" => $post['slug'],
			"description" => $desc,
			"stat" => $show
		);

		if($type=="add")
			$this->db->insert("cms_category",$data);
		else if($type=="edit"){
			unset($data['id']);
			$this->db->update("cms_category",$data, array("id"=>$id));
		}
		return true;
	}

}