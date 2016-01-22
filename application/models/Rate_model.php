<?php

/**
 * Description of user_model
 *
 * @author Hernando Peña <hpena@leanstaffing.com>
 */
class rate_model extends CRUD_model {
    
    protected $_table = 'rate';
    protected $_primary_key = 'idrate';    

    public function __construct() {
        parent::__construct();
    }
    
    

}
