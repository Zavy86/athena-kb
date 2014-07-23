<form role="form" action="?controller=edit&action=save" method="post">

 <input type="hidden" name="id" value="<?php echo $content->id; ?>">

 <div class="form-group">
  <input type="text" name="title" class="form-control input-lg" placeholder="{title}" value="<?php echo $content->title; ?>">
 </div>

 <div class="form-group">
  <textarea name="content" id="content" class="form-control" placeholder="{content}" rows="20"><?php echo $content->title; ?></textarea>
 </div>

 <div class="form-group">
  <input type="submit" class="btn btn-primary" value="{form-save}">
  <?php
   if($content->id>0){
    echo "<a class='btn btn-default' href='?controller=view&idContent=".$content->id."'>{form-cancel}</a>\n";
    echo "<a class='btn btn-danger' href='?controller=edit&action=delete&idContent=".$content->id."' onClick=\"return confirm('{form-delete-confirm}')\">{form-delete}</a>\n";
   }else{
    echo "<a class='btn btn-default' href='?controller=view&content=random'>{form-cancel}</a>\n";
   }
  ?>
 </div>

</form>