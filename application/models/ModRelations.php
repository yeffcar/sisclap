<?php 
class ModRelations extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function set_relation($data)
	{
		if (!$data) {
			return false;
		}
		$date = new DateTime();
		$data['date'] = $date->format('Y-m-d H:i:s');
		return $this->db->insert('relations', $data);	
	}
	
	public function get_relation($data = 'all', $limit = '', $order = array('id','DESC'))
	{
		$this->db->join('user', 'relations.id_user=user.id');
		$this->db->select('relations.*, user.username, user.usergroup');
		$this->db->limit($limit);
		if ($order!=='') {
			$this->db->order_by($order[0], $order[1]);
		}
		if ($data === 'all') {
			$query = $this->db->get('relations');
			if ($query->num_rows() > 0)
			{
			   return $query->result_array();
			}
			return false;
		}else{
			$this->db->where($data);
			$query = $this->db->get('relations');
			if ($query->num_rows() > 0){

				return $query->result_array();
			}
			return false;
		}
	return false;
	}

	public function delete_relation($where)
	{
		if (!$where) {
			return false;
		}
		$this->db->where($where);
		return $this->db->delete('relations');
	}
}
?>