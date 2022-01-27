<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'admin-dashboard';
        $this->load->view('pages/dashboard', $data);
    }

    public function barang()
    {
        $data['title'] = 'admin-barang';
        $data['barang'] = $this->m_admin->list_brg();
        $this->load->view('pages/barang', $data);
    }

    public function add_barang()
    {
        $data['title'] = 'admin-form tambah barang';
        $this->load->view('pages/add_barang', $data);
    }

    public function save_brg()
    {   
        $this->m_admin->save_brg();
        $this->session->set_flashdata('insert', true);
        redirect('admin/barang');
    }

    public function edit_barang($id)
    {
        $data['title'] = 'admin-edit barang';
        $data['edit'] = $this->db->get_where('barang', ['id_brg' => $id])->row();
        $this->load->view('pages/edit_barang', $data);
    }

    public function update_brg()
    {
        $this->m_admin->update_brg();
        $this->session->set_flashdata('update', true);
        redirect('admin/barang');
    }

    public function add_stok($id)
    {
        $data['title'] = 'admin-tambah stok';
        $data['stok'] = $this->db->get_where('barang', ['id_brg' => $id])->row();
        $this->load->view('pages/add_stok', $data);
    }

    public function save_stok()
    {
        $id_brg = $this->input->post('id_brg');
		$stok = $this->input->post('stok');
		$this->db->query("UPDATE `barang` SET `stok`=stok+'$stok' WHERE id_brg='$id_brg'");
		$this->session->set_flashdata('tambah_stok', true);
        redirect('admin/barang');
    }

    public function delete_brg($id)
    {
        $this->m_admin->delete_brg($id);
        $this->session->set_flashdata('delete', true);
        redirect('admin/barang');
    }

    public function akun()
    {
        $data['title'] = 'admin-list akun';
        $data['akun'] = $this->m_admin->list_akun();
        $this->load->view('pages/akun', $data);
    }

    public function save_akun()
    {
        $this->m_admin->save_akun();
        $this->session->set_flashdata('insert', true);
        redirect('admin/akun');
    }

    public function delete_akun($id)
    {
        $this->db->delete('auth', ['id' => $id]);
        $this->session->set_flashdata('delete', true);
        redirect('admin/akun');
    }
}