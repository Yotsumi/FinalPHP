<?php $this->layout('layout', ['title' => 'Modify Article']) ?>
<a href="/dashboardarticle"><button>Back</button></a>
<br/>
<h1><?= $this->e($title) ?></h1>

<form action="articlecrud/u" method="POST">
    Title:<br>
    <input type="text" name="title" value="<?=$this->e($args->getTitolo())?>"><br>
    Content:<br>
    <textarea rows="12" cols="70" name="content"><?=$this->e($args->getContenuto())?></textarea><br>
    Author:<br>
    <input type="text" name="author" value="<?=$this->e($args->getAutore())?>"><br>
    <input type="submit" value="Confirm">
</form>