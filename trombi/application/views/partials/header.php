<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url(ICONE_PATH . 'duck.png'); ?>">

    <title>
        <?= isset($title) ? $title . ' @ ' . 'Trombigniter' : 'Trombigniter' ?>
    </title>

    <!-- Core Bootstrap css -->
    <?= link_tag(BOOTSWATCH_PATH . "bootstrap.css"); ?>

    <!-- Custom css -->
    <?= link_tag(CSS_PATH . "custom.css"); ?>

    <!-- Font-awesome css-->
    <?= link_tag(FONT_AWESOME_PATH . "css/font-awesome.css"); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- navigations -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <?php if ($this->session->has_userdata("id_etudiant")) : ?>
                <!-- nav etudiant-->

                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('index.php'); ?>">
                        <b><i class="fa fa-camera-retro"></i> Trombigniter</b>
                    </a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="options">
                                <i class="fa fa-2x fa-cog" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="options">
                                <li>
                                    <a href="<?= base_url(DOC_CODEIGNITER_PATH); ?>">
                                        <i class="fa fa-2x fa-file-code-o" aria-hidden="true"></i> CodeIgniter
                                    </a>
                                </li>

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="<?= base_url(LOGOUT_PATH_I . '1'); ?>">
                                        <i class="fa fa-2x fa-lock" aria-hidden="true"></i> Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            <?php elseif ($this->session->has_userdata("id_prof")) : ?>
                <!-- nav prof -->

                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('index.php'); ?>">
                        <b><i class="fa fa-camera-retro"></i> Trombigniter</b>
                    </a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="options">
                                <i class="fa fa-2x fa-cog" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="options">
                                <li>
                                    <a href="<?= base_url(DOC_CODEIGNITER_PATH); ?>">
                                        <i class="fa fa-2x fa-file-code-o" aria-hidden="true"></i> CodeIgniter
                                    </a>
                                </li>

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="<?= base_url(LOGOUT_PATH_I . '3'); ?>">
                                        <i class="fa fa-2x fa-lock" aria-hidden="true"></i> Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            <?php elseif ($this->session->has_userdata("id_admin")) : ?>
                <!-- nav admin -->

                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('index.php'); ?>">
                        <b><i class="fa fa-camera-retro"></i> Trombigniter</b>
                    </a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?= base_url(GROUPES_PATH_I); ?>">
                                <i class="fa fa-2x fa-users"></i> Groupes
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url(ETUDIANTS_PATH_I); ?>">
                                <i class="fa fa-2x fa-user"></i> Etudiants
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url(PDF_PATH_I); ?>">
                                <i class="fa fa-2x fa-file-pdf-o"></i> PDF
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url(CSV_PATH_I); ?>">
                                <i class="fa fa-2x fa-file-excel-o" aria-hidden="true"></i> CSV
                            </a>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="options">
                                <i class="fa fa-2x fa-cog" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="options">
                                <li>
                                    <a href="<?= base_url(DOC_CODEIGNITER_PATH); ?>">
                                        <i class="fa fa-2x fa-file-code-o" aria-hidden="true"></i> CodeIgniter
                                    </a>
                                </li>

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="<?= base_url(LOGOUT_PATH_I . '2'); ?>">
                                        <i class="fa fa-2x fa-lock" aria-hidden="true"></i> Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

            <?php else : ?>
                <!-- nav sans rien -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('index.php'); ?>">
                        <b><i class="fa fa-camera-retro"></i> Trombigniter</b>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <!-- fin des navigations -->

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="container alert alter-dismissible alert-success text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php elseif ($this->session->flashdata('error')) : ?>
        <div class="container alert alter-dismissible alert-danger text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php elseif ($this->session->flashdata('info')) : ?>
        <div class="container alert alter-dismissible alert-info text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('info'); ?>
        </div>
    <?php endif; ?>