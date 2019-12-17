<?php $this->layout('layout', ['title' => $title]) ?>
<a href="/dashboard">Back</a>
<br/>
<?php foreach($args as $article): ?>
    <div style="display: inline-block; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; max-width: 20%; min-width: 10%; vertical-align: top;">
        <form method="post">
        <h2><?=$this->e($article->getTitolo())?></h2>
        <input type="submit" formaction="articlecrud/d" value="Delete">
        <input type="submit" formaction="dashboardarticle/<?= $this->e($article->getTitolo())?>" value="Modify">
        <p><?=$this->e($article->getContenuto())?></p>
        <div><?=$this->e($article->getAutore())?></div>
        <div><?=$this->e($article->getData())?></div>
        </form>
    </div>
<?php endforeach; ?>