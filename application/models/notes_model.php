<?php
  class notes_model extends CI_model
  {
      public function add_a_note($noteTitle, $noteText) 
      {
        $this->db->query("INSERT INTO notes (title, description, created_at, updated_at) VALUES ('".$noteTitle."', '".$noteText."', now(), now());");
        return $this->db->insert_id();
      }

      public function get_all_notes()
      {
        return $this->db->query("SELECT * FROM notes")->result_array();
      }

      public function delete_a_note($id)
      {
        return $this->db->query("DELETE FROM notes WHERE id= '$id';");
      }

      public function update_a_note($input)
      {
        if($input['title'] != '')
        {
          $query = "UPDATE notes SET title = ?, updated_at = NOW() WHERE id = ?";
          $values = array($input['title'], $input['id']);
          return $this->db->query($query, $values);
        } else if ($input['text'] != '')
        {
          $query = "UPDATE notes SET description = ?, updated_at = NOW() WHERE id = ?";
          $values = array($input['text'], $input['id']);
          return $this->db->query($query, $values);
        }
      }
  }
?>