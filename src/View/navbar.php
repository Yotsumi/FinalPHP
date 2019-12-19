<?php if($user !== ''): ?>
    <form style="display:inline-block;" action="/logout" method="POST">
        <button>Logout</button>
    </form>
<?php endif; ?>

<?php foreach($buttons AS $text => $url): ?>
    <a style="display:inline-block;" href="<?= $this->e($url) ?>"><button><?= $this->e($text) ?></button></a>
<?php endforeach; ?>

<?php if($user !== ''): ?>
    <p style="display:inline;">@<?= $this->e($user) ?></p>
<?php endif; ?>
<br/>