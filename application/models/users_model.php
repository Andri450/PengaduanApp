<?php
Class users_model extends CI_Model
{
    function CekLogin($email, $pass)
    {
        $dat = array(
            'email' => $email,
        );

        $this->db->where($dat);
        $jum = $this->db->get('users')->num_rows();
        $resk = $this->db->get('users')->result();

        if($jum == 1){

            if($resk[0]->role == 'rt'){
                $this->db->select('*, users.id AS id_user');
                $this->db->where($dat);
                $res = $this->db->get('users')->result();    
            }else{
                $this->db->select('*, users.id AS id_user');
                $this->db->from('users');
                $this->db->join('lab', 'users.id_lab = lab.id');
                $this->db->where($dat);
                $res = $this->db->get()->result();
            }
            
            if(password_verify($pass,$res[0]->password)){
                $data_login = array(
                    'is_login' => TRUE,
                    'email'    => $res[0]->email,
                    'id'       => $res[0]->id_user,
                    'r'        => $res[0]->role,
                    'id_lab'   => $res[0]->id_lab,
                    'nama_lab' => $res[0]->nama_lab,
                    'nama_user'=> $res[0]->nama,
                    'nip_user' => $res[0]->NIP
                );
             
                $this->session->set_userdata($data_login);

                return 'ok';
            }else{
                return 'no';
            }

        }else{
            return 'no';
        }
        
    }

    function AmbilUserKalab()
    {
        $dat = array(
            'role' => 'kalab',
            'lab.id_user' => null,
        );

        $this->db->from('lab');
        $this->db->join('users', 'users.id = lab.id_user', 'right');
        $this->db->where($dat);
        $res = $this->db->get();
        return $res;
    }

    function AmbilUserTeknisi()
    {
        $dat = array(
            'role' => 'teknisi',
            'id_lab' => null,
        );

        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function AmbilSemuaUserKalab()
    {
        $dat = array(
            'role' => 'kalab',
        );

        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function AmbilSemuaUserTeknisiLab($id_lab)
    {
        $dat = array(
            'role' => 'teknisi',
            'id_lab' => $id_lab,
        );

        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function CekEmailUserTambah($email)
    {
        $dat = array(
            'email' => $email,
        );

        $res = $this->db->get_where('users', $dat);
        return $res;
    }

    function CekEmailUser($email, $id)
    {
        $dat = array(
            'email' => $email,
            'id !=' => $id,
        );

        $res = $this->db->get_where('users', $dat);
        return $res;
    }

    function TambahKalab($nip, $nama, $email)
    {
        $dat = array(
            'NIP' => $nip,
            'nama' => $nama,
            'email' => $email,
            'role' => 'kalab',
        );

        $this->db->insert('users',$dat);
        return $this->db->error();
    }

    function TambahTeknisi($nama, $email, $id_lab)
    {
        $dat = array(
            'nama' => $nama,
            'email' => $email,
            'role' => 'teknisi',
            'id_lab' => $id_lab,
        );

        $this->db->insert('users',$dat);
        return $this->db->error();
    }

    function AmbilUserWhr($id)
    {
        $dat = array(
            'id' => $id,
        );
        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function UbahKalab($nama, $id, $email)
    {
        $dat = array(
            'nama' => $nama,
            'email' => $email,
        );

        $whr = array(
            'id' => $id,
        );

        $this->db->where($whr);
        $this->db->set($dat);
        $this->db->update('users');
        return $this->db->error();
    }

    function UbahTeknisi($nama, $id, $email)
    {
        $dat = array(
            'nama' => $nama,
            'email' => $email,
        );

        $whr = array(
            'id' => $id,
        );

        $this->db->where($whr);
        $this->db->set($dat);
        $this->db->update('users');
        return $this->db->error();
    }

    function HapusKalab($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');

        $dat = array(
            'id_user' => 0,
        );

        $this->db->where('id_user', $id);
        $this->db->set($dat);
        $this->db->update('lab');
        return $this->db->error();
    }

    function HapusTeknisi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');

        return $this->db->error();
    }

    function GantiPassword($id, $pass)
    {
        $dat = array(
            'password' => password_hash($pass,PASSWORD_DEFAULT),
        );

        $this->db->where('id', $id);
        $this->db->set($dat);
        $this->db->update('users');
    }

}
?>