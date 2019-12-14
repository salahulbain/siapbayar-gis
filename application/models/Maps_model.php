<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maps_model extends CI_Model
{
    public function getDefault()
    {
        return $this->db->get('map')->row_array();
    }
}
