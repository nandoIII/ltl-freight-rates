<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rate
 *
 * @author Hernando P
 */
class rate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('rate_model');
        $this->load->model('item_model');
    }

    public function get($id) {

        $contact = $this->contact_model->get(array('idcontact' => $id));
        $param['contact'] = $contact[0];
        $param['rates'] = $this->rate_model->get(array('contact_idcontact' => $id));
        $param['items'] = $this->item_model->get(array('contact_idcontact' => $id));
        $this->show_rate($param);
    }

    public function show_rate($param) {

        $rates = $param['rates'];
        $items = $param['items'];
        $origin = $param['contact']['origin'];
        $destination = $param['contact']['destination'];
        $wq_number = $param['contact']['idcontact'] + 31230;
        $total_weight = $param['contact']['total_weight'];
        $total_quantity = $param['contact']['total_quantity'];
        $id = $param['contact']['idcontact'];
//        print_r($rates);


        $data['origin'] = $origin;
        $data['destination'] = $destination;
        $data['wq_number'] = $wq_number;
        $data['total_weight'] = $total_weight.'lbs';
        $data['total_quantity'] = $total_quantity;
        $data['id'] = $id;

        $trebuchet = "'Trebuchet MS'";
        $tbl_items = '';
        for ($i = 0; $i < count($items); $i++) {
            $cont = $i + 1;
            $tbl_items.='<tr>'
                    . '<td style="font-family: ' . $trebuchet . ';text-align: center;">' . $items[$i]['quantity'] . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';text-align: center;">' . $items[$i]['weight'] . $items[$i]['weight_unit'] . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';text-align: center;">' . $items[$i]['class'] . '</td>'
                    . '</tr>';
        }

        $quote = '';
        for ($i = 0; $i < count($rates); $i++) {
            $quote.='<tr>'
                    . '<td>&nbsp;</td>'
                    . '<td style="font-family: ' . $trebuchet . ';width: 5px;text-align: center;">' . $rates[$i]['carrier'] . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';width: 50px;text-align: center;">' . $rates[$i]['days'] . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';width: 80px;text-align: right;">$' . $rates[$i]['total'] . '</td>'
                    . '<td>&nbsp;</td>'
                    . '</tr>';
        }


        $data['items'] = $tbl_items;
        $data['rates'] = $quote;

        $msg = $this->load->view('home/customer_email_view', $data, true);

        echo $msg;
    }

}
