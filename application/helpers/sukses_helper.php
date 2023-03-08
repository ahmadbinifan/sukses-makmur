<?php
function backView($url, $data)
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view('templates/sidebar');
    $ci->load->view('templates/topbar');
    $ci->load->view($url);
    $ci->load->view('templates/footer');
}
function Parse_Data($data, $p1, $p2)
{
    $data = " " . $data;
    $hasil = "";
    $awal = strpos($data, $p1);
    if ($awal != "") {
        $akhir = strpos(strstr($data, $p1), $p2);
        if ($akhir != "") {
            $hasil = substr($data, $awal + strlen($p1), $akhir - strlen($p1));
        }
    }
    return $hasil;
}
