<?php
session_start();
include 'database/movie.php';
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
      body {
        background-color: rgb(234, 179, 208);
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        padding-bottom: 60px;
      }

      .navbar { background-color: #ff008b; }
      .navbar .dropdown-toggle { color: white !important; font-size: 18px; }
      .navbar .dropdown-item { color: #1b1b3a; }
      .navbar .dropdown-item:hover,
      .navbar .dropdown-item.active { background-color: #ff008b; color: white; }

      .detail-card {
        background-color: #e8b4d0;
        border: 2px solid #666;
        border-radius: 4px;
        padding: 20px 24px;
      }

      .poster-img {
        width: 100%;
        max-width: 220px;
        height: auto;
        display: block;
      }

      .movie-title {
        font-size: 34px;
        font-weight: bold;
        color: #1b1b3a;
        margin-bottom: 10px;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      .badge-year {
        background-color: #ff008b;
        outline: #ff008b solid;
        color: whitesmoke;
        padding: 3px 4px;
        border-radius: 3px;
        font-weight: bold;
        font-size: 13px;
        display: inline;
        
      }
      .badge-category {
        background-color: rgb(234, 179, 208);
        outline: #ff008b solid;
        color: #1b1b3a;
        font-weight: bold;
        font-size: 13px;
        display: inline;
        padding: 3px 4px;
      }

      .synopsis-text {
        font-family: monospace;
        font-size: 13.5px;
        text-align: justify;
        line-height: 1.75;
        color: #1b1b3a;
        margin-top: 14px;
        margin-bottom: 20px;
      }

      .btn-watch {
        background-color: #ff008b;
        border: none;
        color: white;
        padding: 10px 22px;
        border-radius: 6px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.2s;
      }
      .btn-watch:hover { background-color: #cc006e; color: white; }

      footer {
        background-color: #ff008b;
        position: fixed;
        bottom: 0;
        width: 100%;
      }
    </style>
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 me-4" href="index.php" style="text-decoration:none;">
          <img src="assets/img/logos.svg" height="40" alt="Barbie Logo" loading="lazy" />
          <b style="font-size:21px; color:whitesmoke;">Barbie Watch Party</b>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <!-- Year Dropdown -->
            <li class="nav-item ms-3">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; font-size:18px;">Year</button>
                <ul class="dropdown-menu">
                  <?php
                    $years = [];
                    foreach($movies as $movie){ $years[] = $movie['year']; }
                    $years = array_unique($years);
                    sort($years);
                    foreach($years as $year){
                      echo '<li><a class="dropdown-item" href="year.php?year='.$year.'">'.$year.'</a></li>';
                    }
                  ?>
                </ul>
              </div>
            </li>

            <!-- Category Dropdown -->
            <li class="nav-item ms-3">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white; font-size:18px;">Category</button>
                <ul class="dropdown-menu">
                  <?php
                    $categories = [];
                    foreach($movies as $movie){ $categories[] = $movie['category']; }
                    $categories = array_unique($categories);
                    foreach($categories as $cat){
                      echo '<li><a class="dropdown-item" href="category.php?category='.urlencode($cat).'">'.$cat.'</a></li>';
                    }
                  ?>
                </ul>
              </div>
            </li>

          </ul>

          <!-- User Icon -->
          <div class="d-flex align-items-center">
            <?php if(isset($_SESSION['login'])): ?>
              <a href="user.php">
                <img src="<?= htmlspecialchars($_SESSION['profile']) ?>" height="40"
                     style="background-color:rgb(234,179,208); border-radius:50%; outline:whitesmoke solid 2px;" />
              </a>
            <?php else: ?>
              <a href="nouser.php">
                <img src="assets/img/user.svg" height="40"
                     style="background-color:rgb(234,179,208); border-radius:50%; outline:whitesmoke solid 2px;" />
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->


    <!-- DETAIL SECTION -->
    <?php if($selectedMovie): ?>
    <div class="container py-5">
      <div class="detail-card">
        <div class="row g-0">

          <!-- Poster kiri -->
          <div class="col-lg-3 col-md-4 col-12 d-flex justify-content-center align-items-start mb-3 mb-md-0">
            <img
              src="<?= htmlspecialchars($selectedMovie['image']) ?>"
              class="poster-img"
              alt="<?= htmlspecialchars($selectedMovie['title']) ?>"
            />
          </div>

          <!-- Info kanan -->
          <div class="col-lg-9 col-md-8 col-12 ps-md-4">

            <!-- Judul -->
            <h1 class="movie-title"><?= htmlspecialchars($selectedMovie['title']) ?></h1>

            <!-- Tahun & Kategori -->
             <div class="btn-group mb-3" role="group" aria-label="Movie info">
              <label class="btn" style="background-color:#ff008b; outline:#ff008b solid; color:whitesmoke; font-weight:bold;">
                <?= htmlspecialchars($selectedMovie['year']) ?>
              </label>
              <label class="btn" style="background-color:rgb(234,179,208); outline:#ff008b solid; font-weight:bold;">
                <?= htmlspecialchars($selectedMovie['category']) ?>
              </label>
            </div>

            <!-- Sinopsis -->
            <p class="synopsis-text"><?= htmlspecialchars($selectedMovie['synopsis']) ?></p>

            <!-- Tombol Watch Now -->
            <a href="watch.php?id=<?= $selectedMovie['id'] ?>" class="btn-watch">Watch Now!</a>

          </div>
        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="container py-5 text-center">
      <h3 style="color:#1b1b3a;">Film tidak ditemukan.</h3>
      <a href="index.php" class="btn-watch mt-3 d-inline-block">Kembali ke Beranda</a>
    </div>
    <?php endif; ?>
    <!-- END DETAIL -->


    <!-- FOOTER -->
    <footer class="text-center text-lg-start">
      <div class="text-center p-3" style="color:whitesmoke;">
        © 2026 Copyright: Nisrina Ayu Wijayanti - 124250026
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
  </body>
</html>