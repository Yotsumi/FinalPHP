<?php $this->layout('layout', ['title' => 'Manage Users']) ?>
<a href="/dashboard"><button>Back</button></a>
<br/>
<h1><?=$this->e($title)?></h1>

<ul>
<?php foreach($args as $user): ?>
    <li>
    <form style="display:inline-block;" method="post">
        <div><?=$this->e($user->getUsername())?></div>
        <input type="submit" formaction="usercrud/d" value="Delete">
    </form>
    <a style="display:inline-block;" href="/dashboarduser/<?= $this->e($user->getUsername()) ?>">
        <button>Edit</button>
    </a>
    </li>
<?php endforeach; ?>
</ul>