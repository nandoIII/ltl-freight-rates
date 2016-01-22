<?php

/**
 * Description of user_model
 *
 * @author Hernando Peña <hpena@leanstaffing.com>
 */
class contact_model extends CRUD_model {

    protected $_table = 'contact';
    protected $_primary_key = 'idcontact';

    public function __construct() {
        parent::__construct();
    }

    public function get_search($where = null, $order_by = null, $order = null, $start = null, $limit = null) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('rate', 'contact.idcontact = rate.contact_idcontact');
        $this->db->join('item', 'contact.idcontact = item.iditem');

        if (is_numeric($where)) {
            $q = $this->db->where($this->_primary_key, $where);
        }

        if (is_array($where)) {
            $this->db->group_start();
            foreach ($where as $key => $value) {
                if ($key == 'load_number' || $key == 'load_number') {
                    $this->db->or_where($key, $value);
                } else {
                    $this->db->or_like($key, $value);
                }
            }
            $this->db->group_end();
        }

        if ($order_by && $order) {
            $this->db->order_by($order_by, $order);
        }

        if ($limit && $start) {
            $this->db->limit($limit, $start);
        }

        $q = $this->db->get();
        return $q->result_array();
    }

}
