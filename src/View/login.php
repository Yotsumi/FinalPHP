<?php $this->layout('layout', ['title' => 'Admin login']) ?>

<h1>Login</h1>

<form method="post" action="/enter">
    <label for="user">Username</label><input type="text" name="user" />
    <br/><label for="pwd">Password</label> <input type="password" name="pwd" />
    <br/><input type="submit" value="Login" />
</form>

<p>Torna alla <a href="/">home</a></p>
