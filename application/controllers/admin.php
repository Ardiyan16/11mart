<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_kasir');
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

    public function list_pendapatan()
    {
        $data['title'] = 'List Pendapatan';
        $data['pendapatan'] = $this->m_kasir->list_pendapatan();
        $data['edit'] = $this->m_kasir->list_pendapatan();
        $this->load->view('pages/list_pendapatan', $data);
    }

    public function update_pendapatan()
    {
        $this->m_kasir->update_pendapatan();
        $this->session->set_flashdata('update', true);
        redirect('admin/list_pendapatan');
    }

    public function delete_pendapatan($id)
    {
        $this->db->delete('pendapatan_harian', ['id' => $id]);
        $this->session->set_flashdata('delete', true);
        redirect('admin/list_pendapatan');
    }

    public function list_penjualan()
    {
        $data['title'] = 'List Penjualan';
        $data['penjualan'] = $this->m_admin->list_penjualan();
        $data['detail'] = $this->m_admin->list_detailPenjualan();
        $this->load->view('pages/history_penjualan', $data);
    }

    public function list_detailPenjualan()
    {
        $data['title'] = 'List Detail Penjualan';
        $data['detail'] = $this->m_admin->list_detailPenjualan();
        $this->load->view('pages/detail_penjualan', $data);
    }

    public function detail_barangTerjual($kode)
    {
        $data['title'] = 'List Detail Penjualan';
        $data['detail'] = $this->m_admin->detail_barangTerjual($kode);
        $this->load->view('pages/detail_barang_terjual', $data);
    }

    public function laporan_penjualan()
    {
        $data['title'] = 'List Penjualan';
        $data['penjualan'] = $this->m_admin->list_penjualan();
        $this->load->view('pages/laporan_penjualan', $data);
    }

    public function filter_laporanPenjualan()
    {
        $tgl_awal = $this->input->get('tanggal_awal');
        $tgl_akhir = $this->input->get('tanggal_akhir');
        $data['title'] = 'List Penjualan';
        $data['penjualan'] = $this->m_admin->filter_laporanPenjualan($tgl_awal, $tgl_akhir);
        $this->load->view('pages/laporan_penjualan', $data);
    }

    public function cetak_pdf()
    {
        $data['title'] = 'Cetak PDF Laporan Penjualan';
        $data['penjualan'] = $this->m_admin->list_penjualan();
        $this->load->view('pages/pdf_laporan_penjualan', $data);
    }
}