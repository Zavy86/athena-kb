<h1><?php echo $page->title; ?></h1>
<div class="content"><?php echo $page->content; ?></div>
<br>
<form action="?module=helloworld&action=changeName" method="post">
 <label for="name">What's your name? <input type="text" name="name" value="<?php echo $page->name;?>"></label>
 <input type="submit">
</form>