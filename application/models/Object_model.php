<?php 

class Object_model extends MY_Model {
    public $_table = 'objects';
    public $belongs_to = array(
            'sub_category' => array(
                    'model'         =>'sub_category_model',
                    'primary_key'   =>'sub_category_id'
            ),
            'location' => array(
                    'model'         =>'location_model',
                    'primary_key'   =>'expected_location_id'
            ),
            'user'      => array(
                    'model'         =>'usr_model',
                    'primary_key'   =>'user_id'
            )
    );
	public function get_object($slug = TRUE)
	{
        if ($slug === TRUE)
        {
                $query = $this->db->get('objects');
  //              $preserve = array_reverse($query, true);
                return $preserve->result_array();
        }
        $query = $this->db->get_where('objects', array('id' => $id));
        //$preserve = array_reverse($query, true);
        return $preserve->row_array();
	}

}