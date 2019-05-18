<?php
/**
 * Абстрактный класс AdminBase содержит общую логику для контроллеров, которые
 * используются в панели администратора
 * @author Игорь
 */
class AdminBase {
    //put your code here
    public function __construct(){
        //проверяем авторизирован ли пользователь, если нет, то он будет переадресован
        $userId=User::checkLogged();
        //получаем информацию о текущем пользователе
        $user=User::getUserItemById($userId);
        foreach ($user as $user1)
            $user=$user1;
        if($user['role']=='admin')
            return true;
        die('access denied');
    }
}
