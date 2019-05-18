<?php
/**
 * Description of AdminRentController
 *
 * @author Игорь
 */
class AdminRentController extends AdminBase {
  public function actionIndex()
    {
        //$userId=User::checkLogged();
        //$userItem= User::getUserItemById($userId);
        //$countRents=Rent::getRentCountItemByUserId($userId);
        $result=FALSE;
        $result= Rent::getAllRents();
        require_once ROOT.'/views/cabinet/rents.php';
    }
}
