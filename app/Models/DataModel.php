<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class DataModel extends Model{
    
    function __construct() {
        parent::__construct();
    }

    function _get_datatables_query($tipe) {

    }

    function get_datatables($tipe) {
        $this->_get_datatables_query($tipe);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($tipe) {
        $this->_get_datatables_query($tipe);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //GET LIST
    function getList($table, $field, $where)
    {
        return $this->db->select($field)->get_where($table, $where);
    }
}