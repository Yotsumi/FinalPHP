<?php $this->layout('layout', ['title' => 'Add Article']) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<h1><?=$this->e($title)?></h1>

<form action="/articlecrud/c" method="POST">
    Title:<br>
    <input type="text" name="title"><br>
    Date:<br>
    <input type="date" name="data"><br>
    Content:<br>
    <textarea rows="12" cols="70" name="content" placeholder="Insert text here"></textarea><br>
    Author:<br>
    <input type="text" name="author"><br>
    <input type="submit" value="Confirm">
</form>