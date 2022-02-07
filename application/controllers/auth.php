<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'username tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'password tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->proses_login();
        }
    }

    private function proses_login()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $user = $this->db->get_where('auth', ['username' => $username])->row_array();
        $cekpass = $this->db->get_where('auth', array('password' => $password));


        //jika usernya terdaftar
        if ($username == $user['username']) {
            if ($user['is_active'] = 1) {
                if ($password == $user['password']) {
                    $data = [
                        'username' => $user['username'],
                        'role' => $user['role'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 'admin') {
                        redirect('admin');
                    }
                    if ($user['role'] == 'kasir') {
                        redirect('kasir');
                    } else {
                        $this->session->unset_userdata('username');
                        $this->session->unset_userdata('role');
                        $this->session->set_flashdata('gagal', true);
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('passwordsalah', true);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('tidakaktif', true);
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('usernamesalah', true);
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('logout', true);
        redirect('auth');
    }
}
