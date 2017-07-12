<?php 

class Sub_category_model extends MY_Model {
       public $_table = 'sub_categorys';
       public $belongs_to = array(
                'category' => array(
                        'model'         =>'category_model',
                        'primary_key'   =>'category_id'
                )
        );
        public function get_sub_category($slug = TRUE)
        {
                if ($slug === TRUE)
                {
                        $query = $this->db->get('sub_categorys');
                        return $query->result_array();
                }

                $query = $this->db->get_where('sub_categorys', array('id' => $id));
                return $query->row_array();
        }
}