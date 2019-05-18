<?php
/**
 * Description of UserController
 *
 * @author Игорь
 */
class UserController {
    public function actionRegister()
    {
        
        include ROOT.'/views/layouts/header-menu.php';
        if(count($_POST)>0)
        {
            $login= htmlspecialchars(trim($_POST['login']));
            $email=htmlspecialchars(trim($_POST['email']));
            $password1=htmlspecialchars(trim($_POST['password1']));
            $password2=htmlspecialchars(trim($_POST['password2']));
            $errors=false;
            
            if(!User::checkName($login))
                $errors[]='Логин должен быть не короче 2-x символов';
            if(!User::checkEmail($email))
                $errors[]='Не правильно введен e-mail';
            if(User::checkExist(array('email'=>$email)))
                $errors[]='Этот е-mail уже используется';
            if(User::checkExist(array('login'=>$login)))
                $errors[]='Этот login уже используется';
            if(!User::checkPassword($password1, $password2))
                $errors[]='Пароли не совпадают';
            else if(User::checkPassword($password1, $password2)==1)
                 $errors[]='Введите пароль более 6 символов';
                if(count($errors)>0)
            print_r ($errors);
                if($errors==false)
                {
                    if(User::register($login, $email, $password1))
                    {
                        echo "Поздравляем вы успешно зарегестированы";
                    }
                    else 
                    {
                        echo "Ошибка! Попробуйте еще раз!";
                        require_once (ROOT.'/views/user/register.php');
                    }
                }
                else require_once (ROOT.'/views/user/register.php');
                
        }
        else require_once (ROOT.'/views/user/register.php');
        
        return true;
    }
    public function actionLogin() {
         include ROOT.'/views/layouts/header-menu.php';  
        if(count($_POST)>0)
        {
           $login= htmlspecialchars(trim($_POST['login']));
           $password=htmlspecialchars(trim($_POST['password']));
           $errors=false;
           if(!User::checkName($login))
                $errors[]='Логин должен быть не короче 2-x символов';
           if(strlen($password)<5)
               $errors[]='Введите пароль более 6 символов';
          if($errors==FALSE)
          {
           $userId= User::checkUserData($login, $password);
           if($userId==false){
               $errors[]='Пользователь не существует или неверные данные для входа на сайт';
           require_once ROOT.'/views/user/login.php';}
           else 
           {
                User::auth($userId);
                header("Location: /cabinet/");//отправляем в заголовке переадреассацию на сabinet
                //для задания интервала (через сколько произойдет перенаправление) нужно использовать
                //header( "refresh:5;url=wherever.php" ); перед header нельзя задавать пустые строки и 
                //html теги, т.к. заголовки передаются первыми до тела и, если мы укажем сначала теги или пустые
                //строки до заголовки не передадутся
           }
          }
        }
        else require_once ROOT.'/views/user/login.php';
        return true;  
    }
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }
}
