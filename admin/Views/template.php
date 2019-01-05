<!DOCTYPE html>
<html>
<head>
    <title>E-learning</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'assets/css/main.css'; ?>">
</head>
<body>
    <header>
        <?php if(!empty($_SESSION['student'])): ?>
            <a href="<?php echo BASE_URL.'login/logout'; ?>">
                Sair
            </a>
        <?php endif; ?>
    </header>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
</body>
</html>