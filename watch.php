<?php
session_start();
include 'database/movie.php';

if(!isset($_SESSION['login'])){
  header("Location:nouser.php");
  exit();
}

$id = $_GET['id'];
$selectedMovie = null;
foreach($movies as $movie){ if($movie['id'] == $id){ $selectedMovie = $movie; } }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barbie Watch Party</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logos.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"/>
    <style>
      body { background-color: rgb(234,179,208); font-family: "Lucida Sans","Lucida Sans Regular","Lucida Grande","Lucida Sans Unicode",Geneva,Verdana,sans-serif; }
    </style>
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg" style="background-color: #ff008b;">
      <div class="container">
        <a class="navbar-brand me-2" href="index.php">
          <img src="assets/img/logos.svg" height="40" alt="Barbie Logo" loading="lazy" style="margin-top:-1px;" />
        </a>
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" style="align-self:center;">
              <a href="index.php" style="text-decoration:none;">
                <b style="font-size:25px;color:whitesmoke;">Barbie Watch Party</b>
              </a>
            </li>
            <li class="nav-item" style="margin-left:2rem;">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;font-size:20px;">Year</button>
                <ul class="dropdown-menu">
                  <?php
                    $years = [];
                    foreach($movies as $movie){ $years[] = $movie['year']; }
                    $years = array_unique($years); sort($years);
                    foreach($years as $year){
                  ?><li><a class="dropdown-item" href="year.php?year=<?=$year?>"><?=$year?></a></li><?php } ?>
                </ul>
              </div>
            </li>
            <li class="nav-item" style="margin-left:2rem;">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;font-size:20px;">Category</button>
                <ul class="dropdown-menu">
                  <?php
                    $categories = [];
                    foreach($movies as $movie){ $categories[] = $movie['category']; }
                    $categories = array_unique($categories);
                    foreach($categories as $cat){
                  ?><li><a class="dropdown-item" href="category.php?category=<?=$cat?>"><?=$cat?></a></li><?php } ?>
                </ul>
              </div>
            </li>
          </ul>
          <div class="d-flex align-items-center">
            <a href="user.php"><img src="<?=$_SESSION['profile']?>" height="40" style="background-color:rgb(234,179,208);border-radius:50%;outline:whitesmoke solid;" /></a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Header -->

    <!-- Watch -->
    <div class="container mt-4 mb-5">
      <h4 class="mb-3"><?=$selectedMovie['title']?></h4>
      <div class="ratio ratio-16x9">
        <iframe src="<?=$selectedMovie['link']?>" allowfullscreen></iframe>
      </div>
    </div>
    <!-- Watch -->

    <!-- Footer -->
    <footer class="text-center text-lg-start" style="background-color:#ff008b;position:fixed;bottom:0;width:100%;">
      <div class="text-center p-3" style="color:whitesmoke;">© 2026 Copyright: Nisrina Ayu Wijayanti - 124250026</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
  </body>
</html>