<div id="widget" class="navigation">
 <ul class="navigation">
  <?php
   global $settings;
   foreach($settings['navigation'] as $navigation_item){
    echo "<li><a href=".$navigation_item[1].">".$navigation_item[0]."</a></li>\n";
   }
  ?>
 </ul>
</div>