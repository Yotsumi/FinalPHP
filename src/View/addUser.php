<?php $this->layout('layout', ['title' => 'Add Users']) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<h1><?=$this->e($title)?></h1>
<form action="/usercrud/c" method="POST">
    Username:<br>
    <input type="text" name="crudUsername"><br>
    Password:<br>
    <input type="password" name="crudPassword"><br>
    <input type="submit" value="Confirm">
</form>