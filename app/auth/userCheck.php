<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);
require __DIR__.'/../autoload.php';

$post_id = $_GET['id'];
$page = $_GET['page'];

$query = "SELECT * FROM posts WHERE post_id = :post_id";

$statement = $pdo->prepare($query);
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['user']) && $post['user_id'] === $_SESSION['user']['id']) {
    redirect("$page.php?id=$post_id");
} else {
    redirect("../../index.php");
}
