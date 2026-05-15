<?php
session_start();
include 'database/movie.php';

if(!isset($_SESSION['login'])){
  header("Location:nouser.php");
  exit();
}
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
      .watch { background-color: #ff008b; outline: #ff008b solid; color: whitesmoke; }
      .watch:hover { background-color: transparent; color: black; }
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

    <!-- User Card -->
    <div class="container d-flex justify-content-center position-absolute top-50 start-50 translate-middle">
      <div class="card p-3 py-4">
        <div class="text-center">
          <img src="<?=$_SESSION['profile']?>" width="100" class="rounded-circle" style="background-color:rgb(234,179,208);outline:whitesmoke solid;" />
          <h3 class="mt-2"><?=$_SESSION['name']?></h3>
          <span class="mt-1 clearfix"><?=$_SESSION['email']?></span>
          <hr />
          <small class="mt-4">Happy watching Barbie! Hope this website bring back your childhood!</small>
          <div class="profile mt-3">
            <a href="updateProfile.php"><button class="btn px-5 watch">Update Profile</button></a>
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')"><button class="btn px-5 watch" style="margin-left:1rem;">Log Out</button></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start" style="background-color:#ff008b;position:fixed;bottom:0;width:100%;">
      <div class="text-center p-3" style="color:whitesmoke;">© 2026 Copyright: Nisrina Ayu Wijayanti - 124250026</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
  </body>
</html>