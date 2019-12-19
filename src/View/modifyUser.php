<?php $this->layout('layout', ['title' => 'Edit User']) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<?php if(empty($args)): ?>
    <script>
        alert("Utente non trovato")
        window.location.assign("/dashboarduser");
    </script>
<?php else: ?>
    <h1><?= $this->e($title) ?></h1>

    <form action="/usercrud/u" method="POST">
        Username:<br>
        <input type="text" name="crudUsername" value="<?=$this->e($args[0]->getUsername()) ?>">
        <br>
        Password:<br>
        <input type="password" name="crudPassword" value="<?=$this->e($args[0]->getPassword())?>">
        <input type="hidden" name="oldPassword" value="<?= $this->e($args[0]->getUsername()) ?>">
        <br>
        <input type="hidden" name="crudId" value="<?= $this->e($args[0]->getHashUtente()) ?>">
        <input type="hidden" name="oldUsername" value="<?= $this->e($args[0]->getUsername()) ?>">
        <label>Admin
            <input type="checkbox" value="1" name="attivo" <?= ($args[0]->getAbilitato() == 1)? 'checked' : '' ?>/>
        </label>
        <br/>
        <input type="submit" value="Confirm">
    </form>
<?php endif; ?>