<?php

return array(
    //'news/77'=>'news/view',//первые два правила выше потому как, если расположить
   // 'news/15'=>'news/view',//3 правило  первым до первых двух не дойдет обработка
   // 'news/([a-z]+)/([0-9]+)'=>'news/view/$1/$2',
    ''=>'site/index',//actionIndex в SiteController
    'admin'=>'admin/index',
    'admin/rent'=>'adminRent/index',
    'admin/rent/add'=>'adminRent/add',
    'admin/rent/edit/([0-9]+)'=>'adminRent/edit/$1',
    'admin/rent/delete/([0-9]+)'=>'adminRent/delete/$1',
    'contact'=>'site/contact',
    'cabinet/edit'=>'cabinet/edit',
    'cabinet'=>'cabinet/index',//actionIndex в NewsController
    'cabinet/rents'=>'cabinet/rents',
    'cabinet/addrents'=>'cabinet/addrents',
    'cabinet/deleterents'=>'cabinet/deleterents',
    'cabinet/editrents/([0-9]+)'=>'cabinet/editrents/$1',
    'cabinet/viewimage'=>'cabinet/viewimage',
    'cabinet/viewrent/([0-9]+)'=>'cabinet/viewrent/$1',
    'rent/page-([0-9]+)'=>'rent/page/$1',
    'rent'=>'rent/index',//actionIndex в NewsController
    'user/login'=>'user/login',
    'user/logout'=>'user/logout',
    'user/register'=>'user/register',
    'news/([0-9]+)'=>'news/view/$1',
    'news'=>'news/index',//actionIndex в NewsController
    'products'=>'product/list',//actionList в ProductController
);

