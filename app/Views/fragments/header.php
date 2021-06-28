<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= base_url() ?>/resources/dist/img/favicon.ico" />

    <title>Omorfiá</title>

    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/datatables-bs4/css/dataTables.bootstrap4.css"> <!-- datatable -->
    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css"><!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/toastr/toastr.min.css"><!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?= base_url() ?>/resources/plugins/datatables-editor/editor.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/resources/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/resources/dist/css/style.css">
</head>

<body class="hold-transition sidebar-mini layout-footer-fixed layout-fixed layout-navbar-fixed ">
    <div class="wrapper">
        <!-- MENU TOPO -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>/resources/dist/img/omorfia.png" alt="Omorfia Estética Personalizada Logo" class="brand-image img-fluid">
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cogs"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <span class="dropdown-header">Olá, <?=session()->get('nome')?>.</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user-cog"></i> Perfil
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-question-circle"></i> Ajuda
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>/logout" class="dropdown-item dropdown-footer">
                            Sair <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- MENU LATERAL -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?= base_url() ?>/inicio" class="brand-link ">
                <img src="<?= base_url() ?>/resources/dist/img/omorfia-logo.png" alt="Logo Omorfia" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light font-logo"> OMORFIÁ</span><span class="badge badge-light navbar-badge">v1.0</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php $principal = true;
                        foreach ($menus as $menu) { ?>
                            <?php if ($menu->tipo == 'lateral-principal') { ?>
                                <?= $principal ? "<li class='nav-header text-uppercase'> Principal </li>" : "" ?>
                                <?= $principal = false ?>
                                <li class="nav-item">
                                    <a href="<?= base_url() . "/" . $menu->url ?>" class="nav-link <?= $aba == ($menu->aba) ? "active" : "" ?>">
                                        <i class="nav-icon <?= $menu->icon ?>"></i>
                                        <p>
                                            <?= $menu->aba ?>
                                        </p>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <?php $gerenciamento = true;
                        foreach ($menus as $menu) { ?>
                            <?php if ($menu->tipo == 'lateral-gerenciamento') { ?>
                                <?= $gerenciamento ? "<li class='nav-header text-uppercase'> Gerenciamento </li>" : "" ?>
                                <?= $gerenciamento = false ?>
                                <li class="nav-item">
                                    <a href="<?= base_url() . "/" . $menu->url ?>" class="nav-link <?= $aba == ($menu->aba) ? "active" : "" ?>">
                                        <i class="nav-icon <?= $menu->icon ?>"></i>
                                        <p>
                                            <?= $menu->aba ?>
                                        </p>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- TITULO -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> <?= $aba ?> </h1>
                        </div>
                        <div class="col-sm-6">
                            <span id="horario" class="float-sm-right">

                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="usuario_ativo" value=""/>