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
        $data['notifikasi'] = $this->m_admin->notifikasi_stok();
        $data['jml_notif'] = $this->m_admin->jml_notif();
        $data['bulan'] = $this->db->get('bulan')->result();
        foreach ($this->m_admin->grafik_penjualan()->result_array() as $row) {
            $data['grafik'][] = (int) $row['Januari'];
            $data['grafik'][] = (int) $row['Februari'];
            $data['grafik'][] = (int) $row['Maret'];
            $data['grafik'][] = (int) $row['April'];
            $data['grafik'][] = (int) $row['Mei'];
            $data['grafik'][] = (int) $row['Juni'];
            $data['grafik'][] = (int) $row['Juli'];
            $data['grafik'][] = (int) $row['Agustus'];
            $data['grafik'][] = (int) $row['September'];
            $data['grafik'][] = (int) $row['Oktober'];
            $data['grafik'][] = (int) $row['November'];
            $data['grafik'][] = (int) $row['Desember'];
        }
        $data['pendapatan_harian'] = $this->m_admin->pendapatan_perhari();
        $data['pendapatan_total'] = $this->m_admin->pendapatan_total();
        $data['total_transaksi'] = $this->m_admin->total_transaksi();
        $data['transaksi_hariini'] = $this->m_admin->jml_transaksiHariIni();
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

    public function pembukuan()
    {
        $data['title'] = 'Pembukuan';
        $data['pembukuan'] = $this->db->get('pembukuan')->result();
        $this->load->view('pages/pembukuan', $data);
    }

    public function kebutuhan()
    {
        $data['title'] = 'Kebutuhan';
        $data['kebutuhan'] = $this->db->get('kebutuhan')->result();
        $data['edit'] = $this->db->get('kebutuhan')->result();
        $this->load->view('pages/kebutuhan', $data);
    }

    public function save_kebutuhan()
    {
        $data = [
            'kebutuhan' => $this->input->post('kebutuhan')
        ];
        $this->db->insert('kebutuhan', $data);
        $this->session->set_flashdata('insert', true);
        redirect('admin/kebutuhan');
    }

    public function update_kebutuhan()
    {
        $id = $this->input->post('id');
        $kebutuhan = $this->input->post('kebutuhan');
        $this->db->set('kebutuhan', $kebutuhan);
        $this->db->where('id', $id);
        $this->db->update('kebutuhan');
        $this->session->set_flashdata('update', true);
        redirect('admin/kebutuhan');
    }

    public function delete_kebutuhan($id)
    {
        $this->db->delete('kebutuhan', ['id' => $id]);
        $this->session->set_flashdata('delete', true);
        redirect('admin/kebutuhan');
    }

    public function keuangan()
    {
        $data['title'] = 'Kebutuhan Keuangan';
        $data['keuangan'] = $this->m_admin->list_keuangan();
        $data['kode'] = $this->m_admin->get_kodeKeuangan();
        $data['edit'] = $this->m_admin->list_keuangan();
        $data['kebutuhan'] = $this->db->get('kebutuhan')->result();
        $this->load->view('pages/beban_keuangan', $data);
    }

    public function save_keuangan()
    {
        $this->m_admin->save_keuangan();
        $this->m_kasir->save_pembukuanKeuangan();
        $this->session->set_flashdata('insert', true);
        redirect('admin/keuangan');
    }

    public function update_keuangan()
    {
        $this->m_admin->update_keuangan();
        $this->m_kasir->update_pembukuanKeuangan();
        $this->session->set_flashdata('update', true);
        redirect('admin/keuangan');
    }

    public function delete_keuangan($kode)
    {
        $this->db->delete('beban_keuangan', ['kode_keuangan' => $kode]);
        $this->db->delete('pembukuan', ['kode_transaksi' => $kode]);
        $this->session->set_flashdata('delete', true);
        redirect('admin/keuangan');
    }

    public function laba_rugi()
    {
        $data['title'] = 'Laba Rugi';
        $this->load->view('pages/laba_rugi', $data);
    }

    public function getlabarugi()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->m_admin->getLabarugi($postData)[0];

        header('content-type:json/application');
        echo json_encode($data);
    }

    public function cetak_pdf_labarugi()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        //total penjualan
        $this->db->select('SUM(penjualan.total_pj) as total');
        $this->db->where('YEAR(tgl_pj)', $tahun);
        $this->db->where('MONTH(tgl_pj)', $bulan);
        $penjualan  = $this->db->get('penjualan')->result();

        //total beban
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $totalbeban  = $this->db->get('beban_keuangan')->result();

        //kebutuhan listrik
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '1');
        $listrik  = $this->db->get('beban_keuangan')->result();

        //kebutuhan kebersihan
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '2');
        $kebersihan  = $this->db->get('beban_keuangan')->result();

        //kebutuhan gaji
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '3');
        $gaji  = $this->db->get('beban_keuangan')->result();

        //kebutuhan pajak
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '4');
        $pajak  = $this->db->get('beban_keuangan')->result();

        //kebutuhan lain lain
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '5');
        $lainlain = $this->db->get('beban_keuangan')->result();

        //kebutuhan kulaan
        $this->db->select('SUM(beban_keuangan.nominal_keuangan) as total');
        $this->db->where('YEAR(tgl_input)', $tahun);
        $this->db->where('MONTH(tgl_input)', $bulan);
        $this->db->where('id_kebutuhan', '6');
        $kulaan  = $this->db->get('beban_keuangan')->result();

        $totalpenjualan = $penjualan[0]->total;
        $lababersih = $totalpenjualan - $totalbeban[0]->total;
        if ($this->input->post('submit')) {
            $param['title'] = "Data Laba Rugi";
            $param['tanggal'] = " Bulan " . $bulan . " Tahun " . $tahun;
            $param['total_penjualan'] = $totalpenjualan;
            $param['gaji'] = $gaji[0]->total;
            $param['listrik'] = $listrik[0]->total;
            $param['pajak'] = $pajak[0]->total;
            $param['kebersihan'] = $kebersihan[0]->total;
            $param['kulaan'] = $kulaan[0]->total;
            $param['lainlain'] = $lainlain[0]->total;
            $param['total_beban'] = $totalbeban[0]->total;
            $param['laba_bersih'] = $lababersih;
            $this->load->view("pages/pdf_labarugi", $param);
        }
    }
}
