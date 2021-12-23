<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">        
    </head>
    <body>
        <input type="hidden" name="is_admin" value="<?php echo $this->session->userdata('is_admin') ?>">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <div class="container container-fluid">          
                <a class="navbar-brand" href="/">MasonryLoyout</a>

                <div class="d-flex navbar-nav mlink">
                    <?php if(!$this->session->userdata('logged_in')) : ?>
                    <span class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a> </span>            
                    <?php endif; ?>
                    
                    <?php if($this->session->userdata('logged_in')) : ?>
                    
                    <?php if($this->session->userdata('is_admin')) : ?>
                      <span class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>items/create">+ Add Item</a></span> 
                    <?php endif; ?>
                    
                    <span class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></span> 
                    <?php endif; ?>                            
                <div>
            </div>
        </nav>
        <div class="container main">

            <?php if($this->session->flashdata('item_created')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('item_created') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('item_updated')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('item_updated') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('item_deleted')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('item_deleted') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('login_failed')): ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('login_failed') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedin')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('user_loggedin') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedout')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo $this->session->flashdata('user_loggedout') ?>
                </div>
            <?php endif; ?>