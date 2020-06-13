<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/dist/css/adminlte2.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/dist/plugins/fontawesome-free/css/all.min.css') ?>">

</head>

<body class="bg-primary">

  <div class="row">
    <div class="col-lg-4 col-md-4 mx-auto">

      <div class="card-body bg-white mt-5 text-center mx-3">
        <h5>Silahkan login untuk melanjutkan</h5>

        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name='a' placeholder="Username" autocomplete="off" required>

          </div>
          <div class="form-group">
            <input type="password" class="form-control" name='b' placeholder="Password" required>

          </div>

          <button name='submit' type="submit" class="btn btn-primary form-control">Masuk</button>

        </form>
      </div>

    </div>
  </div>

  <script src="<?= base_url('assets/template/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/template/adminlte3/dist/js/adminlte.js') ?>"></script>

</body>

</html>