<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'kasir-transaksi';
        $this->load->view('pages/penjualan', $data);
    }
}
