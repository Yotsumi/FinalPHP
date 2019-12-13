<?php $this->layout('layout', ['title' => $title]) ?>

<?php if ($articleNotFound): ?>
    <script>
        alert("Articolo non trovato")
        window.location.assign("/");
    </script>
<?php endif; ?>


<h2><?=$this->e($title)?></h2>
<p><?=$this->e($contenuto)?></p>
<div><?=$this->e($autore)?></div>
<div><?=$this->e($data)?></div>
<a href="/">Back to home</a>