<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-1">
                <div class="row  ">
                    <div class="w-100 ml-100" style="background: white;padding: 30px 30px;border-radius:5px;">
                        <form action="#" method="post" enctype="multipart/form-data" id="myform">
                            <div class="form-group">
                                <label for="validationDefault01">Заголовок объявления</label>
                                <input type="text" name="short_content" class="form-control form-control-sm-2" id="validationDefault01" placeholder="Заголовок" value="<?php if(isset($_POST['short_content'])) echo $_POST['short_content'];else if(isset($short_content)) echo $short_content;?>" required>
                                <input type="hidden" name="rent_id" value="<?php echo $rent_id_edit;?>">
                            </div>
                            <div class="form-row align-items-center">
                                <label class="my-1 mr-2" for="сhosetc">Выберите товарищество собственников</label>
                                       <select class="custom-select my-1 mr-sm-2" id="choosetc" name="type_tc">
                                           <option value="0" 
                                           <?php if(!isset($_POST['type_tc'])):?> selected <?php endif;?>
                                           <?php if(!isset($type_tc)):?> selected <?php endif;?>>Choose...</option>
                                            <option value="1"
                                            <?php if(isset($_POST['type_tc']) && $_POST['type_tc']=='1'):?> selected <?php endif;?> 
                                            <?php if(isset($type_tc) && $type_tc=='1'):?> selected <?php endif;?>>Борвиха</option>
                                            <option value="2"
                                            <?php if(isset($_POST['type_tc']) && $_POST['type_tc']=='2'):?> selected <?php endif;?>        
                                            <?php if(isset($type_tc) && $type_tc=='2'):?> selected <?php endif;?>>Борвиха плюс</option>
                                        </select>
                                <label class="my-1 mr-2" for="chooseaddress">Выберите адрес</label>
                                <select class="custom-select my-1 mr-sm-2 " id="chooseaddress" name="address" 
                                    <?php if(!isset($_POST['address']) && !isset($address)):?>disabled<?php endif;?>>
                                    <?php if(!isset($_POST['address']) && !isset($address)):?>       
                                    <option value="0" selected>Выберите адрес</option>
                                    <?php else:?>
                                    <?php if($_POST['type_tc']=='1' || $type_tc=='1'): ?>
                                    <option value="1"
                                            <?php if(isset($_POST['address']) && $_POST['address']=='1'):?> selected <?php
                                            elseif(isset($address) && $address=='1'):?> selected <?php endif;?>>40 лет Победы 27/1</option>
                                    <option value="2"
                                            <?php if(isset($_POST['address']) && $_POST['address']=='2'):?> selected <?php
                                            elseif(isset($address) && $address=='2'):?> selected <?php endif;?>>40 лет Победы 27/2</option>
                                    <option value="3"
                                            <?php if(isset($_POST['address']) && $_POST['address']=='3'):?> selected <?php
                                            elseif(isset($address) && $address=='3'):?> selected <?php endif;?>>40 лет Победы 27/4</option>
                                    <option value="4"
                                            <?php if(isset($_POST['address']) && $_POST['address']=='4'):?> selected <?php  
                                            elseif(isset($address) && $address=='4'):?> selected <?php endif;?> >40 лет Победы 27/5</option>
                                    <?php else: ?>
                                    <option value="5" selected>40 лет Победы 23А</option>
                                    <?php endif;?>
                                    <?php endif;?> 
                                 </select>
                            </div>    
                           <div class="form-group">
                                <label for="validationDefault02">Текст объявления</label>
                                <textarea class="form-control form-control-sm-2" name="content" id="validationDefault02" aria-label="With textarea" placeholder="Введите текст сообщения" required><?php if(isset($_POST['content'])) echo $_POST['content'];else if(isset($content)) echo $content;?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="validationDefault03">Цена($):</label>
                                <input type="text" name="price" class="form-control form-control-sm-2" id="validationDefault03" placeholder="Введите цену в $" 
                                       value="<?php if(isset($_POST['price'])) echo $_POST['price'];else if(isset($price)) echo $price;?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="validationDefault04">Площадь(м<sup>2</sup>):</label>
                                <input type="text" name="square" class="form-control form-control-sm-2" id="validationDefault04" placeholder="Введите площадь" 
                                       value="<?php if(isset($_POST['square'])) echo $_POST['square'];else if(isset($square)) echo $square;?>" required>
                            </div>
                             <div class="form-group">
                                <label id="label_upload_file" for="upload_file">Выберите изображение для загрузки</label>
                                <input type="file" style="opacity: 0" name="file[]" class="form-control-file" id="upload_file" multiple="multiple">
                                <span id='button_select_file'>Select File</span>
                            </div>
                            <div class="form-group d-flex flex-wrap " id="add-image">
                                <?php if(isset($path_images)): $i=0;?>
                                <?php foreach ($path_images as $path_image):?>
                                <?php if(file_exists(ROOT.$path_image)):?>
                                <div class="col-lg-4 col-sm-6 col-md-4"id="add-image-card">
                                <div class="card bg-dark" style="color:red; margin-bottom: 15px;">
                                <img src="<?php echo $path_image; ?>" />
                                <div class="card-img-overlay d-flex justify-content-between" style="padding:0 5px;">
                                 <div><input type="radio" name="main_image" value="<?php echo $i; $i++;?>" class="form-radio-input" id="check_main_image" >
                                     <label class="form-check-label" for="check_main_image">Главная</label></div>
                                <div>Удалить</div>
                                </div>
                                </div>
                                </div>    
                                <?php endif;?>
                                <?php endforeach;?>
                                <?php endif;?>
                            </div>
                            <div class="form-group form-check">
                                <?php if(isset($path_images)):?>
                                <input type="hidden" name="path_images_edit" value="<?php print_r($path_images);?>"> 
                                <?php endif;?>
                                <input type="checkbox" name="accept" value="ok" class="form-check-input" id="invalidCheck2" required>
                              <label class="form-check-label" for="invalidCheck">Я принимаю условия оферты</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary col-lg-12">Подтвердить</button>
                        </form>
                    </div>
                </div>
            </div>
             <?php include ROOT.'/views/layouts/right-side-cabinet.php';?>
        </div>
    </div>
</section>
