<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>

<div class="container-fluid" style="margin-top: 50px;">    
    <div class="row">
        <div class="col-lg-9">
            <div class="row mb-1" >
                <?php if($result): ?>
                <div class="list-group w-100 mb-1" style="word-break: break-all;">
                <?php  foreach ($result as $items):?>
                <div class="list-group-item list-group-item-action flex-column align-items-start my-rents disabled ">
                    <div class="d-flex w-100 justify-content-start" >
                    <div class="col-lg-3 col-sm-3" style="overflow: hidden">
                        <div class="row"><a href="/cabinet/viewrent/<?php echo $items['id'];?>"><img src="<?php echo $items['path_short_image'];?>" alt="Card image cap"></a></div>
                    </div>
                    <div class="col-lg-9">
                            <div class="d-flex w-100 justify-content-between" >
                                <h5 class="mb-1" style="max-width: 80%;"><a href="/cabinet/viewrent/<?php echo $items['id'];?>"><?php echo $items['short_content']?></a></h5>
                                <small><?php echo $items['date']?></small>
                            </div>
                        <p class="mb-1" style="color:black;"><?php echo $items['content']?></p>
                            <div class="d-flex w-100 justify-content-between" >
                                <div style="color:black;"><small class="mr-5">Price:<?php echo $items['price']?>$</small>
                                    <small><?php echo $items['type_tc']?></small></div>
                                <div>
                                    <small id="delete_item">
                                         <input type="hidden" name="rent_id[]" value="<?php echo $items['id'];?>"><a href="#"  class="badge badge-secondary">Удалить</a></small>
                                         
                                         <small> 
                                            <a href="/cabinet/editrents/<?php echo $items['id'];?>" class="badge badge-secondary rent_id_edit">Редактировать</a>
                                         </small>
                                    
                                </div>
                            </div>
                        
                    </div>
                    </div>
                </div>
                  <?php endforeach;?>
                </div>
                <?php endif; ?>
                <a href="/cabinet/addrents/" class="btn btn-success ml-auto" role="button">Добавить объявление</a>
            </div>
        </div>
        
            <?php if(isset($this->user) && $this->user[0]['role']=='admin')
                include ROOT.'/views/admin/right-side.php';
               else include ROOT.'/views/layouts/right-side-cabinet.php';?>
        </div>
</div>

