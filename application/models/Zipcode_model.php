<?php

/**
 * Description of user_model
 *
 * @author Hernando Peña <hpena@leanstaffing.com>
 */
class zipcode_model extends CRUD_model {

    protected $_table = 'zipcode';
    protected $_primary_key = 'idzipcode';

    public function __construct() {
        parent::__construct();
    }

    public function get_zipcode($zip) {
        $this->db->select('*');
        $this->db->from($this->_table);

        $this->db->like('zip', $zip, 'after');
//        $this->db->order_by(, $order);


        $q = $this->db->get();
        return $q->result_array();
    }

}
