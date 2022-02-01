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

    public function pendapatan_masuk()
    {
        $data['title'] = 'Pendapatan Masuk';
        $this->load->view('pages/pendapatan', $data);
    }

    public function save_pendapatan()
    {
        $this->m_kasir->save_pendapatan();
        $this->session->set_flashdata('insert', true);
        redirect('kasir/pendapatan_masuk');
    }

    public function penjualan_grosir()
    {
        $data['title'] = 'Penjualan Grosir';
        $this->load->view('pages/penjualan_grosir', $data);
    }

    public function proses_penjualanGrosir()
	{
		// $total = 0;
		// foreach ($_POST['subtotal'] as $value) {
		// 	$total += $value;
		// }
		$total_qty = 0;
		foreach ($_POST['qty'] as $value) {
			$total_qty += $value;
		}
		$total_byr = $this->input->post('total_byr');
        $total_pj = $this->input->post('total_pj');
		$kasir = $this->input->post('kasir');
		$total_potongan = $this->input->post('total_potongan');
		$kembalian = $this->input->post('kembalian');
        $tgl_pj = $this->input->post('tgl_pj');
		$kode_pj = $this->input->post('kode_pj');
		$penjualan = array(
			'kode_pj' => $kode_pj,
			'tgl_pj' => $tgl_pj,
			'kasir' => $kasir,
			'total_qty' => $total_qty,
			'total_pj' => $total_pj,
			'total_byr' => $total_byr,
			'total_potongan' => $total_potongan,
			'kembalian' => $kembalian,
			'ket' => 'transaksi grosir',
		);
		$pembukuan = array(
			'kode_transaksi' => $kode_pj,
			'kategori' => 'penjualan',
			'tanggal' => $tgl_pj,
			'nominal' =>  $total_pj,
		);
		$this->db->insert('penjualan', $penjualan);
		$this->db->insert('pembukuan', $pembukuan);
		$lasId = $this->m_kasir->getLastId();
		foreach ($_POST['kode_brg'] as $key => $value) {
			$data = [
				'kode_pj' => $lasId[0]['kode_pj'],
				'kode_brg' => $this->input->post('kode_brg')[$key],
				'qty' => $this->input->post('qty')[$key],
				'harga' => $this->input->post('harga_grosir')[$key],
				'subtotal' => $this->input->post('subtotal')[$key],
				'potongan' => $this->input->post('potongan')[$key],
			];
			$this->db->insert('detail_penjualan', $data);
		}
		foreach ($_POST['kode_brg'] as $key => $value) {

			$kode_brg = $this->input->post('kode_brg')[$key];
			$qty = $this->input->post('qty')[$key];
			$this->db->query("UPDATE `barang` SET `stok`=stok-'$qty' WHERE kode_brg='$kode_brg'");
		}
		$this->session->set_flashdata('transaksiberhasil', true);
		redirect('kasir/nota_penjualan/' . $kode_pj);
	}

    public function nota_penjualan($kode)
    {
        $data['jual'] = $this->db->get_where('penjualan', ['kode_pj' => $kode])->row_array();
		$data['detail'] = $this->m_kasir->nota($kode);
		$this->load->view('pages/nota', $data);
    }
}
