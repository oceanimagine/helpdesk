<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        session_start();
        session_destroy();
        redirect('login');
    }
}