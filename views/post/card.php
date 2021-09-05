

<div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= $post->getName() ?> </h5>
                <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?> ::

                    <?php foreach($post->getCategories() as $k=>$category): ?>
                        <?php if($k>0): ?>
                            ,       
                        <?php endif ?>    
                        <a href="<?= $router->generate('category',['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"> <?= htmlentities($category->getName())  ?> </a>
                    <?php endforeach ?>
                
                </p>
                
                <p><?= $post->getExcerpt() ?></p>
                <p>
                    <a href="<?= $router->generate('post',['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
                </p>
            </div>
        </div>