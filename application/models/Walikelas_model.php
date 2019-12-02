<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Walikelas_model extends CI_Model
{
    public function getDataSiswa()
    {
        $query = "SELECT `walikelas`.*,`data_siswa`.`kelas`
                    FROM `walikelas` JOIN  `data_siswa`
                      ON `walikelas`.`kelas_binaan` = `data_siswa`.`kelas`
        ";

        return $this->db->query($query)->result_array();
    }
}
