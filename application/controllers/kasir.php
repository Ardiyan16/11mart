<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_kasir');
    }

    public function index()
    {
        $data['title'] = 'kasir-transaksi';
        $this->load->view('pages/penjualan', $data);
    }

    public function max_nota()
    {
        $data = $this->m_kasir->max_nota()->row();
        $json['maxs'] = @$data->maxs;
        echo json_encode($json);
    }

    public function ajax_listall($nomor)
    {

        $list = $this->m_kasir->get_datatablesid();
        // print_r($this->db->last_query());
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($list as $orde) {
            // $kode_barang = preg_replace ('/[^\p{L}\p{N}]/u', '', $orde->kode_barang);
            // $nama_barang = preg_replace ('/[^\p{L}\p{N}]/u', '', $orde->nama_barang);

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $orde->kode_brg;
            $row[] = $orde->nama_brg;
            $row[] = $orde->harga_satuan;
            $row[] = $orde->harga_grosir;

            $row[] = ' <button type="button" class="btn btn-primary "onclick="pencarian_kode(\'' . $orde->kode_brg . '\',\'' . $orde->nama_brg . '\',\'' . $orde->harga_satuan . '\',\'' . $orde->harga_grosir . '\',\'' . $nomor . '\')">Pilih</button>';


            $data[] = $row;
        }
        $output = array(
            "draw" => $_REQUEST['draw'],
            "recordsTotal" => $this->m_kasir->count_allid(),
            "recordsFiltered" => $this->m_kasir->count_filteredid(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getDataBarang()
	{
		$this->m_kasir->ambilBarang();
		// print_r($this->db->last_query());
	}
}
