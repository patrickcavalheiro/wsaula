<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    const table = 'usuario';

    public function get_all(){
        $query = $this->db->get(self::table);
        return $query->result();
    }

    public function get_one($id){
        if ($id > 0) {
            $this->db->where('id', $id);            
            $query = $this->db->get(self::table);
            return $query->row(0);
        }
    }

}

/* End of file Usuario_model.php */
