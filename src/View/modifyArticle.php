<?php $this->layout('layout', ['title' => 'Modify Article']) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<br/>
<?php if(empty($args)): ?>
    <script>
        alert("Articolo non trovato")
        window.location.assign("/dashboardarticle");
    </script>
<?php else: ?>
    <h1><?= $this->e($title) ?></h1>

    <form action="/articlecrud/u" method="POST">
        Title:<br>
        <input type="text" name="title" value="<?=$this->e($args->getTitolo())?>"><br>
        Date:<br>
        <input type="date" name="data" value="<?=$this->e($args->getData())?>"><br>
        Content:<br>
        <textarea rows="12" cols="70" name="content"><?=$this->e($args->getContenuto())?></textarea><br>
        Author:<br>
        <input type="text" name="author" value="<?=$this->e($args->getAutore())?>"><br>
        <input type="hidden" name="id" value="<?=$this->e($args->getId())?>">
        <input type="submit" value="Confirm">
    </form>
<?php endif; ?>