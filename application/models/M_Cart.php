<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Cart extends CI_Model
{
    function hapus_tb_cart()
    {
        $hsl = $this->db->query("TRUNCATE TABLE tb_cart");
        return $hsl;
    }

    function hapus_cart($id)
    {
        $hsl = $this->db->query("DELETE FROM tb_cart where rowid='$id'");
        return $hsl;
    }

    function get_cart_by_id($id)
    {
        $hsl = $this->db->query("SELECT * FROM tb_cart WHERE id='$id'");
        return  $hsl;
    }
    // function update_barang($id,$name,$satuan,$harpok,$price,$disc,$qty,$amount,$subtotal)
    // {
    // 	$user_id = $this->session->userdata('idadmin');
    // 	$hsl = $this->db->query("UPDATE tbl_barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_harjul_grosir='$harjul_grosir',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat',barang_user_id='$user_id' WHERE barang_id='$kobar'");
    // 	return $hsl;
    // }

    function tampil_cart()
    {
        $hsl = $this->db->query("SELECT * FROM tb_cart");
        return $hsl;
    }

    function simpan_cart($data)
    {
        // $user_id = $this->session->userdata('idadmin');
        // $hsl = $this->db->query("INSERT INTO tb_cart (id,name,satuan,harpok,price,disc,qty,amount,subtotal) VALUES ('$id','$name','$satuan','$harpok','$price','$disc','$qty','$amount','$subtotal')");
        return $this->db->insert('tb_cart', $data);
        // return $hsl;
    }
    function update_qty_cart($qty, $subtotal, $id)
    {
        $hsl = $this->db->query("UPDATE tb_cart SET qty='$qty',subtotal='$subtotal' WHERE id='$id'");
        return $hsl;
    }
}
