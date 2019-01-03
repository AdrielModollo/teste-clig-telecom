<!DOCTYPE html>
<html>
<head>
    <title>E-learning</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'assets/css/main.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/login.css'; ?>">
    <script src="<?php echo BASE_URL; ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</head>
<body>
    <header>
        <?php if(!empty($_SESSION['student'])): ?>
            <a href="<?php echo BASE_URL.'login/logout'; ?>">
                Sair
            </a>
            <div class="user_header">
                <?php echo $viewData['info']->getName(); ?>
            </div>
        <?php endif; ?>
    </header>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
</body>
</html>