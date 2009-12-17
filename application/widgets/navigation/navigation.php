<?php
/*
 * @name 	Navigation Widget
 * @author 	Yorick Peterse
 * @link	http://www.yorickpeterse.com/
 * @package PyroCMS
 * @license MIT License
 * 
 * This widget displays a list of links
 */
class Navigation extends Widgets {
	
	
	// Run function
	function run($__widget)
	{
		// Get the title for the widget (as defined by the user) and the link group slug
		$data['title'] 	= $this->get_data($__widget,'title');
		$group_name	   	= $this->get_data($__widget,'group');
		
		// Get the ID that belongs to the group's slug
		$this->CI->db->select('id');
		$query = $this->CI->db->get_where('navigation_groups',array('abbrev' => $group_name));
		
		// Only get the group ID if there are any groups for the given name. Else return false
		if($query->num_rows() > 0)
		{
			// Store the results, as a clean array 
			$results = $query->result_array();
			
			// Loop through "each" row (it's a single one actually)
			foreach($results as $row)
			{
				$group_id = $row['id'];
			}
		
			// Get the actual links using the navigation model
			$this->CI->load->module_model('navigation','navigation_m');
			$data['links'] = $this->CI->navigation_m->getLinks(array('group' => $group_id));
		}
		else
		{
			$data['links'] = false;
		}		
		
		// Load the view file
		$this->display($__widget,'navigation_view',$data);
	}
}
?>
