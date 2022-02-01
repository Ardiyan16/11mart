<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_kasir extends CI_Model
{
    private $tb_pendapatan = 'pendapatan_harian';
    private $tb_pembukuan = 'pembukuan';

    function max_nota()
    {
        return $this->db->query('SELECT kode_pj AS maxs FROM penjualan order by kode_pj desc limit 1 ');
    }

    // var $barang = 'barang';
    var $column_orderid = array('a.kode_brg', 'a.nama_brg', 'a.harga_satuan', 'a.harga_grosir', 'a.stok', null); //set column field database for datatable orderable
    var $column_searchid = array('a.kode_brg', 'a.nama_brg', 'a.harga_satuan', 'a.harga_grosir', 'a.stok'); //set column field database for datatable searchable just title , author , category are searchable
    var $orderid = array('a.id_brg' => 'asc'); // default order

    public function get_datatablesid()
    {
        $this->_get_datatables_queryid();
        //	$this->db->where('orde_sungai',$id);

        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_queryid()
    {
        $this->db->select('*');
        $this->db->from("barang a");
        // $this->db->join('jenis c', 'a.id_jenis=c.id_jenis', 'left outer');
        // $this->db->join('merek b', 'a.id_merek=b.id_merek', 'left outer');
        $i = 0;


        foreach ($this->column_searchid as $item) {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    // $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_searchid) - 1 == $i); //last loop
                // $this->db->group_end(); //close bracket


            }

            $i++;
        }

        if (isset($_REQUEST['order'])) {
            $this->db->order_by($this->column_orderid[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->orderid)) {
            $order = $this->orderid;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filteredid()
    {
        $this->_get_datatables_queryid();
        //$this->db->where('orde_sungai',$id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_allid()
    {
        $this->db->from('barang');
        return $this->db->count_all_results();
    }

    public function ambilBarang()
    {
        $barang = $this->db->get('barang');

        if ($barang->num_rows() > 0) {
            $json['status']     = 1;
            foreach ($barang->result() as $b) {
                $json['datanya'][] = $b;
            }
            $json['jumlah_barang'] = count($barang->result());
        } else {
            $json['status']     = 0;
        }

        echo json_encode($json);
    }

    public function list_pendapatan()
    {
        return $this->db->get($this->tb_pendapatan)->result();
    }

    public function save_pendapatan()
    {
        $post = $this->input->post();
        $this->hari = $post['hari'];
        $this->tanggal = $post['tanggal'];
        $this->pendapatan = $post['pendapatan'];
        $this->keterangan = $post['keterangan'];
        $this->db->insert($this->tb_pendapatan, $this);
    }

    public function update_pendapatan()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->hari = $post['hari'];
        $this->tanggal = $post['tanggal'];
        $this->pendapatan = $post['pendapatan'];
        $this->keterangan = $post['keterangan'];
        $this->db->update($this->tb_pendapatan, $this, ['id' => $post['id']]);
    }

    function getLastId()
    {
        $sql = $this->db->select('kode_pj');
        $sql = $this->db->from('penjualan');
        $sql = $this->db->order_by('kode_pj', 'desc');
        $sql = $this->db->limit(1);
        $sql = $this->db->get();

        return $sql->result_array();
    }

    public function nota($kode)
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('penjualan', 'penjualan.kode_pj = detail_penjualan.kode_pj', 'left_outer');
        $this->db->join('barang', 'barang.kode_brg = detail_penjualan.kode_brg', 'left_outer');
        $this->db->where('detail_penjualan.kode_pj', $kode);
        return $this->db->get()->result();
    }

    public function save_pembukuanKeuangan()
    {
        $post = $this->input->post();
        $this->kode_transaksi = $post['kode_keuangan'];
        $this->kategori = 'beban keuangan';
        $this->tanggal = $post['tgl_input'];
        $this->nominal = $post['nominal_keuangan'];
        $this->db->insert($this->tb_pembukuan, $this);
    }
}
