<table class="table table-striped table-hover table-condensed">
 <thead>
  <tr>
   <th class='text-center'>#</th>
   <th width='100%'>{index-title}</th>
  </tr>
 </thead>
 <tbody>
  <?php
   foreach($contents as $index=>$content){
    echo "<tr>\n";
    echo "<td class='text-center'><a href='?controller=view&idContent=".$content->id."'>#".$content->id."</a></td>\n";
    echo "<td>".$content->title."</td>\n";
    echo "</tr>\n";
   }
  ?>
 </tbody>
</table>