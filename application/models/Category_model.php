<?php 

class Category_model extends MY_Model {
       public $_table = 'categorys';
        public function get_category($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get('categorys');
                        return $query->result_array();
                }

                $query = $this->db->get_where('categorys', array('id' => $id));
                return $query->row_array();
        }
}