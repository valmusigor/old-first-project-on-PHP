<?php
/**
 * Description of User
 *
 * @author Игорь
 */
class User {
    public static function register($login,$email,$password){
        $array=array('login'=>$login,'email'=>$email,'password'=>$password);
        return SQL::Instance()->insert('user',$array);
    }
    public static function edit($id,$login,$email,$password){
        $array=array('login'=>$login,'email'=>$email,'password'=>$password);
        $where='id='.$id;
        return SQL::Instance()->update('user',$array,$where);
    }
    public static function checkName($name){
        if(strlen($name)>2)
            return true;
        else      return false;
    }
    public static function checkPassword($password1,$password2=0){
        
        if($password1==$password2)
        {
        if(strlen($password1)>5)
            return 2;
        else    return 1;
        }
        else            return false;
    }
    public static function checkEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
            return true;
        else return FALSE;
    }
    public static function checkExist($arr)
    {
        foreach ($arr as $key=>$value)
        $params=[$key=>$value];
        $sql="SELECT count(*) from user where $key=:$key";
        $countList=SQL::Instance()->select($sql,$params);
        foreach ($countList as $countList1)
            foreach ($countList1 as $key => $value) {
                $countList2=$value;
            }
        if($countList2>0)
            return true;
        else return false;
    }
    public static function checkUserData($login,$password){
        $sql="SELECT * from user where login=:login AND password=:password";
        $mask=array('login'=>$login,'password'=>$password);
        $userItem=SQL::Instance()->select($sql,$mask);
        foreach ($userItem as $userArr)
        if($userArr)
        return $userArr['id'];
        else            return false;
    }
    public static function auth($userId){
        
        $_SESSION['user']=$userId;
    }
    public static function checkLogged(){
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        header("Location: /user/login/");
    }
    public static function isGuest(){ 
        if(isset($_SESSION['user']))
            return isset($_SESSION['user']);
        else return false;
    }
     public static function getUserItemById($id)
   {
       return SQL::Instance()->select("SELECT * FROM user WHERE id=$id");
   }
}
