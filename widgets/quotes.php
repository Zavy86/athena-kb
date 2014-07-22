<?php
 $quotes=array(
  array("Nel mondo incontrerai 10 tipi di persone, chi capisce il codice binario e chi no.","Anonymous"),
  array("A volte il vincitore è semplicemente chi non ha mai mollato.","Jim Morrison"),
  array("Il vero signore è lento nel parlare e rapido nell'agire.","Confucio")
 );
 $quote=$quotes[rand(0,count($quotes)-1)];
?>
<div id="widget">
 <p><i>"<?php echo $quote[0]; ?>"</i></p>
 <p style="text-align:right">&minus; <?php echo $quote[1]; ?></p>
</div>