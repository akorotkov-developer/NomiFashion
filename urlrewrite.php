<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/company/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/services/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/personal/profile/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.profile',
    'PATH' => '/personal/profile/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/company/actions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/actions/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/company/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/brands/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/company/shops/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/company/shops/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/catalog/.*#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
