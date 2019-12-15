<?php $this->layout('layout', ['title' => $title]) ?>

<h1><?= $this->e($title); ?></h1>
<div class="content">
    <?php $this->insert($view); ?>
</div>

