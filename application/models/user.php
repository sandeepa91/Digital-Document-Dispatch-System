<?php

class User extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_pass($email)
    {
        $this->db->select('id, password,role,Mdm_employee_EmpId,mdm_employee.LocationId');
        $this->db->from('userdetails');
        $this->db->join('mdm_employee', 'userdetails.mdm_employee_EmpId = mdm_employee.EmpId', 'inner');
        $this->db->where('UserId', $email);
        $res = $this->db->get();
        $arr = $res->result();
        if ($res->num_rows() > 0) {
            return $arr[0];
        } else {
            return NULL;
        }
    }

    public function get_user($id) {
        $this->db->select('EmpId,EmployeeNumber,EmployeeName,Designation,BoardGrade,LocationId,title,account');
        $this->db->from('mdm_employee');
        $this->db->where('EmpId', $id);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $Employee = $result->result()[0];
 
            return $Employee;
        } else {
            return null;
        }
    }
    
    public function get_system_user($id) {
        $this->db->select('Id,UserId,Password,EmpId,mdm_employee_EmpId,role');
        $this->db->from('userdetails');
        $this->db->where('EmpId', $id);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $Employee = $result->result()[0];
 
            return $Employee;
        } else {
            return null;
        }
    }
    
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
    
    
    
    public function update($fieldset, $tableName, $id)
    {
        $this->db->where('EmpId',$id);
        $this->db->update($tableName, $fieldset);
    }
    
    public function get_users_data($id)
    {
        $this->db->select('userdetails.mdm_employee_EmpId,
mdm_employee.EmpId,
mdm_employee.account,
mdm_employee.EmployeeName,
mdm_employee.Designation,
userdetails.EmpId,
userdetails.UserId,
userdetails.role,
userdetails.Id');
        $this->db->from('userdetails');
        $this->db->join('mdm_employee', 'userdetails.mdm_employee_EmpId = mdm_employee.EmpId', 'inner');
        $this->db->where('mdm_employee.account', $id);
        return $this->db->get()->result();
    }
 public function get_employee_data()
    {
        $this->db->select('EmpId, EmployeeNumber, EmployeeName, Designation, BoardGrade, LocationId, title, account');
        $this->db->from('mdm_employee');
        //$this->db->where('');
        return $this->db->get()->result();
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
