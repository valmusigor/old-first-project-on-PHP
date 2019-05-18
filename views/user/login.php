
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 ">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1" style="background: white;padding: 30px 30px;border-radius:5px;">
                        <form action="/user/login" method="post">
                            <div class="form-group">
                                <label for="validationDefault01">Логин</label>
                                <input type="text" name="login" class="form-control form-control-sm" id="validationDefault01" placeholder="Логин"  value="<?php if(isset($_POST['login'])) echo $_POST['login'];?>"required>
                            </div>
                            <div class="form-group">
                              <label for="validationDefault03">Пароль</label>
                              <input type="password" name="password" class="form-control form-control-sm" id="validationDefault03" placeholder="Пароль" required>
                            </div>
                            <div class="form-group">
                            <a href="../user/register" class="badge badge-light">Регистрация</a>
                            <a href="#" class="badge badge-light">Забыли пароль</a>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary col-lg-12">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
