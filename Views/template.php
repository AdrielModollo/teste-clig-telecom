<!DOCTYPE html>
<html>
<head>
    <title>Livraria</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'assets/css/main.css'; ?>">
    <?php if(isset($_GET['url']) && $_GET['url'] == 'login'): ?>
        <link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/login.css'; ?>">
    <?php endif; ?>
    <script src="<?php echo BASE_URL; ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</head>
<body>
    <header>
        <?php if(!empty($_SESSION['usuario'])): ?>
            <a href="<?php echo BASE_URL.'login/logout'; ?>">
                Sair
            </a>
        <?php endif; ?>
    </header>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
</body>
</html>