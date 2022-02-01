<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model
{

    private $tb_brg = 'barang';
    private $tb_user = 'auth';
    private $tb_penjualan = 'penjualan';
    private $tb_detail = 'detail_penjualan';

    public function list_brg()
    {
        return $this->db->get($this->tb_brg)->result();
    }

    public function save_brg()
    {
        $post = $this->input->post();
        $this->kode_brg = $post['kode_brg'];
        $this->nama_brg = $post['nama_brg'];
        $this->harga_satuan = $post['harga_satuan'];
        $this->harga_grosir = $post['harga_grosir'];
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
}
