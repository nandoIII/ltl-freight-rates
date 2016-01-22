<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Hernando Peña <your.name at your.org>
 */
class customer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
    }

//    private function _required_login() {
//        if ($this->session->userdata('user_id') == FALSE) {
//            $this->logout();
//            $this->output->set_output(json_encode(['result' => 0, 'error' => 'You are not authorized']));
//            return false;
//        }
//    }

    public function pass_encoder($pass) {
        echo hash('sha256', $pass . SALT);
    }

    public function index() {
        $this->_required_login();
        $data['class'] = $this->get_class_name();
        $data['user'] = $this->session->userdata('name');
        $data['customers'] = $this->customer_model->get();

        $this->load->view('general/inc/header_view', $data);
        $this->load->view('customer/customer_view');
        $this->load->view('general/inc/footer_view');
    }

    public function add() {
        $this->_required_login();
        $data['class'] = $this->get_class_name();
        $data['user'] = $this->session->userdata('name');
        $this->load->view('general/inc/header_view', $data);
        $this->load->view('customer/register_view');
        $this->load->view('general/inc/footer_view');
    }

    public function read() {
        $data = $this->user_model->read(3);
//        print_r($data);
//       $this->output->enable_profiler(TRUE);
    }

    public function create() {
        $data = array(
            'login' => 'Camilo'
        );
        $result = $this->user_model->create($data);
        print_r($result);
    }

    public function update() {
        $data = array(
            'login' => 'Peggy'
        );
        $result = $this->user_model->update($data, 3);
        print_r($result);
    }

    public function delete() {
        $result = $this->user_model->delete(2);
        print_r($result);
    }

    public function login() {

        $login = $this->input->post('login');
        $password = $this->input->post('password');


        $result = $this->user_model->get([
            'login' => $login,
            'password' => hash('sha256', $password . SALT)
        ]);

        $this->output->set_content_type('application_json');

        if ($result) {
            $this->session->set_userdata(['user_id' => $result[0]['iduser']]);
            $this->session->set_userdata(['name' => $result[0]['name']]);
            $this->session->set_userdata(['login' => $result[0]['login']]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        $this->output->set_output(json_encode(['result' => 0]));
    }

    public function register() {

        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[customer.email]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('city', 'City', 'required|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('state', 'State', 'required|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('country', 'Country', 'required|min_length[1]|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return false;
        }

        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');


        $customer_id = $this->customer_model->insert([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'country' => $country,
        ]);

        if ($customer_id) {
            $this->output->set_output(json_encode(['result' => 1]));
            $param['email'] = $email;
            $this->send_mail($param);
            return false;
        }
        $this->output->set_output(json_encode(['result' => 0, 'error' => 'User not created.']));
    }

    public function get($id = null) {
        $this->_required_login();

        if ($id != null) {
            $result = $this->user_model->get([
                'iduser' => $id
            ]);
        } else {
            $result = $this->user_model->get();
        }

        $this->output->set_output(json_encode($result));
    }

    public function send_mail($param) {
        $this->load->library('email');

        $this->email->from('service@smith-cargo.com', 'Smith Transportation');
        $this->email->to($param['email']);
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Smith Transportation customer');
        $this->email->message('<div><h1>Smith Transportation</h1></div>
                        <ul>
                            <li>Your company has been created in Trackngo System</li>
                        </ul>');
        $this->email->set_mailtype("html");

        if (!$this->email->send()) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
        }
    }

}
