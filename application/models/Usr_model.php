<?php 

class Usr_model extends MY_Model {
       public $_table = 'users';
        public function get_abc($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get('users');
                        return $query->result_array();
                }

                $query = $this->db->get_where('users', array('id' => $id));
                return $query->row_array();
        }
}