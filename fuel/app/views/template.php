<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <style>
        body { margin: 40px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 20px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/book/dashboard">📖 My Book App</a>
    <div>
      <a href="/book/dashboard" class="btn btn-outline-primary btn-sm">🏠 ダッシュボード</a>
      <a href="/users/login" class="btn btn-outline-danger btn-sm">🚪 ログアウト</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="col-md-12">
        <h1><?php echo $title; ?></h1>
        <hr>

        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <?php echo implode('<br>', (array) Session::get_flash('success')); ?>
            </div>
        <?php endif; ?>

        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger">
                <?php echo implode('<br>', (array) Session::get_flash('error')); ?>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </div>
</div>

<footer class="text-center" style="margin-top: 40px;">
    <hr>
    <small>FuelPHP App - Version: <?php echo e(Fuel::VERSION); ?></small>
</footer>

</body>
</html>

