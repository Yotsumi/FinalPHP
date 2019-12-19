<?php $this->layout('layout', ['title' => 'Edit User']) ?>
<a href="/dashboarduser"><button>Back</button></a>
<br/>
<h1><?= $this->e($title) ?></h1>

<form action="/usercrud/u" method="POST">
    Username:<br>
    <input type="text" name="crudUsername" value="<?=$this->e($args[0]->getUsername()) ?>">
    <br>
    Password:<br>
    <input type="password" name="crudPassword" value="<?=$this->e($args[0]->getPassword())?>">
    <br>
    <input type="hidden" name="crudId" value="<?= $this->e($args[0]->getHashUtente()) ?>">
    <label>Attivo
        <input type="checkbox" value="1" name="attivo" <?= ($args[0]->getAbilitato() == 1)? 'checked' : '' ?>/>
    </label>
    <br/>
    <input type="submit" value="Confirm">
</form>