<?php $this->layout('layout', ['title' => 'Modify Article']) ?>

<form action="articlecrud/u" method="POST">
    Title:<br>
    <input type="text" name="title" value="<?=$this->e($args[0]->getTitolo())?>"><br>
    Content:<br>
    <textarea rows="20" cols="50" name="content"><?=$this->e($args[0]->getContenuto())?></textarea><br>
    Author:<br>
    <input type="text" name="author" value="<?=$this->e($args[0]->getAutore())?>"><br>
    <input type="submit" value="Confirm">
</form>