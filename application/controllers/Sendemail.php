<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendemail extends CI_Controller {

 public function index()
 {
       $data['page_title'] = 'Interactive Tutorials';
      $data['page_name'] = 'interactive';
      // $data['tutorials'] = $tutorials;
      $data['active'] = 'interactive';
      $this->load->view('frontend/index', $data, FALSE);
 }

 public function send()
 {
  $subject = 'Application for Programmer Registration By - ' . $this->input->post("name");
  $programming_languages = implode(", ", $this->input->post("programming_languages"));
  $file_data = $this->upload_file();
  if(is_array($file_data))
  {
   $message = '
   <h3 align="center">Programmer Details</h3>
    <table border="1" width="100%" cellpadding="5">
     <tr>
      <td width="30%">Name</td>
      <td width="70%">'.$this->input->post("name").'</td>
     </tr>
     <tr>
      <td width="30%">Address</td>
      <td width="70%">'.$this->input->post("address").'</td>
     </tr>
     <tr>
      <td width="30%">Email Address</td>
      <td width="70%">'.$this->input->post("email").'</td>
     </tr>
     <tr>
      <td width="30%">Progamming Language Knowledge</td>
      <td width="70%">'.$programming_languages.'</td>
     </tr>
     <tr>
      <td width="30%">Experience Year</td>
      <td width="70%">'.$this->input->post("experience").'</td>
     </tr>
     <tr>
      <td width="30%">Phone Number</td>
      <td width="70%">'.$this->input->post("mobile").'</td>
     </tr>
     <tr>
      <td width="30%">Additional Information</td>
      <td width="70%">'.$this->input->post("additional_information").'</td>
     </tr>
    </table>
   ';

   $config = Array(
         'protocol'  => 'smtp',
         'smtp_host' => 'smtpout.secureserver.net',
         'smtp_port' => 80,
         'smtp_user' => 'mjabir42@gmail.com', 
         'smtp_pass' => 'password', 
         'mailtype'  => 'html',
         'charset'  => 'iso-8859-1',
         'wordwrap'  => TRUE
      );
   // $file_path = './uploads/attach/' . $file_name;
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from($this->input->post("email"));
      $this->email->to('mjabir42@gmail.com');
      $this->email->subject($subject);
         $this->email->message($message);
         $this->email->attach($file_data['full_path']);
         if($this->email->send())
         {
          if(delete_files($file_data['file_path']))
          {
           $this->session->set_flashdata('message', 'Application Sended');
           // redirect('sendemail');
           $data['page_title'] = ucwords($type).' Tutorials';
      $data['page_name'] = 'interactive';
      // $data['tutorials'] = $tutorials;
      $data['active'] = $type;
      $this->load->view('frontend/index', $data, FALSE);
          }
         }
         else
         {
          if(delete_files($file_data['file_path']))
          {
           $this->session->set_flashdata('message', 'There is an error in email send');
           redirect('sendemail');
          }
         }
     }
     else
     {
      $this->session->set_flashdata('message', 'There is an error in attach file');
         redirect('sendemail');
     }
 }



 function upload_file()
 {
  $config['upload_path'] = './uploads/attach/';
  $config['allowed_types'] = 'doc|docx|pdf';
  $this->load->library('upload', $config);
  if($this->upload->do_upload('resume'))
  {
   return $this->upload->data();   
  }
  else
  {
   return $this->upload->display_errors();
  }
 }
}
