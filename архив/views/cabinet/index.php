<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <h1 style="color:white;">Добро пожаловать в личный кабинет <?php echo $userItem2['login'];?></h1>
                </div>
            </div>
            <?php include ROOT.'/views/layouts/right-side-cabinet.php';?>
        </div>
</div>

