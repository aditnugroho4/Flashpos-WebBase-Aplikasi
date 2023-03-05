<?php

class Short_url_model extends CI_Model {

    function store_long_url()
    {
    	$this->form_validation->set_rules('url', 'URL', 'trim|prep_url|required|min_length[5]|max_length[250]|xss_clean');
    	if($this->form_validation->run())
    	{
    		$this->db->insert('m_tag_link', array('link_url'=>$this->input->post('url')));
    		return str_replace('=','-', base64_encode($this->db->insert_id()));
    	}
    }

    function get_long_url($shorty='')
    {
    	$query=$this->db->get_where('m_tag_link', array('id'=> base64_decode(str_replace('-','=', $shorty))));
    	if($query->num_rows()>0)
    	{
    		foreach ($query->result() as $row)
			{
			    return $row->link_url;
			}
    	}
    	return '/error_404';
    }

}