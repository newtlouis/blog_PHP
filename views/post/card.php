<?php 
$categories = [];
foreach($post->getCategories() as $category){
    $url = $router->generate('category',['id' => $category->getID(), 'slug' => $category->getSlug()]) ;
    $categories[] = <<<HTML
        <a href="{$url}"> {$category->getName()} </a>
    HTML;
}
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"> <?= $post->getName() ?> </h5>
        <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?>
            <?php if (!empty($post->getCategories())): ?>
                ::
                <?= implode(',' , $categories) ?>
            <?php endif ?>
        
        <p><?= $post->getExcerpt() ?></p>
        <p>
            <a href="<?= $router->generate('post',['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
        </p>
    </div>
</div>