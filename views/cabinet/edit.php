<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 ">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1" style="background: white;padding: 30px 30px;border-radius:5px;">
                        <?php if(isset($result)):?>
                            <p>Данные отредактированны</p>
                        <?php else:?>
                           <?php if(isset($errors) && is_array($errors)):?>
                            <ul>
                                <?php  foreach ($errors as $error):?>
                                    <li><?php echo $error;?></li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="validationDefault01">Логин</label>
                                <input type="text" name="login" class="form-control form-control-sm" id="validationDefault01" placeholder="Логин"  value="<?php echo $login;?>"required>
                            </div>
                           <div class="form-group">
                                <label for="validationDefault02">Email</label>
                                <input type="email"  name="email" class="form-control form-control-sm" id="validationDefault02" aria-describedby="emailHelp" placeholder="Email" value="<?php echo $email;?>" required>
                            </div>
                            <div class="form-group">
                              <label for="validationDefault03">Пароль</label>
                              <input type="password" name="password1" class="form-control form-control-sm" id="validationDefault03" placeholder="Пароль" value="<?php echo $password1;?>" required>
                            </div>
                            <div class="form-group">
                              <label for="validationDefault04">Повторите пароль</label>
                              <input type="password" name="password2" class="form-control form-control-sm" id="validationDefault04" placeholder="Повторите пароль" value="<?php echo $password2;?>" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary col-lg-12">Сохранить</button>
                        </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


