<?php $this->layout('layout', ['title' => 'Dashboard']) ?>
<form action="/logout" method="POST">
    <button>Logout</button>
</form>
<h1><?= $this->e('Dashboard'); ?></h1>

<h2>User Management</h2>
<ul>
    <li><a href="/dashboarduser/adduser">Add User</a></li>
    <li><a href="/dashboarduser/">Manage Users</a></li>
</ul>

<h2>Article Management</h2>
<ul>
    <li><a href="/dashboardarticle/addarticle">Add Article</a></li>
    <li><a href="/dashboardarticle/">Manage Articles</a></li>
</ul>