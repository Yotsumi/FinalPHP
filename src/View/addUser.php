<?php $this->layout('layout', ['title' => 'Add Users']) ?>

<form action="usercrud/c" method="POST">
    Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" value="Confirm">
</form>