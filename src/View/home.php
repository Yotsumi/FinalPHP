<?php 
$title = 'Home';
$this->layout('layout', ['title' => $title]) ?>
<?php $this->insert('navbar', ['buttons' => $btn, 'user' => $user]); ?>

<?php if (empty($articles)): ?>
    <p>No articles found</p>
<?php else: ?>
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
<?php endif; ?>

