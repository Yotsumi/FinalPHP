<?php $this->layout('layout', ['title' => 'Add Users']) ?>

<form action="usercrud/u" method="POST">
    Username:<br>
    <input type="text" name="username" value="<?php $this->e($user->getUsername()) ?>"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" value="Confirm">
</form>