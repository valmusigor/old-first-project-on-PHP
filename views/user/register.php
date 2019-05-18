<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 ">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1" style="background: white;padding: 30px 30px;border-radius:5px;">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="validationDefault01">Логин</label>
                                <input type="text" name="login" class="form-control form-control-sm" id="validationDefault01" placeholder="Логин"  value="<?php if(isset($_POST['login'])) echo $_POST['login'];?>"required>
                            </div>
                           <div class="form-group">
                                <label for="validationDefault02">Email</label>
                                <input type="email"  name="email" class="form-control form-control-sm" id="validationDefault02" aria-describedby="emailHelp" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" required>
                            </div>
                            <div class="form-group">
                              <label for="validationDefault03">Пароль</label>
                              <input type="password" name="password1" class="form-control form-control-sm" id="validationDefault03" placeholder="Пароль" required>
                            </div>
                            <div class="form-group">
                              <label for="validationDefault04">Повторите пароль</label>
                              <input type="password" name="password2" class="form-control form-control-sm" id="validationDefault04" placeholder="Повторите пароль" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="accept" value="ok" class="form-check-input" id="invalidCheck2" required>
                              <label class="form-check-label" for="invalidCheck">Я принимаю условия оферты</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary col-lg-12">Зарегистрироваться</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

