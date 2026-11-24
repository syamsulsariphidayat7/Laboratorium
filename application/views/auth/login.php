<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laboratorium | Login</title>

    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>css/animate.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <br><br>
            <div>
                <img width="150px" src="<?= base_url('assets/media/logo/logo.png'); ?>" alt="">
            </div>
            <br>
            <!-- <h3>Welcome to IN+</h3> -->
            <h4>Silahkan lengkapi untuk Login</h4>
            <?php if ($this->session->userdata('info')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->userdata('info'); ?>
                    <?php $this->session->unset_userdata('info'); ?>
                </div>
            <?php endif ?>
            <?= form_open('auth/getLogin'); ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username/ NIM/ NIP" required="" autofocus="">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group">
                <select name="level" class="form-control" required="">
                    <option value="">-- Pilih Akses --</option>
                    <option value="admin">Admin</option>
                    <option value="dosen">Dosen</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="asisten">Asisten</option>
                </select>
            </div>
            <div class="form-group pull-left">
                <input type="checkbox" id="lihatPassword" class="i-checks">
                <label for="">Lihat Password</label>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <?= form_close(); ?>
            <small>Copyright © Laboratorium Pendidikan Kimia Fakultas Tarbiyah Dan Keguruan 2018</small>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.1.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/myscript.js"></script>

</body>

</html>
