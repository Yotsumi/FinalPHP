<?php $this->layout('layout', ['title' => 'Manage Users']) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<h1><?=$this->e($title)?></h1>

<ul>
<?php foreach($args as $user): ?>
    <li>
    <div>
        <span style="font-weight:bold;"><?= $this->e($user->getUsername())?> </span>
        <?php if ($user->getAbilitato() == true) : ?>
             (admin)
        <?php else: ?>
            (editor)
        <?php endif; ?>
    </div>
    <form style="display:inline-block;" method="post">
        
        <input type="hidden" name="crudUsername" value="<?=$this->e($user->getUsername())?>" />
        <input type="submit" formaction="/usercrud/d" value="Delete">
    </form>
    <a style="display:inline-block;" href="/dashboarduser/<?= $this->e($user->getUsername()) ?>">
        <button>Edit</button>
    </a>
    </li>
<?php endforeach; ?>
</ul>