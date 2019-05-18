<?php
 include ROOT.'/views/layouts/header-menu.php';
 ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 ">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1" style="background: white;padding: 30px 30px;border-radius:5px;">
                        <?php if($result==true):?>
                            <p>Сообщение отправлено. Мы ответим вам на ваш e-mail в ближайшее время!</p>
                        <?php else:?>
                        <?php    if(isset($errors) && is_array($errors)):?>
                            <ul>
                                <?php  foreach ($errors as $error):?>
                                    <li><?php echo $error;?></li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>
                            <h2>Обратная связь</h2>
                            <h3>Есть вопросы напишите нам</h3>
                        <form action="#" method="post">
                           <div class="form-group">
                                <label for="validationDefault02">Email</label>
                                <input type="email"  name="email" class="form-control form-control-sm" id="validationDefault02" aria-describedby="emailHelp" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="validationDefault03">Текст сообщения</label>
                            <textarea class="form-control form-control-sm" name="message" id="validationDefault03" aria-label="With textarea" placeholder="Введите текст сообщения"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary col-lg-12">Отправить</button>
                        </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

