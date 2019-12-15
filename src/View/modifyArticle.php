<?php $this->layout('layout', ['title' => 'Modify Article']) ?>

<form action="articlecrud/u" method="POST">
    Title:<br>
    <input type="text" name="title" value="<?=$this->e($article->getTitolo())?>"><br>
    Content:<br>
    <textarea rows="20" cols="50" name="content"><?=$this->e($article->getContenuto())?></textarea><br>
    Author:<br>
    <input type="text" name="author" value="<?=$this->e($article->getAutore())?>"><br>
    <input type="submit" value="Confirm">
</form>