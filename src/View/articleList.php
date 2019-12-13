<?php $this->layout('layout', ['title' => 'Manage Articles']) ?>

<?php foreach($articles as $article): ?>
    <div style="display: inline-block; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px; max-width: 20%; min-width: 10%; vertical-align: top;">
        <h2><?=$this->e($article->getTitolo())?></h2>
        <p><?=$this->e($article->getContenuto())?></p>
        <div><?=$this->e($article->getAutore())?></div>
        <div><?=$this->e($article->getData())?></div>
        <input type="button" action="" value="Delete">
        <input type="button" action="" value="Modify">
    </div>
<?php endforeach; ?>