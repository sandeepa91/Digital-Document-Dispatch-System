<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        
        $this->load->model('document_handle');
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('/document/document_manager');
    }
    
    public function document_manager()
    {   
        $fieldset = array('DocTypeId', 'TypeName', 'Description');
        $data['doctypes'] = $this->document_handle->getData($fieldset, 'mdm_documenttype');
        $this->load->view('document_create',$data);
        
    }
    
    public function add_document(){
        $document_id = $this->input->post("document_id", TRUE);
        $Date = $this->input->post("capture_date", TRUE);
        $Remarks = $this->input->post("remarks", TRUE);
        $document_type = $this->input->post("document_type", TRUE);
        $LocationId = $this->input->post("location", TRUE);
        $Content = $this->input->post("document_content", TRUE);

        $DataSet = array('DocId' => $document_id, 'CaptureDate' => $Date, 'Remarks' => $Remarks, 'DocTypeId' => $document_type,
            'LocationId' => $LocationId,'Content' => $Content, 'mdm_documenttype_DocTypeId' => $document_type, 'status' => "0");

        //Query For Editor insertion
        //var_dump($DataSet);
        $insert_id = $this->document_handle->insertData("document", $DataSet);
       // var_dump($insert_id);  die();
        if ($insert_id > 0) {

            $config['upload_path'] = './uploads/FreshCopy';
            $config['allowed_types'] = 'doc|docx|odt';
            $config['file_name'] = $document_id;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("upload_file")) {
                echo $this->upload->display_errors();
            }

            $success = array('Success' => "Successfully Added!");
            redirect(base_url() . 'index.php/document', $success);
            //Todo; send email
        } else {
            $Error = array('Error' => "Error Detected!");
            redirect(base_url() . 'index.php/document', $Error);
        }
    }
}