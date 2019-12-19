<?php $this->layout('layout', ['title' => $title]) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<?php if ($isAdmin === '1'): ?>
    <h2>User Management</h2>
    <ul>
        <li><a href="/dashboarduser/adduser">Add User</a></li>
        <li><a href="/dashboarduser/">Manage Users</a></li>
    </ul>
<?php endif; ?>

<h2>Article Management</h2>
<ul>
    <li><a href="/dashboardarticle/addarticle">Add Article</a></li>
    <li><a href="/dashboardarticle/">Manage Articles</a></li>
</ul>