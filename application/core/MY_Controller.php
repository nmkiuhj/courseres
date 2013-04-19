<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
	}

    public function response($data = array(),$total = 0, $message = NULL, $success = TRUE, $http_code = 200)
    {
        // If data is empty and not code provide, error and bail
        if (empty($data) && $http_code === null)
        {
            $http_code = 404;

            // create the output variable here in the case of $this->response(array());
            $output = NULL;
        }

        // Otherwise (if no data but 200 provided) or some data, carry on camping!
        else
        {
            if($success){
                $response = array(
                    'data' => array('totalItems' => $total,'items' => $data),
                    'context' => $message
                );
            } else {
                $response['error'] = array(
                    'message' => $message
                );
            }

            is_numeric($http_code) OR $http_code = 200;

            header('Content-Type: application/json');
            $output = json_encode($response);
        }

        header('HTTP/1.1: ' . $http_code);
        header('Status: ' . $http_code);

        exit($output);
    }
    
	public function _admin_load_view($data,$url)
    {
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view($url);
		$this->load->view('admin/footer');
	}

    public function _front_load_view($data,$url)
    {
        $this->load->view('header',$data);
        $this->load->view($url);
        $this->load->view('footer');
    }

    public function check_login()
    {
        $user = $this->session->userdata('user'); //用户session值
        if ( ! $user) {
            echo $this->load->view('admin/signin', NULL, TRUE);
            die;
        }
    }
}
?>