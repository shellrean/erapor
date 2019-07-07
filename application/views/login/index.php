<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/dist/img/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/login.css">
</head>
<body>
<div class="login-page">
<?php echo $this->session->flashdata('item'); ?>
<img src="<?= base_url() ?>assets/dist/img/logo43.png" alt="">

<div class="title">E-Raport SMKN 43 JAKARTA</div>
  <div class="form">
    <?= form_open('login/proses') ?>
      <input type="text" placeholder="Username" name="username"/>
      <input type="password" placeholder="Password" name="password"/>
      <button type="submit">login</button>
      <p class="message">CopyRight &copy; <a href="#">2018 | ICT | Develope Kuswandi and Safikri Zikri</a></p>
    </form>
  </div>
</div>
</body>
</html>