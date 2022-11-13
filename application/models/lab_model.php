<?php
Class lab_model extends CI_Model
{
    function AmbilLab()
    {
        $this->db->select('*, lab.id AS id_lab');
        $this->db->from('lab');
        $this->db->join('users', 'users.id = lab.id_user', 'left');
        $res = $this->db->get();
        return $res;
    }

    function AmbilLabWhr($id)
    {
        $dat = array(
            'lab.id' => $id,
        );
        $this->db->where($dat);
        $this->db->from('lab');
        $this->db->join('users', 'users.id = lab.id_user', 'left');
        $res = $this->db->get();
        return $res;
    }

    function CekProperti($id)
    {
        $dat = array(
            'id' => $id,
        );

        $res = $this->db->get_where('properti', $dat);
        return $res;
    }

    function CekLab($nama, $id)
    {
        $dat = array(
            'nama_lab' => $nama,
            'id !=' => $id,
        );

        $res = $this->db->get_where('lab', $dat);
        return $res;
    }
    
    function TambahLab($nama, $id)
    {
        $dat = array(
            'nama_lab' => $nama,
            'id_user' => $id,
        );

        $this->db->insert('lab',$dat);
        return $this->db->error();
    }

    function UbahLab($nama, $id, $id_lab)
    {
        $dat = array(
            'nama_lab' => $nama,
            'id_user' => $id,
        );

        $whr = array(
            'id' => $id_lab,
        );

        $this->db->where($whr);
        $this->db->set($dat);
        $this->db->update('lab');
        return $this->db->error();
    }

    function UbahProperti($id, $x, $y)
    {
        $this->db->set('xPos', $x);
        $this->db->set('yPos', $y);
        $this->db->where('id', $id);
        $this->db->update('properti');
        return $this->db->error();
    }
}
?>