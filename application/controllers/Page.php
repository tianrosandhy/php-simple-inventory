<?php
defined("BASEPATH") or exit();

Class Page extends CI_Controller{

	public function index(){
		$curr = shortcode_login();
		$data['title'] = "Show Page";
		$data['menu'] = 2;
		$data['submenu'] = 22;
		$data['curr'] = $curr;
		$data['addURL'] = "page/add";

		$this->load->model("mdpage");

		if(!isset($_GET['page']))
			$page = 1;
		else
			$page = intval($_GET['page']);

		$this->mdpage->show_query($page);
		$data['structure'] = $this->mdpage->tb_structure;
		$data['content'] = $this->mdpage->tb_content;

		$this->load->view("header",$data);
		$this->load->view("page");
		$this->load->view("footer");
	}

	public function add(){
		$curr = shortcode_login();
		$data['title'] = "Add New Page";
		$data['menu'] = 2;
		$data['submenu'] = 21;
		$data['curr'] = $curr;
		$data['post_type'] = "add";

		register_header("<link rel='stylesheet' href='css/chosen.min.css'>");
		register_footer("<script src=\"js/ckeditor/ckeditor.js\"></script>");
		register_footer("<script src=\"js/chosen.jquery.min.js\"></script>");

		$data['action'] = "page/addproses";
		$this->load->model("mdpage");
		$data['structure'] = $this->mdpage->tb_structure;

		$this->load->view("header",$data);
		$this->load->view("add");
		$this->load->view("footer");
	}

	public function addproses(){
		$curr = shortcode_login();
		//cek logic standarnya saja
		$this->load->model("mdpage");

		if(isset($_POST['btn'])){
			$file = $_FILES['image'];
			$post = $_POST;
			if(!$this->mdpage->cek_exists($post['title'], $post['slug'])){
				post_session($post, array("title","slug","category","description","content"));
				$this->cms->create_alert("error","Data post dengan judul / slug tersebut sudah ada. Mohon gunakan data lain","page/add");
			}
			else{
				if($this->mdpage->post_process($post, $file, "add")){
					$this->cms->create_alert("Success","Berhasil menyimpan data","page");
				}
				else{
					post_session($post, array("title","slug","category","description","content"));
					$this->cms->create_alert("Error","Terdapat kesalahan dalam proses penyimpanan","page/add");
				}
			}
		}
	}


	public function edit($id){
		$curr = shortcode_login();
		$data['title'] = "Edit Page";
		$data['menu'] = 2;
		$data['curr'] = $curr;
		$data['post_type'] = "edit";

		register_header("<link rel='stylesheet' href='css/chosen.min.css'>");
		register_footer("<script src=\"js/ckeditor/ckeditor.js\"></script>");
		register_footer("<script src=\"js/chosen.jquery.min.js\"></script>");


		$this->load->model("mdpage");
		$data['dft'] = $this->cms->get_page("cms_page",$id);
		$data['action'] = "page/editproses/$id";
		$data['structure'] = $this->mdpage->tb_structure;

		$this->load->view("header",$data);
		$this->load->view("add");
		$this->load->view("footer");
	}


	public function editproses($id){
		$curr = shortcode_login();
		//cek logic standarnya saja
		$this->load->model("mdpage");

		if(isset($_POST['btn'])){
			$file = $_FILES['image'];
			$post = $_POST;
			if(!$this->mdpage->cek_exists($post['title'], $post['slug'], $id)){
				post_session($post, array("title","slug","category","description","content"));
				$this->cms->create_alert("error","Data post dengan judul / slug tersebut sudah ada. Mohon gunakan data lain","page/edit/$id");
			}
			else{
				if($this->mdpage->post_process($post, $file, "edit", $id)){
					$this->cms->create_alert("Success","Berhasil mengupdate data","page");
				}
				else{
					post_session($post, array("title","slug","category","description","content"));
					$this->cms->create_alert("Error","Terdapat kesalahan dalam proses penyimpanan","page/edit/$id");
				}
			}
		}
	}



	public function show($id, $type=""){
		$tb = "cms_".$type;
		$url = "page";
		if($type <> "page")
			$url .= "/".$type;

		if($this->cms->toggle_post($tb,$id, 1)){
			$this->cms->create_alert("Success","Berhasil menampilkan data",$url);
		}
		else
			$this->cms->create_alert("Fatal Error","Kesalahan dalam proses update data",$url);
	}

	public function hide($id, $type=""){
		$tb = "cms_".$type;
		$url = "page";
		if($type <> "page")
			$url .= "/".$type;

		$this->load->model("mdpage");
		if($this->cms->toggle_post($tb,$id, 0)){
			$this->cms->create_alert("Success","Berhasil menyembunyikan data",$url);
		}
		else
			$this->cms->create_alert("Fatal Error","Kesalahan dalam proses update data",$url);
	}

	public function delete($id, $type=""){
		$tb = "cms_".$type;
		$url = "page";
		if($type <> "page")
			$url .= "/".$type;

		$this->load->model("mdpage");
		if($this->cms->toggle_post($tb,$id, 9)){
			$this->cms->create_alert("Success","Berhasil menghapus data",$url);
		}
		else
			$this->cms->create_alert("Fatal Error","Kesalahan dalam proses hapus data",$url);
	}




















	public function category(){
		$curr = shortcode_login();
		$data['title'] = "Page Category";
		$data['menu'] = 2;
		$data['submenu'] = 23;
		$data['curr'] = $curr;
		$data['addURL'] = "page/add_category";

		$this->load->model("mdcategory");
		$this->mdcategory->show_query();

		$data['structure'] = $this->mdcategory->tb_structure;
		$data['content'] = $this->mdcategory->tb_content;

		$this->load->view("header",$data);
		$this->load->view("page");
		$this->load->view("footer");
	}

	public function add_category(){
		$curr = shortcode_login();
		$data['title'] = "Add New Category";
		$data['menu'] = 2;
		$data['submenu'] = 23;
		$data['curr'] = $curr;
		$data['post_type'] = "add";

		register_header("<link rel='stylesheet' href='css/chosen.min.css'>");
		register_footer("<script src=\"js/ckeditor/ckeditor.js\"></script>");
		register_footer("<script src=\"js/chosen.jquery.min.js\"></script>");

		$data['action'] = "page/add_category_proses";
		$this->load->model("mdcategory");
		$data['structure'] = $this->mdcategory->tb_structure;

		$this->load->view("header",$data);
		$this->load->view("add");
		$this->load->view("footer");
	}

	public function add_category_proses(){
		$curr = shortcode_login();
		//cek logic standarnya saja
		$this->load->model("mdcategory");

		if(isset($_POST['btn'])){
			$post = $_POST;
			if(!$this->mdcategory->cek_exists($post['name'], $post['slug'])){
				post_session($post, array("name","slug","description"));
				$this->cms->create_alert("error","Data post dengan judul / slug tersebut sudah ada. Mohon gunakan data lain","page/add_category");
			}
			else{
				if($this->mdcategory->post_process($post, "add")){
					$this->cms->create_alert("Success","Berhasil menyimpan data","page/category");
				}
				else{
					post_session($post, array("name","slug","description"));
					$this->cms->create_alert("Error","Terdapat kesalahan dalam proses penyimpanan","page/add_category");
				}
			}
		}
	}




	public function category_edit($id){
		$curr = shortcode_login();
		$data['title'] = "Edit Category";
		$data['menu'] = 2;
		$data['submenu'] = 23;
		$data['curr'] = $curr;
		$data['post_type'] = "edit";

		register_header("<link rel='stylesheet' href='css/chosen.min.css'>");
		register_footer("<script src=\"js/ckeditor/ckeditor.js\"></script>");
		register_footer("<script src=\"js/chosen.jquery.min.js\"></script>");


		$this->load->model("mdcategory");
		$data['dft'] = $this->cms->get_page("cms_category",$id);
		$data['action'] = "page/edit_category_proses/$id";
		$data['structure'] = $this->mdcategory->tb_structure;

		$this->load->view("header",$data);
		$this->load->view("add");
		$this->load->view("footer");
	}

	public function edit_category_proses($id){
		$curr = shortcode_login();
		//cek logic standarnya saja
		$this->load->model("mdcategory");

		if(isset($_POST['btn'])){
			$post = $_POST;
			if(!$this->mdcategory->cek_exists($post['name'], $post['slug'], $id)){
				post_session($post, array("name","slug","description"));
				$this->cms->create_alert("error","Data post dengan judul / slug tersebut sudah ada. Mohon gunakan data lain","page/category_edit/$id");
			}
			else{
				if($this->mdcategory->post_process($post, "edit", $id)){
					$this->cms->create_alert("Success","Berhasil menyimpan data","page/category");
				}
				else{
					post_session($post, array("name","slug","description"));
					$this->cms->create_alert("Error","Terdapat kesalahan dalam proses penyimpanan","page/category_edit/$id");
				}
			}
		}
	}

}