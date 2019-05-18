<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteController
 *
 * @author Игорь
 */
class SiteController {
  public function actionIndex()
  {
      $rentList=Rent::getRentList();
      $newsList=News::getNewsList();
      require_once ROOT.'/views/site/index.php';
      return true;
  }
   public function actionContact()
  {
    $result=false;
    if(count($_POST)>0)
        {
           $email=htmlspecialchars(trim($_POST['email']));
           $message= htmlspecialchars(trim($_POST['message']));
           $errors=false;
           if(!User::checkEmail($email))
                $errors[]='Не правильно введен e-mail';
          if($errors==FALSE)
          {
            $to = 'x-ray-moby@mail.ru';  //на который будет отправлено письмо
            $subject='Hello user';//тема
            $cc = '';  
            $from = $email;
            $headers = '';
            $headers .= 'To: '. $to . "\r\n";
             if ($cc) {
             $headers .= 'Cc: '. $cc . "\r\n";
               }
             $headers .= 'From: '. $from . "\r\n";

                $result=mail($to, $subject, $message, $headers);
                $result=true;
          }
        }
      require_once ROOT.'/views/contact/contact.php';
      
      return true;
  }
}
