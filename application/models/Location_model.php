<?php 

class Location_model extends MY_Model {
       public $_table = 'locations';
        public function get_sub_category($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get('locations');
                        return $query->result_array();
                }

                $query = $this->db->get_where('locations', array('id' => $id));
                return $query->row_array();
        }
}