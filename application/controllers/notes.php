<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

  public function main()
  {
    $result['notes'] = $this->notes_model->get_all_notes();
    $this->load->view('notes_main', $result);
  }

  public function addanote()
  {
    $success =$this->notes_model->add_a_note($this->input->post('noteTitle'), $this->input->post('noteText'));
    $add_note_result['note_id'] = $success;
    $add_note_result['action'] = 'addNote';
    echo json_encode($add_note_result);
  }

  public function deleteanote($id)
  {
    if($this->notes_model->delete_a_note($id)) {
      $delete_note_result['action'] = 'deletedNote';
    }
    echo json_encode($delete_note_result);
  }

  public function updatetitle($id)
  {
    $input['title'] = $this->input->post('title-content');
    $input['text'] = '';
    $input['id'] = $id;
    $this->notes_model->update_a_note($input);
  }

  public function updatetext($id)
  {
    $input['title'] = '';
    $input['text'] = $this->input->post('text-content');
    $input['id'] = $id;
    $this->notes_model->update_a_note($input);
  }
}

/* End of file notes.php */
/* Location: ./application/controllers/welcome.php */