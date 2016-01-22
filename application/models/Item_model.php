<?php

/**
 * Description of user_model
 *
 * @author Hernando Peña <hpena@leanstaffing.com>
 */
class item_model extends CRUD_model {
    
    protected $_table = 'item';
    protected $_primary_key = 'iditem';    

    public function __construct() {
        parent::__construct();
    }
    
    

}
