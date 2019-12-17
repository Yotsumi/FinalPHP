<?php $this->layout('layout', ['title' => $title]) ?>
<a href="/dashboard"><button>Back</button></a>
<br/>
<h1><?=$this->e($title)?></h1>
<?php foreach($args as $article): ?>
    <div style="display: inline-block; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; max-width: 20%; min-width: 10%; vertical-align: top;">
        <h2><?=$this->e($article->getTitolo())?></h2>
        <br/>
        <a href="/dashboardarticle/<?= $this->e($article->getTitolo())?>">
            <button style="float:left; margin-right:0.5em;">Edit</button>
        </a>
        <form method="post">
        <input type="submit" formaction="/articlecrud/d" value="Delete">
        <p><?=$this->e($article->getContenuto())?></p>
        <div><?=$this->e($article->getAutore())?></div>
        <div><?=$this->e($article->getData())?></div>
        </form>
    </div>
<?php endforeach; ?>