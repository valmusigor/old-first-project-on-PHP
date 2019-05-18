<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>
<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <h1 style="color:white;">Добро пожаловать в личный кабинет <?php echo $this->user[0]['login'];?></h1>
                </div>
            </div>
            <?php include ROOT.'/views/admin/right-side.php';?>
        </div>
</div>


