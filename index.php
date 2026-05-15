<?php
session_start();
include 'database/movie.php';
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
      .movie-card { text-align: center; }
      .movie-card img { width: 220px; height: 320px; border-radius: 10px; transition: 0.3s; object-fit: cover; }
      .movie-card img:hover { transform: scale(1.03); }
      .movie-card h3 { font-size: 20px; font-weight: bold; margin-top: 15px; color: #1b1b3a; min-height: 60px; }
      .detail-link { text-decoration: none; font-size: 16px; color: gray; font-weight: bold; }
      .detail-link:hover { color: #ff008b; }
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
            <?php if(isset($_SESSION['login'])){ ?>
              <a href="user.php"><img src="<?=$_SESSION['profile']?>" height="40" style="background-color:rgb(234,179,208);border-radius:50%;outline:whitesmoke solid;" /></a>
            <?php } else { ?>
              <a href="nouser.php"><img src="assets/img/user.svg" height="40" style="background-color:rgb(234,179,208);border-radius:50%;outline:whitesmoke solid;" /></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- Header -->
 
    <!-- Banner -->
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center" style="background-color:whitesmoke;">
      <div class="col-md-6 p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold">You Can Be <span style="background-color:#ff008b;color:whitesmoke;">Everything</span>!</h1>
        <h3 class="fw-normal text-muted mb-3">
          <span style="color:#ff008b;"><img src="assets/profile-pict/1.svg" width="50"/>Barbie</span> Ready to Make Your Day
        </h3>
      </div>
    </div>
    <!-- Banner -->
 
    <!-- Latest Movie -->
    <div class="container py-5">
      <h2 class="pb-2 border-bottom">Latest Movie</h2>
      <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <?php
          $sorted = $movies;
          usort($sorted, function($a,$b){ return $b['year'] - $a['year']; });
          $latest = array_slice($sorted, 0, 3);
          foreach($latest as $movie){
        ?>
        <div class="col movie-card">
          <a href="detail.php?id=<?=$movie['id']?>"><img src="<?=$movie['image']?>"></a>
          <h3><?=$movie['title']?></h3>
          <a href="detail.php?id=<?=$movie['id']?>" class="detail-link">See Detail -></a>
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- Latest Movie -->
 
    <!-- Fashion Section -->
    <div class="container py-5">
      <h2 class="pb-2 border-bottom">Get Your Sparkle On, Show This World Where You Belong ✨</h2>
      <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <?php
          $count = 0;
          foreach($movies as $movie){
            if($movie['category'] == "Fashion"){
              $count++;
        ?>
        <div class="col movie-card">
          <a href="detail.php?id=<?=$movie['id']?>"><img src="<?=$movie['image']?>"></a>
          <h3><?=$movie['title']?></h3>
          <a href="detail.php?id=<?=$movie['id']?>" class="detail-link">See Detail -></a>
        </div>
        <?php if($count==3) break; } } ?>
      </div>
    </div>
    <!-- Fashion Section -->
 
    <!-- Watch Now -->
    <div class="position-relative overflow-hidden m-md-3 text-center" style="background-color:whitesmoke;">
      <div class="col-md-6 p-lg-5 mx-auto my-1">
        <img src="assets/profile-pict/1.svg" width="100"/>
        <h1 class="display-3 fw-bold">Watch <span style="color:#ff008b;">Barbie</span> Now!</h1>
      </div>
    </div>
    <!-- Watch Now -->
 
    <!-- Footer -->
    <footer class="text-center text-lg-start" style="background-color:#ff008b;">
      <div class="text-center p-3" style="color:whitesmoke;">© 2026 Copyright: Nisrina Ayu Wijayanti - 124250026</div>
    </footer>
 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
  </body>
</html>