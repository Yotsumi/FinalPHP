<?php $this->layout('layout', ['title' => 'Home']) ?>
<a href="/login"><button>Login</button></a>
<br/>
<h1><?= $this->e($title) ?></h1>
<h1>Home page</h1>

<?php foreach($articles as $article): ?>
    <div style="display: inline-block; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; max-width: 20%; min-width: 10%; vertical-align: top;">
        <h2><a href="<?='/article/'.str_replace(' ', '-', $this->e($article->getTitolo()))?>">
            <?=$this->e($article->getTitolo())?>
        </a></h2>
        <p><?=$this->e($article->getContenuto())?></p>
        <div><?=$this->e($article->getAutore())?></div>
        <div><?=$this->e($article->getData())?></div>
    </div>
<?php endforeach; ?>
