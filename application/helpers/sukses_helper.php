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
