<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= $_ENV['BASE_LINK'] . 'fonts/terminus/fonts.css' ?>">
    <link rel="stylesheet" href="<?= $_ENV['BASE_LINK'] . 'fonts/satoshi/fonts.css' ?>">
    <link rel="stylesheet" href="<?= $_ENV['BASE_LINK'] . 'css/reset.css' ?>">
    <link rel="stylesheet" href="<?= $_ENV['BASE_LINK'] . 'css/main.css' ?>">

    <?php foreach ($this->cssFiles as $file): ?>
    <link rel="stylesheet" href="<?= $_ENV['BASE_LINK'] . $file ?>">
    <?php endforeach ?>

    <?php foreach ($this->externalCssFiles as $file): ?>
    <link rel="stylesheet" href="<?= $file ?>">
    <?php endforeach ?>

    <title><?= $this->title ?> - <?= SITE_NAME ?></title>
    <meta name="description" content="<?= $this->description ?>">

    <link rel="shortcut icon" href="<?= $_ENV['BASE_LINK'] . 'favicon.ico' ?>">
</head>
<body>
    <main>
        <?= $this->renderedBeforeView ?>

        <?= $this->renderedView ?>

        <?= $this->renderedAfterView ?>
    </main>

    <nav>
        <ul>
            <li><a href="<?= $_ENV['BASE_LINK'] . '' ?>">Accueil</a></li>
        </ul>
        <p>&nbsp;- <?= SITE_NAME ?> <?= SITE_VERSION ?></p>
    </nav>

    <?php foreach ($this->jsFiles as $file): ?>
    <script src="<?= $_ENV['BASE_LINK']. $file ?>"></script>
    <?php endforeach ?>

    <?php foreach ($this->externalJsFiles as $file): ?>
    <script src="<?= $file ?>"></script>
    <?php endforeach ?>
</body>
</html>