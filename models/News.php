<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News
 *
 * @author Игорь
 */
include_once ROOT.'/components/SQL.php';
class News {
    /*
     * Returns single news item with specified id
     * @param integer $id
     */
 

   public static function getNewsItemById($id)
   {
       return SQL::Instance()->select("SELECT * FROM publication WHERE id=$id");
   }
   /*
    * Returns an array of news item
    */
   public static  function getNewsList()
   {
       return SQL::Instance()->select('SELECT * FROM news ORDER BY date DESC LIMIT 5');
   }
}
