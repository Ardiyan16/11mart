<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model
{

    private $tb_brg = 'barang';
    private $tb_user = 'auth';
    private $tb_penjualan = 'penjualan';
    private $tb_detail = 'detail_penjualan';
    private $tb_keuangan = 'beban_keuangan';
    private $tb_pembukuan = 'pembukuan';

    public function list_brg()
    {
        return $this->db->get($this->tb_brg)->result();
    }

    public function save_brg()
    {
        $post = $this->input->post();
        $this->kode_brg = $post['kode_brg'];
        $this->nama_brg = $post['nama_brg'];
        $this->harga_satuan = str_replace(",", "", $post['harga_satuan']);
        $this->harga_grosir = str_replace(",", "", $post['harga_grosir']);
        $this->modal = str_replace(",", "", $post['modal']);;
        $this->stok = $post['stok'];
        $this->foto = $this->foto_produk();
        $this->db->insert($this->tb_brg, $this);
    }

    public function update_brg()
    {
        $post = $this->input->post();
        $this->id_brg = $post['id_brg'];
        $this->kode_brg = $post['kode_brg'];
        $this->nama_brg = $post['nama_brg'];
        $this->harga_satuan = $post['harga_satuan'];
        $this->harga_grosir = $post['harga_grosir'];
        $this->modal = $post['modal'];
        $this->stok = $post['stok'];
        if (!empty($_FILES["foto"]["name"])) {
            $this->foto = $this->foto_produk();
        } else {
            $this->foto = $post["old_image"];
        }
        $this->db->update($this->tb_brg, $this, ['id_brg' => $post['id_brg']]);
    }

    private function foto_produk()
    {
        $config['upload_path']          = './assets/img/produk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $nama_lengkap = $_FILES['foto']['name'];
        $config['file_name']            = $nama_lengkap;
        $config['overwrite']            = true;
        $config['max_size']             = 3024;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        print_r($this->upload->display_errors());
    }

    public function delete_brg($id)
    {
        $this->hapus_foto($id);
        return $this->db->delete($this->tb_brg, array("id_brg" => $id));
    }

    public function hapus_foto($id)
    {
        $foto = $this->db->get_where($this->tb_brg, ['id_brg' => $id])->row();
        if ($foto->foto != "01.jpg") {
            $filename = explode(".", $foto->foto)[0];
            return array_map('unlink', glob(FCPATH . "/assets/img/produk/$filename.*"));
        }
    }

    public function list_akun()
    {
        return $this->db->get_where($this->tb_user, ['role' => 'kasir'])->result();
    }

    public function save_akun()
    {
        $post = $this->input->post();
        $this->username = $post['username'];
        $this->password = $post['password'];
        $this->role = $post['role'];
        $this->is_active = $post['is_active'];
        $this->db->insert($this->tb_user, $this);
    }

    public function list_penjualan()
    {
        return $this->db->get($this->tb_penjualan)->result();
    }

    public function list_detailPenjualan()
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg');
        return $this->db->get()->result();
    }

    public function detail_barangTerjual($kode)
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg');
        $this->db->where('kode_pj', $kode);
        return $this->db->get()->result();
    }

    public function filter_laporanPenjualan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->where('tgl_pj >=', $tgl_awal);
        $this->db->where('tgl_pj <=', $tgl_akhir);
        return $this->db->get()->result();
    }

    function get_kodeKeuangan()
    {
        $this->db->select('RIGHT(beban_keuangan.kode_keuangan,4) as kode', FALSE);
        $this->db->order_by('kode_keuangan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('beban_keuangan');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "KK" . $kodemax;
        return $kodejadi;
    }

    public function list_keuangan()
    {
        $this->db->select('*');
        $this->db->from('beban_keuangan');
        $this->db->join('kebutuhan', 'kebutuhan.id = beban_keuangan.id_kebutuhan');
        return $this->db->get()->result();
    }

    public function save_keuangan()
    {
        $post = $this->input->post();
        $this->kode_keuangan = $post['kode_keuangan'];
        $this->tgl_input = $post['tgl_input'];
        $this->nominal_keuangan = str_replace(",", "", $post['nominal_keuangan']);
        $this->id_kebutuhan = $post['id_kebutuhan'];
        $this->keterangan = $post['keterangan'];
        $this->db->insert($this->tb_keuangan, $this);
    }

    public function update_keuangan()
    {
        $post = $this->input->post();
        $this->kode_keuangan = $post['kode_keuangan'];
        $this->tgl_input = $post['tgl_input'];
        $this->nominal_keuangan = $post['nominal_keuangan'];
        $this->id_kebutuhan = $post['id_kebutuhan'];
        $this->keterangan = $post['keterangan'];
        $this->db->update($this->tb_keuangan, $this, ['kode_keuangan' => $post['kode_keuangan']]);
    }

    function getLabarugi($postData = null)
    {

        $response = array();

        ## Read value
        /*         $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
 */
        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $bulan = $postData['bulan'];
        $tahun = $postData['tahun'];

        $tanggal = $tahun . '-' . $bulan . '-01';

        // ## Search 
        // $search_arr = array();
        // $searchQuery = "";
        // if ($searchValue != '') {
        //     $search_arr[] = " (nama_pengeluaran like '%" . $searchValue . "%'  ) ";
        // }
        // // if ($searchSuplier != '') {
        // //     $search_arr[] = " nama_suplier='" . $searchSuplier . "' ";

        // if ($searchTahun != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchTahun . "%' ";
        // }        // }

        // if ($searchBulan != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchBulan . "%' ";
        // }
        // if (count($search_arr) > 0) {
        //     $searchQuery = implode(" and ", $search_arr);
        // }

        /*         ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records  = $this->db->get('buku_besar')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $records  = $this->db->get('buku_besar')->result();
        $totalRecordwithFilter = $records[0]->allcount;
 */
        // ## Fetch records
        // $this->db->select('*');
        // if ($bulan != '' || $tahun != '')
        //     $this->db->where('YEAR(tanggal)', $tahun);
        // $this->db->where('MONTH(tanggal)', $bulan);
        // $this->db->order_by('buku_besar.id_bukubesar');
        // //        $this->db->limit($rowperpage, $start);
        // $records  = $this->db->get('buku_besar')->result();

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


        // $this->db->select('SUM(kas.nominal) as total');
        // // $this->db->limit($rowperpage, $start);
        // $this->db->where('YEAR(tanggal_kas)', $tahun);
        // $this->db->where('MONTH(tanggal_kas)', $bulan);
        // $this->db->where('id_beban', '7');
        // $lain  = $this->db->get('kas')->result();

        // $this->db->select('SUM(kas.nominal) as total');
        // // $this->db->limit($rowperpage, $start);
        // $this->db->where('YEAR(tanggal_kas)', $tahun);
        // $this->db->where('MONTH(tanggal_kas)', $bulan);
        // $this->db->where('id_beban', '8');
        // $pendapatanlain  = $this->db->get('kas')->result();

        // $this->db->select('SUM(kas.nominal) as total');
        // // $this->db->limit($rowperpage, $start);
        // $this->db->where('YEAR(tanggal_kas)', $tahun);
        // $this->db->where('MONTH(tanggal_kas)', $bulan);
        // $this->db->where('id_beban', '9');
        // $bebanlain  = $this->db->get('kas')->result();

        $data = array();

        // $saldoAwal = $totalDebit[0]->total - $totalKredit[0]->total;
        $totalpenjualan = $penjualan[0]->total;
        $returnpenjualan = 0;
        $returnpembelian = 0;
        $potonganpembelian = 0;
        // $pembelianbersih = $pembelian[0]->total - $returnpembelian - $potonganpembelian;
        // $totalpersediaan = $totalDebit[0]->total + $pembelian[0]->total;
        // $persediaanakhir = $totalDebit[0]->total - $totalpenjualan;
        // $nonoperasional = $pendapatanlain[0]->total + $bebanlain[0]->total;
        $lababersih = $totalpenjualan - $totalbeban[0]->total;
        // $hpp = $totalpersediaan - $persediaanakhir;

        // $gajiKaryawan = 0;
        $data[] = array(
            // "potongan_penjualan" => $potongan[0]->total,
            "return_penjualan" => $returnpenjualan,
            "total_penjualan" => $totalpenjualan,
            // "pembelian" => $pembelian[0]->total,
            "potongan_pembelian" => $potonganpembelian,
            "return_pembelian" => $returnpembelian,
            // "pembelian_bersih" => $pembelianbersih,
            // "persediaan_awal" => $totalDebit[0]->total,
            // "total_persediaan" => $totalpersediaan,
            // "persediaan_akhir" =>  $persediaanakhir,
            // "hpp" => $hpp,
            // "laba_rugi" => $totalpenjualan - $hpp,
            "gaji" => $gaji[0]->total,
            "listrik" => $listrik[0]->total,
            "pajak" => $pajak[0]->total,
            // "peralatan" => $peralatan[0]->total,
            "kebersihan" => $kebersihan[0]->total,
            "kulaan" => $kulaan[0]->total,
            "lainlain" => $lainlain[0]->total,
            "totalbeban" => $totalbeban[0]->total,
            // "pendapatan_lain" => $pendapatanlain[0]->total,
            // "beban_lain" => $bebanlain[0]->total,
            // "total_non" => $nonoperasional,
            "laba_bersih" => $lababersih
        );
        return $data;
    }

    public function notifikasi_stok()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('stok <', 10);
        return $this->db->get()->result();
    }

    public function jml_notif()
    {
        $this->db->select('COUNT(id_brg) as jml');
        $this->db->from('barang');
        $this->db->where('stok <', 10);
        return $this->db->get()->row()->jml;
    }

    public function pendapatan_perhari()
    {
        $tgl = date('Y/m/d');
        $this->db->select('SUM(penjualan.total_pj) as pendapatan_harian');
        $this->db->from('penjualan');
        $this->db->where('tgl_pj', $tgl);
        return $this->db->get()->row()->pendapatan_harian;
    }

    public function pendapatan_total()
    {
        $this->db->select('SUM(penjualan.total_pj) as jml_byr');
        $this->db->from('penjualan');
        return $this->db->get()->row()->jml_byr;
    }

    public function total_transaksi()
    {
        $this->db->select('COUNT(penjualan.kode_pj) as total_trans');
        $this->db->from('penjualan');
        return $this->db->get()->row()->total_trans;
    }

    public function jml_transaksiHariIni()
    {
        $tgl = date('Y/m/d');
        $this->db->select('COUNT(penjualan.kode_pj) as trans_hariini');
        $this->db->from('penjualan');
        $this->db->where('tgl_pj', $tgl);
        return $this->db->get()->row()->trans_hariini;
    }

    public function grafik_penjualan()
    {
        $tahun = date('Y');
        $bc = $this->db->query("
 
       SELECT
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=1)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Januari`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=2)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Februari`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=3)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Maret`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=4)AND (YEAR(tgl_pj)='$tahun'))),0) AS `April`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=5)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Mei`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=6)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Juni`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=7)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Juli`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=8)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Agustus`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=9)AND (YEAR(tgl_pj)='$tahun'))),0) AS `September`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=10)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Oktober`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=11)AND (YEAR(tgl_pj)='$tahun'))),0) AS `November`,
       ifnull((SELECT sum(total_pj) FROM (penjualan)WHERE((Month(tgl_pj)=12)AND (YEAR(tgl_pj)='$tahun'))),0) AS `Desember`
       from penjualan GROUP BY YEAR(tgl_pj) 
 
 ");

        return $bc;
    }

    public function list_laporan_stok()
    {
        $this->db->select('*');
        $this->db->from('laporan_stok');
        $this->db->join('auth', 'auth.id = laporan_stok.id_kasir');
        $this->db->join('barang', 'barang.kode_brg = laporan_stok.kode_brg');
        $this->db->order_by('id_ls', 'desc');
        return $this->db->get()->result();
    }

    public function filter_laporanStok($bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('laporan_stok');
        $this->db->join('auth', 'auth.id = laporan_stok.id_kasir');
        $this->db->join('barang', 'barang.kode_brg = laporan_stok.kode_brg');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        return $this->db->get()->result();
    }

}
