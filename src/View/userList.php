<?php $this->layout('layout', ['title' => 'Manage Users']) ?>

<ul>
<?php foreach($users as $user): ?>
    <li>
    <form method="post">
        <div><?=$this->e($user->getUsername())?></div>
        <input type="submit" formaction="usercrud/d" value="Delete">
        <input type="submit" formaction="dashboard/moduser" value="Modify">
    </form>
    </li>
<?php endforeach; ?>
</ul>