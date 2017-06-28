<?php 

class Transaction_model extends MY_Model {
    public $_table = 'transactions';
    public $belongs_to = array(
            'user_1' => array(
                    'model'         =>'usr_model',
                    'primary_key'   =>'user_id_1'
            ),
            'user_2' => array(
                    'model'         =>'usr_model',
                    'primary_key'   =>'user_id_2'
            ),
            'object_1' => array(
                    'model'         =>'object_model',
                    'primary_key'   =>'object_id_1'
            ),
            'object_2'      => array(
                    'model'         =>'object_model',
                    'primary_key'   =>'object_id_2'
            ),
            'location' => array(
                    'model'         =>'location_model',
                    'primary_key'   =>'expected_location_id'
            ),
    );
	public function get_transaction($slug = TRUE)
	{
        if ($slug === TRUE)
        {
                $query = $this->db->get('transactions');
  //              $preserve = array_reverse($query, true);
                return $preserve->result_array();
        }
        $query = $this->db->get_where('transactions', array('id' => $id));
        //$preserve = array_reverse($query, true);
        return $preserve->row_array();
	}

}