<?php
class M_coa extends CI_Model{

	public function get_group(){
		$data = $this->db->query("SELECT * FROM group_coa WHERE 1");
		return $data->result();
	}

	public function add_group($data,$table){
		$this->db->insert($table,$data);
	}

	public function edit_group($group_id){
		$data = $this->db->query("select * from group_coa where group_id = ".$group_id." ");
		return $data->result();
	}

	public function save_edit($group_id, $name){
		$data = $this->db->query(" update group_coa set 
				name = '".$name."' 
				where group_id = ".$group_id.";
				");
	}

	public function get_subgroup(){
		$data = $this->db->query("select subgroup.subgroup_id, subgroup.name_sg, group_coa.name
									from subgroup
									join group_coa
									on group_coa.group_id = subgroup.kelompok");
		return $data->result();
	}

	public function add_subgroup($data,$table){
		$this->db->insert($table, $data);

	}

	public function edit_subgroup($subgroup_id){
		$data = $this->db->query("select * from subgroup where subgroup_id = ".$subgroup_id." ");
		return $data->result();
	}

	public function save_edit_subgroup($subgroup_id, $name_sg, $kelompok){
		$data = $this->db->query(" update subgroup
			set name_sg = '".$name_sg."' ,
			kelompok = '".$kelompok."'
			where subgroup_id = '".$subgroup_id."'
			");
	}

	public function add_coa($data,$table){
		$this->db->insert($table, $data);

	}

	public function get_coa(){
		$data = $this->db->query("select * from coa ");
		return $data->result();
	}

	public function get_data_edit($id){
		$data= $this->db->query("select * from coa where id = '".$id."'");
		return $data->result();
	}

	public function save_edit_coa($coa_id,$name_coa,$date,$subgroup,$debit,$credit, $cashflow, $header,$active, $id){
		$data = $this->db->query(" update coa set name_coa = '".$name_coa."' , date = '".$date."' , subgroup = '".$subgroup."' , debit = '".$debit."' , credit = '".$credit."' ,cashflow = '".$cashflow."', header = '".$header."' ,active = '".$active."', coa_id = '".$coa_id."' WHERE id = '".$id."' ");
	}

	
	  public function view(){
	    return $this->db->get('coa')->result(); // Tampilkan semua data yang ada di tabel siswa
	  }

}
?>