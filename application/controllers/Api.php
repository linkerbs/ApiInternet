<?php
require APPPATH . '/libraries/REST_Controller.php';
class api extends \Restserver\Libraries\REST_Controller {
 
 function __construct($config = 'rest') {
 parent::__construct($config);
 } 
 
 function index_get($id = 0) {
    if(!empty($id)){
    $plan = $this->db->get_where("plan", ['Id' => $id])->row_array();
    }
    else
    {
    $plan = $this->db->get("plan")->result();
    }
    $this->response($plan, 200);
 }


 function index_post() {
 $data = array(
 'proveedor' => $this->input->post('proveedor'),
 'velocidad' => $this->input->post('velocidad'),
 'calidad' => $this->input->post('calidad'),
 'precio' => $this->input->post('precio'),
 );
 $insert = $this->db->insert('plan', $data);
 if ($insert) {
 $this->response($data, 201);
 } else {
 $this->response(array('status' => 'fail', 400));
 }
 }
 
 function index_put() {
 $id = $this->put('Id');
 $data = array(
 'proveedor' => $this->put('proveedor'),
 'velocidad' => $this->put('velocidad'),
 'calidad' => $this->put('calidad'),
 'precio' => $this->put('precio'),
 );
 $this->db->where('Id', $id);
 $update = $this->db->update('plan', $data);
 if ($update) {
 $this->response($data, 200);
 } else {
 $this->response(array('status' => 'fail', 400));
 }
 }
 
 function index_delete() {
 $id = $this->delete('Id');
 $this->db->where('Id', $id);
 $delete = $this->db->delete('plan');
 if ($delete) {
 $this->response(array('status' => 'success'), 200);
 } else {
 $this->response(array('status' => 'fail', 404));
 }
 }
}