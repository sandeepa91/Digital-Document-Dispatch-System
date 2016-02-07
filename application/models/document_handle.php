<?php

class Document_handle extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_pass($email)
    {
        $this->db->select('id, password, first_name, last_name, title,  role');
        $this->db->from('userdetails');
        $this->db->where('UserId', $email);
        $res = $this->db->get();
        $arr = $res->result();
        if ($res->num_rows() > 0) {
            return $arr[0];
        } else {
            return NULL;
        }
    }
    public function get_documents($id)
    {
        $this->db->select('DocId, CaptureDate, Remarks, Content, DocTypeId, LocationId, mdm_documenttype_DocTypeId, status');
        $this->db->from('document');
        $this->db->where('LocationId', $id);
        return $this->db->get()->result();
    }

     
//    
//    public function get_all_articles($author_id = null)
//    {
//        $this->db->from('article');
//        if ($author_id != null) {
//            $this->db->where('author_id', $author_id);
//        }
//        return $this->db->get()->result();
//    }
    
    function loginLogSave($uid, $ipadd)
    {
        $uid = intval($uid);
        $data = array('user_id' => $uid, 'ip' => $ipadd);
        $this->db->insert('login_log', $data);
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getData($fieldset, $tableName, $where = '')
    {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function Update($fieldset, $tableName, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($tableName, $fieldset);
    }

    public function is_User($email)
    {
        if (isset($email)) {
            $this->db->select('id,email_address');
            $this->db->from('user');
            $this->db->where('email_address', $email);
            $res = $this->db->get();
            $arr = $res->result();
            if ($res->num_rows() > 0) {
                return $arr[0];
            } else {
                return NULL;
            }
        }
    }

    public function reset_pw($email, $password)
    {
        $password = sha1($password);
        $data = array('password' => $password);
        $this->db->where('email_address', $email);
        $this->db->update('user', $data);
    }

    public function get_editors()
    {
        $this->db->from('user');
        $this->db->where('role', "Editor");
        return $this->db->get()->result();
    }

    public function delete_user($email)
    {
        $this->db->where('email_address', $email);
        $this->db->delete('user');
    }
    
    public function deleteEditor($id) {
        $data = array('deleted' => 1);
        $this->db->where('id',$id);
        $this->db->update('user', $data);
        return 0;
    }

}
