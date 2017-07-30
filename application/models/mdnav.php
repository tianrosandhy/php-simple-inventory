<?php
defined("BASEPATH") or exit();

Class Mdnav extends CI_Model{

	public function show_menus(){
		$sql = query("SELECT * FROM cms_menu WHERE stat = 1");
		$arr = array();
		$n = 0;
		foreach($sql->result_array() as $row){
			$arr[$n]['label'] = $row['label'];
			$arr[$n]['type'] = $row['type'];

			if($row['type'] <> "url"){
				$get = query("SELECT * FROM cms_".$row['type']." WHERE id = ".quote($row['target']));
				$rget = $get->row_array();
				if($row['type'] == "page")
					$arr[$n]['target'] = "<span class='label label-default'>Page : </span> ".$rget['title'];
				if($row['type'] == "category")
					$arr[$n]['target'] = "<span class='label label-default'>Category : </span> ".$rget['name'];
			}
			else
				$arr[$n]['target'] = $row['url'];
		
			$arr[$n]['parent_of'] = $row['parent_of'];
			$n++;
		}

		return $arr;
	}
	
}