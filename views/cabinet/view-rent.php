<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>
<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row">
        <div class="col-lg-9">
            <div class="row mb-1" style="background-color: white;" >

               <div class="form-group d-flex " style="overflow: auto; padding: 10px;margin: 0 10px;"  id="scroll-image">
                                <?php if(isset($id)): 
                                    $i=0;
                                $rent_edit= Rent::getRentItemById($id);
                                $path_images=unserialize($rent_edit[0]['path_images']);
                                ?>
                                <?php foreach ($path_images as $path_image):?>
                                <?php if(file_exists(ROOT.$path_image)):?>
   
                   <div style="padding: 5px 5px;" class="scroll-image-card <?php echo "number-image-".$i;$i++;?>">
                                
                                <img src="<?php echo $path_image; ?>" />
                                
                                </div>    
                                <?php endif;?>
                                <?php endforeach;?>
                                <?php endif;?>
                </div>
                <div class="col-lg-12 show-image-card" style="text-align:center;border-top:2px solid gray;padding: 10px 0">
                <img width="500px" height="300px"src="<?php echo $path_images[0]; ?>" />
               </div> 
            </div>
        </div>
            <?php include ROOT.'/views/layouts/right-side-cabinet.php';?>
        </div>
</div>

