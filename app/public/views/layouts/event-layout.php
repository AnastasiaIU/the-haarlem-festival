<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Haarlem Festival' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/colors.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/events.css">
</head>
<body>
  <!-- Navigation Bar -->
  <?php require_once __DIR__ . '/../partials/header_nav.php'; ?>

  <!-- Main Event Content -->
  <main class="container-fluid px-0">
    <?= $content ?? '' ?>
  </main>

  <!-- Footer -->
  <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
