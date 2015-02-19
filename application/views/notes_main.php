<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Ajax Intermediate - Ajax Notes</title>
    <link rel="stylesheet" href="/assets/css/notes_main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $(document).on('submit', 'form', function() {
              var that = this;
              $.post (
                  $(this).attr('action'),
                  $(this).serialize(),
                  function(returnData) {
                    if(returnData['action'] === 'addNote'){
                        $('#displayNotes').prepend(
                            "<div class='box'>" + 
                              "<div>" +
                                // title form for update
                                '<form class="title" action="notes/updatetitle/'+returnData['note_id']+'" method="POST">'+
                                  '<input type="text" name="title-content" value="'+$(that).children('input[type="text"]').val()+'"/>'+
                                  // '<input type="hidden" name="title"'+returnData['note_id']+'"/>'+
                                '</form>'+
                                // END title form for update
                                
                                '<form class="delete" action="notes/deleteanote/'+returnData['note_id']+'">' +
                                  "<input class='deleteanote' type='submit' value='X'/>"+
                                '</form>'+
            
                              '</div>' +
                              // text content for update
                              '<form class="text" action="notes/updatetext/'+returnData['note_id']+'" method="POST">'+
                                '<textarea name="text-content">'+$(that).children('textarea').val()+'</textarea>'+
                                // '<input type="hidden" name="textarea" value="'+returnData['note_id']+'"/>'+
                              '</form>'+
                              // END text content for update
                            '</div>'
                        );
                    } else if(returnData['action'] === 'deletedNote') {
                      $(that).closest('div.box').fadeOut('slow', function() {
                        $(that).closest('div.box').remove();
                      })
                    } 
                  },
                  'json'
              );
              return false;
          });
          
          $(document).on('blur', 'form.title input[type="text"]', function() {
              $(this).parent('form.title').submit();              
          })

          $(document).on('blur', 'form.text textarea', function() {
              $(this).parent('form.text').submit();
          })
        
      });
    </script>
  </head>
  <body>
    <div id="wrapper">
      <h1>Notes</h1>
      <div id="displayNotes">
      <!-- Database result insert here -->
      <?php  
        foreach (array_reverse($notes) AS $value)
        {  
      ?>
          <div class="box">
            <div>
            <!-- title form for update -->
              <form class="title" action="notes/updatetitle/<?=$value['id']?>" method="POST">
                <input type="text" name="title-content" value="<?=$value['title']?>"/>
                <!-- <input type="hidden" name="title" value=""/> -->
              </form>
            <!-- END title form for update -->
              
              <form class="delete" action="notes/deleteanote/<?=$value['id']?>">
                <input class="deleteanote" type="submit" value="X"/>
              </form>
            
            </div>
            <!-- text content for update -->
              <form class="text" action="notes/updatetext/<?=$value['id']?>" method="POST">
                <textarea name="text-content"><?=$value['description']?></textarea>
                <!-- <input type="hidden" name="textarea" value=""/> -->
              </form>
            <!-- END text content for update -->
          </div>
      <?php   
        }
      ?>
      <!-- END of database result insert -->
      </div><!--
      --><div class="addNote">
        <form action="notes/addanote" method="POST">
          <input name="noteTitle" type="text" placeholder=" Title">
          <textarea name="noteText" placeholder=" Description"></textarea>
          <input class="submitanote" type="submit" value="Add Note"/>
        </form>
      </div>
    </div>
  </body>
</html>