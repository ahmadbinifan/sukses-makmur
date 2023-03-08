<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Finger extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('sukses');
    }

    public function get_setting()
    {
        $data = $this->db->get('setting')->row();
        return $data;
    }

    public function if_exist_check($PIN, $DateTime)
    {
        $data = $this->db->get_where('data_absen', array('pin' => $PIN, 'date_time' => $DateTime))->row();
        return $data;
    }
    public function check_karyawan($PIN)
    {
        $this->db->select('*')->from('data_absen')->where(array('pin' => $PIN, 'status' => 0,))->like('date_time', date('Y-m-d'));
        $data = $this->db->get()->result();
        return $data;
    }

    public function get_data_absen()
    {
        error_reporting(0);

        $IP = $this->get_setting()->ip;
        // $Key = $this->get_setting()->password;
        $Key = 0;
        if ($IP != "") {
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $soap_request = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
                $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
                $buffer = explode("\r\n", $buffer);
                for ($a = 0; $a < count($buffer); $a++) {
                    $data = Parse_Data($buffer[$a], "<Row>", "</Row>");
                    $PIN = Parse_Data($data, "<PIN>", "</PIN>");
                    $DateTime = Parse_Data($data, "<DateTime>", "</DateTime>");
                    $Verified = Parse_Data($data, "<Verified>", "</Verified>");
                    $Status = Parse_Data($data, "<Status>", "</Status>");
                    $tanggal = date('Y-m-d', strtotime($DateTime));
                    $ins = array(
                        "pin"       =>  $PIN,
                        "date_time" =>  $DateTime,
                        "ver"        =>  $Verified,
                        "status"    =>  $Status
                    );
                    $updates = array(
                        "pin"       =>  $PIN,
                        "date_time_out" =>  $DateTime,
                        "ver"        =>  $Verified,
                        "status"    =>  $Status
                    );
                    if (!$this->if_exist_check($PIN, $DateTime) && $PIN && $DateTime) {
                        $this->db->insert('data_absen', $ins);
                    }
                    if ($Status == 1) {
                        $this->db->where([
                            'pin' => $PIN,
                            'status' => 0,
                            'DATE(date_time)' => $tanggal
                        ]);
                        $this->db->update('data_absen', $updates);
                        $this->hapus_yg_ada($PIN);
                    }
                    if ($Status == 1) {
                        $this->db->where([
                            'pin' => $PIN,
                            'status' => 3,
                            'DATE(date_time)' => $tanggal
                        ]);
                        $this->db->update('data_absen', $updates);
                        $this->hapus_yg_ada($PIN);
                    }

                    // if ($Status == 1) {
                    //     $this->db->where([
                    //         'pin' => $PIN,
                    //         'status' => 0,
                    //     ]);
                    //     $this->db->like('date_time', date('Y-m-d'));
                    //     $this->db->update('data_absen', $updates);
                    // $this->hapus_yg_ada($PIN);
                    // }
                    // if ($Status == 3) {
                    //     $this->db->where([
                    //         'pin' => $PIN,
                    //         'status' => 0,
                    //     ]);
                    //     $this->db->like('date_time', date('Y-m-d'));
                    //     $this->db->update('data_absen', $updates);
                    //     $this->hapus_yg_ada($PIN);
                    // }
                }


                if ($buffer) {
                    return '<div class="alert alert-success alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-check"></i> Success !</h4>
        				Anda terhubung dengan mesin.
        			</div>';
                } else {
                    return '<div class="alert alert-danger alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
        				Anda tidak terhubung dengan mesin !
        			</div>';
                }
            }
        }
    }

    public function get()
    {
        return $this->db->select('*')->from('data_absen')->get()->result();
    }
    public function get_karyawan($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from('tb_karyawan');
        $this->db->where('id_karyawan', $id_karyawan);
        $res = $this->db->get()->row();
        return $res;
    }
    public function get_user()
    {
        error_reporting(0);
        $IP = $this->get_setting()->ip;
        // $Key = $this->get_setting()->password;
        $Key = 0;
        if ($IP != "") {
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $soap_request = "<GetAllUserInfo><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAllUserInfo>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
                var_dump($buffer);
                die;
                $buffer = Parse_Data($buffer, "<GetAllUserInfo>", "</GetAllUserInfo>");

                $buffer = explode("\r\n", $buffer);
                for ($a = 0; $a < count($buffer); $a++) {
                    $data = Parse_Data($buffer[$a], "<Row>", "</Row>");
                    $PIN = Parse_Data($data, "<PIN>", "</PIN>");
                    $Name = Parse_Data($data, "<Name>", "</Name>");
                    $Password = Parse_Data($data, "<Password>", "</Password>");
                    $Group = Parse_Data($data, "<Group>", "</Group>");
                    $Privilage = Parse_Data($data, "<Privilage>", "</Privilage>");
                    $Card = Parse_Data($data, "<Card>", "</Card>");
                    $PIN2 = Parse_Data($data, "<PIN2>", "</PIN2>");
                    $TZ1 = Parse_Data($data, "<TZ1>", "</TZ1>");
                    $TZ2 = Parse_Data($data, "<TZ2>", "</TZ2>");
                    $TZ3 = Parse_Data($data, "<TZ3>", "</TZ3>");

                    // $ins = array(
                    //     "pin"       =>  $PIN,
                    //     "date_time" =>  $DateTime,
                    //     "ver"        =>  $Verified,
                    //     "status"    =>  $Status
                    // );
                    // if (!$this->if_exist_check($PIN, $DateTime) && $PIN && $DateTime) {
                    //     $this->db->insert('data_absen', $ins);
                    // }

                }
                if ($buffer) {
                    return '<div class="alert alert-success alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-check"></i> Success !</h4>
        				Anda terhubung dengan mesin.
        			</div>';
                } else {
                    return '<div class="alert alert-danger alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
        				Anda tidak terhubung dengan mesin !
        			</div>';
                }
            }
        }
    }
    public function hapus_yg_ada($PIN)
    {
        $this->db->where('pin', $PIN);
        $this->db->where('status', 0);
        $this->db->where('DATE(date_time_out)', date('Y-m-d', strtotime('0000-00-00')));
        $res =  $this->db->delete('data_absen');
        return $res;
    }
    public function add_employee($id_karyawan, $nama_karyawan)
    {
        error_reporting(0);
        $IP = $this->get_setting()->ip;
        // $Key = $this->get_setting()->password;
        $Key = 0;
        if ($IP != "") {
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $id = $id_karyawan;
                $nama = $nama_karyawan;
                $soap_request = "<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN>" . $id . "</PIN><Name>" . $nama . "</Name></Arg></SetUserInfo>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
                $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
                $buffer = explode("\r\n", $buffer);
                $buffer = Parse_Data($buffer, "<Information>", "</Information>");
                return $buffer;
            }
        }
    }
    public function update_finger()
    {
        $IP = $this->get_setting()->ip;
        // $Key = $this->get_setting()->password;
        $Key = 0;
        if ($IP != "") {
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $id = "2";
                $nama = "userBaru";
                $fn = "0";
                $temp = "0";
                $soap_request = "<SetUserTemplate><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">" . $id . "</PIN><FingerID xsi:type=\"xsd:integer\">" . $fn . "</FingerID><Size>" . strlen($temp) . "</Size><Valid>1</Valid><Template>" . $temp . "</Template></Arg></SetUserTemplate>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
                $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
                $buffer = explode("\r\n", $buffer);
                $buffer = Parse_Data($buffer, "<Information>", "</Information>");
                return $buffer;
            }
        }
    }
    public function get_finger()
    {
        error_reporting(0);
        $IP = $this->get_setting()->ip;
        $Key = 0;
        if ($IP != "") {
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $id = "1";
                $nama = "userBaru";
                $fn = "6";
                $temp = "0";
                $soap_request = "<GetUserTemplate><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">" . $id . "</PIN><FingerID xsi:type=\"xsd:integer\">" . $fn . "</FingerID></Arg></GetUserTemplate>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
                $buffer = Parse_Data($buffer, "<GetUserTemplateResponse>", "</GetUserTemplateResponse>");
                $buffer = explode("\r\n", $buffer);
                for ($a = 0; $a < count($buffer); $a++) {
                    $data = Parse_Data($buffer[$a], "<Row>", "</Row>");
                    $PIN = Parse_Data($data, "<PIN>", "</PIN>");
                    $FingerID = Parse_Data($data, "<FingerID>", "</FingerID>");
                    $Size = Parse_Data($data, "<Size>", "</Size>");
                    $Valid = Parse_Data($data, "<Valid>", "</Valid>");
                    $Template = Parse_Data($data, "<Template>", "</Template>");
                    $ins = array(
                        'user_id' => $PIN,
                        'finger_id' => $FingerID,
                        'size' => $Size,
                        'valid' => $Valid,
                        'template' => $Template
                    );
                    // var_dump($PIN);
                    $this->db->insert('data_finger', $ins);
                }
                if ($buffer) {
                    return '<div class="alert alert-success alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-check"></i> Success !</h4>
        				Anda terhubung dengan mesin.
        			</div>';
                } else {
                    return '<div class="alert alert-danger alert-dismissable">
        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
        				Anda tidak terhubung dengan mesin !
        			</div>';
                }
            }
        }
    }
}
