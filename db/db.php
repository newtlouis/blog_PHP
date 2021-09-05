<?php

// CONNECTION MYSQL
$dbname = "blog";
$servername = "localhost";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
// $text=" Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ut in id iste dignissimos distinctio, qui, sed corporis fugiat tempora ipsum neque ad, perferendis optio enim quos repellendus hic totam dolor ducimus. Recusandae id atque, itaque aperiam delectus repellat magni at, voluptatum sunt corrupti molestias praesentium! Corrupti in labore numquam molestias accusantium laboriosam voluptatibus omnis natus aspernatur, pariatur voluptatum. Exercitationem architecto hic laboriosam quam labore animi necessitatibus ut repellendus itaque eum cupiditate eligendi expedita, blanditiis suscipit aut, maxime ad quis eos aperiam laborum fugiat totam? Perferendis dolorum totam quisquam accusamus non minima unde placeat quis, sequi voluptas dignissimos nihil autem est fuga repudiandae ducimus, voluptatum iure asperiores. Quam, mollitia. Asperiores inventore nam eligendi sed ad? Quisquam aperiam dicta mollitia ea voluptas expedita veritatis quas odit deleniti rerum! Laboriosam ratione sunt eaque iure, dolore aperiam inventore tempore alias labore tempora blanditiis quidem, quo accusamus! Hic illo ullam nesciunt, tempora nostrum veniam dolorum. Eum beatae animi quibusdam dolor fuga iure. Quo impedit mollitia expedita deserunt, deleniti aliquid nihil itaque natus eligendi corporis dicta. Accusamus, accusantium reiciendis! Fugiat aut nulla obcaecati numquam ad? Id iure harum architecto, obcaecati nihil quod corporis soluta, quibusdam libero autem, cupiditate incidunt? Magnam maxime nostrum rerum nulla eligendi.";
// $text2= 'louis';
// $pdo->query("UPDATE post SET content= '$text'");

?>

