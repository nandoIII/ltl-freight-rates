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
class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->model('rate_model');
        $this->load->model('item_model');
    }

    public function index() {
        $this->load->view('general/inc/header_view2');
        $this->load->view('home/home_view');
        $this->load->view('general/inc/footer_view');
    }

    public function get($sw = null, $id = null, $order_by = null, $order = null, $start = null, $limit = null) {
        if ($id == null) {
            $id = $this->input->post('id');
        }

        $result = $this->contact_model->get($id, 'date', $order, $start, $limit);
//        $this->output->enable_profiler(TRUE);
        if ($sw) {
            $this->output->set_output(json_encode($result));
            return false;
        }
        return $result;
    }

    public function insert() {

        $this->output->set_content_type('application_json');

//        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[32]');
//        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[4]|max_length[16]');
//        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[customer.email]');
//        $this->form_validation->set_rules('address', 'Address', 'required|min_length[2]|max_length[32]');
//        $this->form_validation->set_rules('city', 'City', 'required|min_length[2]|max_length[32]');
//        $this->form_validation->set_rules('state', 'State', 'required|min_length[2]|max_length[32]');
//        $this->form_validation->set_rules('country', 'Country', 'required|min_length[1]|max_length[32]');
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
//            return false;
//        }

        $rates = json_decode($_REQUEST["rates"]);
        $items = json_decode($_REQUEST["items"]);
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $company = $this->input->post('company');
        $email = $this->input->post('email');
        $origin = $this->input->post('origin');
        $destination = $this->input->post('destination');
        $total_quantity = $this->input->post('total_quantity');
        $total_weight = $this->input->post('total_weight');
        $rate_value = array();
        $item_value = array();


        $contact_id = $this->contact_model->insert(array(
            'name' => $name,
            'phone' => $phone,
            'company' => $company,
            'email' => $email,
            'origin' => $origin,
            'destination' => $destination,
            'total_quantity' => $total_quantity,
            'total_weight' => $total_weight,
            'date' => date("Y-m-d H:i:s")
        ));

        if ($contact_id) {

            // Insert rates in Database

            for ($i = 0; $i < count($rates); $i++) {

                $rate_data = array(
                    'contact_idcontact' => $contact_id,
                    'carrier' => $rates[$i]->carrier,
                    'days' => $rates[$i]->service_days,
                    'total' => $rates[$i]->total
                );
                $rate_value[$i] = $rate_data;
            }

//            print_r($rate_value);
            $this->rate_model->insertBatch($rate_value);

            // Insert items in Database

            for ($i = 0; $i < count($items); $i++) {
                $cont = $i + 1;

//                $total_weight += $items[$i]->weight_unit == 'kg' ? $items[$i]->weight * 2.20462 : $items[$i]->weight;
//                $tbl_items.='<tr>'
//                        . '<td style="width: 5px;text-align: center;">' . $cont . '</td><td>' . $items[$i]->quantity . $items[$i]->quantity_unit . '@ ' . $length . $width . $height . ' cl' . $items[$i]->class . ' ' . $items[$i]->weight . $items[$i]->weight_unit . '</td>'
//                        . '</tr>'
//                        . '<tr>'
//                        . '<td></td>'
//                        . '</tr>';
                $item_data = array(
                    'contact_idcontact' => $contact_id,
                    'quantity' => $items[$i]->quantity,
                    'quantity_unit' => $items[$i]->quantity_unit,
                    'weight' => $items[$i]->weight,
                    'weight_unit' => $items[$i]->weight_unit,
                    'class' => $items[$i]->class,
                    'length' => $items[$i]->length,
                    'width' => $items[$i]->width,
                    'height' => $items[$i]->height,
                );
                $item_value[$i] = $item_data;
            }

            $this->item_model->insertBatch($item_value);

            $param['rates'] = $rates;
            $param['items'] = $items;
            $param['origin'] = $origin;
            $param['destination'] = $destination;
            $param['wq_number'] = $contact_id + 31320;
            $param['total_quantity'] = $total_quantity;
            $param['total_weight'] = $total_weight;
            $param['name'] = $name;
            $param['phone'] = $phone;
            $param['email'] = $email;
            $param['company'] = $company;
            $this->send_mail($param);
            $this->send_contact_mail($param);
            $this->output->set_output(json_encode(array('result' => 1)));
            return false;
        }

        $this->output->set_output(json_encode(array('result' => 0, 'error' => 'Not inserted.')));
    }

    
    /**
     * 
     * Sends email to manager
     * @param type $param
     * @return booleanSend 
     */
    public function send_mail($param = null) {

        $rates = $param['rates'];
        $items = $param['items'];
        $origin = $param['origin'];
        $destination = $param['destination'];
        $wq_number = $param['wq_number'];
        $total_weight = $param['total_weight'];
        $total_quantity = $param['total_quantity'];
        $name = $param['name'];
        $phone = $param['phone'];
        $email = $param['email'];
        $company = $param['company'];
        $id = $param['wq_number'] - 31320;

        $data['origin'] = $origin;
        $data['destination'] = $destination;
        $data['wq_number'] = $wq_number;
        $data['name'] = $name;
        $data['phone'] = $phone;
        $data['email'] = $email;
        $data['company'] = $company;
        $data['total_weight'] = $total_weight;
        $data['total_quantity'] = $total_quantity;
        $data['id'] = $id;

        $tbl_items = '';
        $trebuchet = "'Trebuchet MS'";
        for ($i = 0; $i < count($items); $i++) {
            $cont = $i + 1;
            $tbl_items.='<tr>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->quantity . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->weight . $items[$i]->weight_unit . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->class . '</td>'
                    . '</tr>';
        }

        $quote = '';
        $trebuchet = "'Trebuchet MS'";
        for ($i = 0; $i < count($rates); $i++) {
            $quote.='<tr>'
                    . '<td>&nbsp;</td>'
                    . '<td style="font-family: ' . $trebuchet . ';">' . $rates[$i]->carrier . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" align="center" width=50>' . $rates[$i]->service_days . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" align="right" width =80>$' . $rates[$i]->total . '</td>'
                    . '<td>&nbsp;</td>'
                    . '</tr>';
        }

        $data['items'] = $tbl_items;
        $data['rates'] = $quote;

        $msg = $this->load->view('home/smith_email_view', $data, true);

        $to = "freight@smith-cargo.com";
        $subject = " ADWORDS LTL WQ$wq_number";

        //-------------------------------------------------------------------------------------
//$message.=$discramer;
// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <freight@smith-cargo.com>' . "\r\n";
        $headers .= 'Bcc: willmar@leanstaffing.com, alvarob@leanstaffing.com, hpena@leanstaffing.com' . "\r\n";
//        echo $msg;
        $m = mail($to, $subject, $msg, $headers);

        if ($m) {
            $this->output->set_output(json_encode(array('result' => 1)));
            return false;
        }
        $this->output->set_output(json_encode(array('result' => 0, 'error' => 'Not inserted.')));
    }

    public function get_rate() {
        header('Content-Type: application/xml');

        $origin = $this->input->post('origin');
        $destination = $this->input->post('destination');

//get the items
        $items = json_decode($_REQUEST["items"]);

        $item = '';
        for ($i = 0; $i < count($items); $i++) {
            $sq = $i + 1;
            $item.='<Item sequence="' . $sq . '" freightClass="' . $items[$i]->class . '">';
            $item.='<Weight units="' . $items[$i]->weight_unit . '">' . $items[$i]->weight . '</Weight>';
            $item.='<Quantity units="' . $items[$i]->quantity_unit . '">' . $items[$i]->quantity . '</Quantity>';
            $item.='</Item>';
        }

//if ($request["origin"] == "" || $request["destination"] == "" || $request["pieces"] == "" || $request["weight"] == "" || $request["commodity"] == "" || $request["height"] == "" || $request["width"] == "" || $request["lenght"] == "") {
//    $request["origin"] = "60606";
//    $request["destination"] = "33133";
//    $request["pieces"] = "1";
//    $request["weight"] = "400";
//    $request["commodity"] = "100";
//    $request["lenght"] = "20";
//    $request["width"] = "400";    
//    $request["height"] = "20";
//
//}

        function httpPost($url, $params) {
            $postData = '';
            //create name value pairs seperated by &
            foreach ($params as $k => $v) {
                $postData .= $k . '=' . $v . '&';
            }
            rtrim($postData, '&');

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, count($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $output = curl_exec($ch);

            curl_close($ch);
            return $output;
        }

        $peticion = '<service-request>
  <!--  Consult the WSDocumentation .doc file section 2.1.1 for more details on these values. -->
  <service-id>XMLRating</service-id>
  <!-- Supply a unique request-id to improve traceability & diagnostics -->
  <request-id>20150302-MG-Test-ABC</request-id>
  <data>
    <RateRequest>
      <ReturnAssociatedCarrierPricesheet>true</ReturnAssociatedCarrierPricesheet>
      <!-- RatingLevel: Specify the company level at which the rating will perform. The company is either defined by name or account number. -->
	  <!-- Enterprise  Customer Acct Number:  -->
      <RatingLevel isCompanyAccountNumber="true"/>
      <Constraints>
        <!-- <Carrier name="" scac=""/>  is optional; either name or scac attribute must be set (not both) value if specified   -->		
        <Mode/>
		<ServiceFlags/> 
		<Equipments/>
		<!--  All constraints  are  optional; 
        <ServiceFlags> 
          <ServiceFlag code=""/> 
        </ServiceFlags> 
        <Equipments>
          <Equipment code=""/>
        </Equipments> 
		-->
        <!--  <Contract type="" name=""/> is optional; Type must have value if specified    -->
        <!--  All constraints  are  optional;
		<ContractService/>
        <PaymentTerms/> 
		-->
      </Constraints>
      <Items>
' . $item . '
      </Items>
      <Events>
        <Event sequence="1" type="Pickup" date="12/15/2015 16:20">
          <Location>
            <Zip>' . $origin . '</Zip>
            <Country>USA</Country>
          </Location>
        </Event>
        <Event sequence="2" type="Drop" date="12/19/2015 16:22">
          <Location>
            <Zip>' . $destination . '</Zip>
            <Country>USA</Country>
          </Location>
        </Event>
      </Events>
      <!-- <LinearFeet/> is optional; must have value if specified   -->
      <!-- <RatingCount/> is optional; must have value if specified   -->
      <ReferenceNumbers>
        <ReferenceNumber type=""/>
      </ReferenceNumbers>
      <!-- <MaxPriceSheets/>  is optional; must have value if specified   -->
      <ShowInsurance>false</ShowInsurance>
    </RateRequest>
  </data>
</service-request>';

        $params = array(
            "userid" => "webuser",
            "password" => "us3rw3b",
            "request" => urlencode($peticion)
        );

        $xml = httpPost("https://cargotsi.mercurygate.net/MercuryGate/common/remoteService.jsp", $params);

//echo $peticion;
//print $xml;
        $response = simplexml_load_string($xml);
        print base64_decode($response->data);
    }

    public function send_contact_mail($param = null) {

        if ($param == null) {
            $rates = json_decode($_REQUEST["rates"]);
            $items = json_decode($_REQUEST["items"]);
            $origin = $this->input->post('origin');
            $destination = $this->input->post('destination');
            $wq_number = $this->input->post('id') + 31320;
            $total_weight = $this->input->post('total_weight');
            $total_quantity = $this->input->post('total_quantity');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $company = $this->input->post('company');
            $id = $this->input->post('id');
        } else {
            $rates = $param['rates'];
            $items = $param['items'];
            $origin = $param['origin'];
            $destination = $param['destination'];
            $wq_number = $param['wq_number'];
            $total_weight = $param['total_weight'];
            $total_quantity = $param['total_quantity'];
            $name = $param['name'];
            $phone = $param['phone'];
            $email = $param['email'];
            $company = $param['company'];
            $id = $param['wq_number'] - 31320;
        }

        $data['origin'] = $origin;
        $data['destination'] = $destination;
        $data['wq_number'] = $wq_number;
        $data['name'] = $name;
        $data['phone'] = $phone;
        $data['email'] = $email;
        $data['company'] = $company;
        $data['total_weight'] = $total_weight;
        $data['total_quantity'] = $total_quantity;
        $data['id'] = $id;

        $trebuchet = "'Trebuchet MS'";
        $tbl_items = '';
        for ($i = 0; $i < count($items); $i++) {
            $cont = $i + 1;
            $tbl_items.='<tr>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->quantity . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->weight . $items[$i]->weight_unit . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" width="80" align="center">' . $items[$i]->class . '</td>'
                    . '</tr>';
        }

        $quote = '';
        for ($i = 0; $i < count($rates); $i++) {
            $quote.='<tr>'
                    . '<td>&nbsp;</td>'
                    . '<td style="font-family: ' . $trebuchet . ';">' . $rates[$i]->carrier . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" align="center" width=50>' . $rates[$i]->service_days . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';" align="right" width =80>$' . $rates[$i]->total . '</td>'
                    . '<td style="font-family: ' . $trebuchet . ';">&nbsp;</td>'
                    . '</tr>';
        }

        $data['items'] = $tbl_items;
        $data['rates'] = $quote;

        $msg = $this->load->view('home/customer_email_view', $data, true);

        $to = "$email";
        $subject = " YOUR LTL WQ$wq_number From $origin To $destination";

        //-------------------------------------------------------------------------------------
//$message.=$discramer;
// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <freight@smith-cargo.com>' . "\r\n";

//        echo $msg;
        $m = mail($to, $subject, $msg, $headers);
        if ($m) {
            $this->output->set_output(json_encode(array('result' => 1)));
            return false;
        }
        $this->output->set_output(json_encode(array('result' => 0, 'error' => 'Not inserted.')));
    }

    function get_zipcode($zip, $json_sw = null) {
        $this->load->model('zipcode_model');
        $result = $this->zipcode_model->get_zipcode($zip);
//                $this->output->enable_profiler(TRUE);

        if ($json_sw) {
            $this->output->set_output(json_encode($result));
            return false;
        }
        return $result;
    }

    function book_quote($id) {

        $this->load->model('zipcode_model');

        $contact_list = $this->contact_model->get(array('idcontact' => $id));
        $data['contact'] = $contact_list[0];
        $data['rates'] = $this->rate_model->get(array('contact_idcontact' => $id));
        $data['items'] = $this->item_model->get(array('contact_idcontact' => $id));

        //split origin data from database
        $zip_data = explode("-", $data['contact']['origin']);
        $zip_or = $zip_data[0];

        $origin_list = $this->zipcode_model->get(array('zip' => $zip_or));
        $origin = $origin_list[0];

        $data['or_zipcode'] = $origin['zip'];
        $data['or_city'] = $origin['primary_city'];
        $data['or_state'] = $origin['state'];
        $data['or_country'] = $origin['country'];

        //split destination data from database
        $zip_dest_data = explode("-", $data['contact']['destination']);
        $zip_dt = $zip_dest_data[0];

        $destination_list = $this->zipcode_model->get(array('zip' => $zip_dt));
        $destination = $destination_list[0];

//        $this->output->enable_profiler(TRUE);
        $data['dt_zipcode'] = $destination['zip'];
        $data['dt_city'] = $destination['primary_city'];
        $data['dt_state'] = $destination['state'];
        $data['dt_country'] = $destination['country'];

        $this->load->view('home/booking_quote_view', $data);
        $this->load->view('general/inc/footer_view');
    }

    function update_book() {
        $param['id'] = $this->input->post('id');

        //Shipper
        $param['sh_name'] = $this->input->post('sh_name');
        $param['sh_address'] = $this->input->post('sh_address');
        $param['sh_address2'] = $this->input->post('sh_address2');
        $param['sh_city'] = $this->input->post('sh_city');
        $param['sh_state'] = $this->input->post('sh_state');
        $param['sh_zipcode'] = $this->input->post('sh_zipcode');
        $param['sh_country'] = $this->input->post('sh_country');
        $param['sh_contact'] = $this->input->post('sh_contact');
        $param['sh_phone'] = $this->input->post('sh_phone');
        $param['sh_email'] = $this->input->post('sh_email');

        //consignee
        $param['cs_name'] = $this->input->post('cs_name');
        $param['cs_address'] = $this->input->post('cs_address');
        $param['cs_address2'] = $this->input->post('cs_address2');
        $param['cs_city'] = $this->input->post('cs_city');
        $param['cs_state'] = $this->input->post('cs_state');
        $param['cs_zipcode'] = $this->input->post('cs_zipcode');
        $param['cs_country'] = $this->input->post('cs_country');
        $param['cs_contact'] = $this->input->post('cs_contact');
        $param['cs_phone'] = $this->input->post('cs_phone');
        $param['cs_email'] = $this->input->post('cs_email');

        $param['esp_inst'] = $this->input->post('esp_inst');
        $param['pr_order'] = $this->input->post('pr_order');
        $param['sales_order'] = $this->input->post('sales_order');
        $param['ref_1'] = $this->input->post('ref_1');
        $param['ref_2'] = $this->input->post('ref_2');

        //save item new data
        $items = json_decode($_REQUEST["items_new"]);
        $rate = $this->input->post('rate');

        for ($i = 0; $i < count($items); $i++) {
            $item_data = array(
                'nmfc' => $items[$i]->nmfc,
                'description' => $items[$i]->desc
            );
            $this->item_model->update($item_data, $items[$i]->id);
        }

        //update selected rates

        $rate_data = array('sw' => 1);
        $this->rate_model->update($rate_data, $rate);

        $book_mail = $this->send_book_mail($param);
        if ($book_mail) {
            $this->send_custom_confirmation_mail($param);
        }

//        $this->output->enable_profiler(TRUE);
    }

    function send_book_mail($param) {
        $this->load->library('email');

        $contact_list = $this->contact_model->get(array('idcontact' => $param['id']));
        $data['contact'] = $contact_list[0];
        $data['rates'] = $this->rate_model->get(array('contact_idcontact' => $param['id']));
        $data['items'] = $this->item_model->get(array('contact_idcontact' => $param['id']));

        $data['param'] = $param;

        $msg = $this->load->view('home/book_mail_view', $data, true);

        $this->email->from('freight@smith-cargo.com');
        $this->email->to('freight@smith-cargo.com');
        $this->email->bcc('willmar@leanstaffing.com, alvarob@leanstaffing.com, hpena@leanstaffing.com');

        $wq = $param['id'] + 31320;
        $subject = 'Book shipment WQ' . $wq;

        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->set_mailtype("html");

        if ($this->email->send()) {
            return true;
        }
        return false;
    }

    /**
     * Sends a booking confirmation email
     * @param type $param
     * @return boolean
     */
    function send_custom_confirmation_mail($param) {
        $this->load->library('email');

        $contact_list = $this->contact_model->get(array('idcontact' => $param['id']));
        $data['contact'] = $contact_list[0];
        $data['rates'] = $this->rate_model->get(array('contact_idcontact' => $param['id']));
        $data['items'] = $this->item_model->get(array('contact_idcontact' => $param['id']));

        $data['param'] = $param;

        $msg = $this->load->view('home/customer_confirmation_mail_view', $data, true);

        $this->email->from('freight@smith-cargo.com');
        $this->email->to($data['contact']['email']);

        $wq = $param['id'] + 31320;
        $subject = 'Book shipment confirmation WQ' . $wq;

        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->set_mailtype("html");

        if ($this->email->send()) {
            $this->output->set_output(json_encode(array('result' => 1)));
            return false;
        }
        $this->output->set_output(json_encode(array('result' => 0, 'error' => $this->form_validation->error_array())));
    }

}
