<?php $this->layout('layout', ['title' => $title]) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<br/>
<h1><?=$this->e($title)?></h1>
<?php if(count($args) == 0) : ?>
    <p>Nessun articolo trovato</p>
<?php else: ?>
<?php foreach($args as $article): ?>
    <div style="display:inline-block; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; max-width: 20%; min-width: 10%; vertical-align: top;">
        <h2><?=$this->e($article->getTitolo())?></h2>
        <br/>
        <form method="post" style="display:inline-block;">
            <input type="submit" formaction="/articlecrud/d" value="Delete">
            <input type="hidden" name="id" value="<?=$this->e($article->getId())?>">
        </form>
        <a style="display:inline-block; margin-right:0.5em;" href="/dashboardarticle/<?= str_replace(' ', '-', $this->e($article->getTitolo()))?>">
            <button>Edit</button>
        </a>    
        <p><?=$this->e($article->getContenuto())?></p>
        <div><?=$this->e($article->getAutore())?></div>
        <div><?=$this->e($article->getData())?></div>
        
    </div>
<?php endforeach; ?>
<?php endif; ?>

