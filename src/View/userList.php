<?php $this->layout('layout', ['title' => 'Manage Users']) ?>

<ul>
<?php foreach($users as $user): ?>
    <li>
        <div><?=$this->e($user->getUsername())?></div>
        <input type="button" action="" value="Delete">
        <input type="button" action="" value="Modify">
    </li>
<?php endforeach; ?>
</ul>