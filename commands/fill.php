<?php 
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/db/db.php';
$faker = Faker\Factory::create('fr_FR');

// vider les tables
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$idPosts = [];
$idCategories = [];

// Insertion article
for ($i=0; $i < 50 ; $i++) { 
  $pdo->exec("INSERT INTO post SET name='{$faker->name} ', slug ='{$faker->name}', created_at='{$faker->date} . {$faker->time}', content ='{$faker->name}'");
  // On récupère et push les id pour faire les liens article-catégorie
  $idPosts[] = $pdo->lastInsertId();
}

// insertion catégorie
for ($i=0; $i <50 ; $i++) { 
  $pdo->exec("INSERT INTO category SET name='{$faker->name} ', slug ='{$faker->name}'");
  $idCategories[] = $pdo->lastInsertId();
}

// insertion lien post-catégories
foreach($idPosts as $idPost){
  $randomCategories = $faker->randomElements($idCategories,rand(0,count($idCategories)));
  foreach($randomCategories as $idCategory){
    $pdo->exec("INSERT INTO post_category SET post_id=$idPost, category_id=$idCategory ");
  }
}

// Insertion user admin test
$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec(("INSERT INTO user SET username='admin', password ='$password' "))


?>