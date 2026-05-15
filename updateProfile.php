<?php
session_start();
include 'database/movie.php';

if(!isset($_SESSION['login'])){
  header("Location:nouser.php");
  exit();
}

$error = "";
$success = "";

if(isset($_POST['update'])){
  $name     = trim($_POST['name']);
  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);

  if($name == "" || $email == ""){
    $error = "Nama dan email tidak boleh kosong!";
  } else {
    $_SESSION['name']  = $name;
    $_SESSION['email'] = $email;
    if($password != ""){
      $_SESSION['password'] = $password;
    }
    if(isset($_POST['profile'])){
      $_SESSION['profile'] = "assets/profile-pict/" . $_POST['profile'];
    }
    $success = "Profile berhasil diperbarui!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Profile - Barbie Watch Party</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logos.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"/>
    <style>
      body { background-color: rgb(234,179,208); font-family: "Lucida Sans","Lucida Sans Regular","Lucida Grande","Lucida Sans Unicode",Geneva,Verdana,sans-serif; }
      .watch { background-color: #ff008b; outline: #ff008b solid; color: white; border: none; }
      .watch:hover { background-color: white; color: #ff008b; }
      .profile-img { width: 80px; cursor: pointer; border-radius: 50%; padding: 5px; transition: 0.3s; border: 3px solid transparent; }
      .profile-img:hover { border: 3px solid #ff008b; transform: scale(1.05); }
      input[type="radio"]:checked + .profile-img { border: 3px solid #ff008b; }
    </style>
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg" style="background-color: #ff008b;">
      <div class="container">
        <a class="navbar-brand me-2" href="index.php">
          <img src="assets/img/logos.svg" height="40" />
        </a>
        <a href="index.php" style="text-decoration:none;">
          <b style="font-size:25px;color:white;">Barbie Watch Party</b>
        </a>
      </div>
    </nav>
    <!-- Header -->

    <!-- Update Profile -->
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card p-4 shadow" style="border-radius:20px;">
            <h2 class="text-center mb-4">UPDATE PROFILE</h2>

            <?php if($error != ""){ ?><div class="alert alert-danger"><?=$error?></div><?php } ?>
            <?php if($success != ""){ ?><div class="alert alert-success"><?=$success?></div><?php } ?>

            <form method="POST">
              <!-- Foto profil saat ini -->
              <div class="text-center mb-3">
                <img src="<?=$_SESSION['profile']?>" width="100" class="rounded-circle" style="background-color:rgb(234,179,208);outline:whitesmoke solid;" />
              </div>

              <!-- Pilih foto profil -->
              <label class="mb-2"><strong>Pilih Foto Profil:</strong></label>
              <div class="d-flex gap-3 mb-4">
                <label>
                  <input type="radio" name="profile" value="1.svg" style="display:none;" />
                  <img src="assets/profile-pict/1.svg" class="profile-img" />
                </label>
                <label>
                  <input type="radio" name="profile" value="2.svg" style="display:none;" />
                  <img src="assets/profile-pict/2.svg" class="profile-img" />
                </label>
                <label>
                  <input type="radio" name="profile" value="3.svg" style="display:none;" />
                  <img src="assets/profile-pict/3.svg" class="profile-img" />
                </label>
                <label>
                  <input type="radio" name="profile" value="4.svg" style="display:none;" />
                  <img src="assets/profile-pict/4.svg" class="profile-img" />
                </label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=$_SESSION['name']?>" />
                <label>Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?=$_SESSION['email']?>" />
                <label>Email</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" />
                <label>Password Baru (kosongkan jika tidak diubah)</label>
              </div>

              <div class="text-end">
                <button type="submit" name="update" class="btn watch px-5">Save Changes</button>
              </div>
            </form>

            <div class="text-center mt-4">
              <a href="user.php" style="text-decoration:none;color:#ff008b;font-weight:bold;">← Back to Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start" style="background-color:#ff008b;margin-top:50px;">
      <div class="text-center p-3" style="color:whitesmoke;">© 2026 Copyright: Nisrina Ayu Wijayanti - 124250026</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Highlight foto yang dipilih
      document.querySelectorAll('input[name="profile"]').forEach(radio => {
        radio.addEventListener('change', function(){
          document.querySelectorAll('.profile-img').forEach(img => img.style.border = '3px solid transparent');
          this.nextElementSibling.style.border = '3px solid #ff008b';
        });
      });
    </script>
  </body>
</html>