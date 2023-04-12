<?php

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$arFields = Array(
    'ID'=>'test_task',
	'SECIONS' => 'Y',
    'IN_RSS'=>'N',
    'SORT'=>100,
    'LANG'=>Array(
		'ru'=>Array(
            'NAME'=>'Тестовый тип инфоблока для задания',
            'SECTION_NAME'=>'Разделы',
            'ELEMENT_NAME'=>'Офисы'
            )
        )
    );

$obBlocktype = new \CIBlockType;
$obBlocktype->Add($arFields);

$ib = new CIBlock;
$arFields = Array(
  "ACTIVE" => 'Y',
	'CODE' => 'test_task',
	'API_CODE' => 'testtask',
  "NAME" => 'Тестовый инфоблок для задания',
  "IBLOCK_TYPE_ID" => 'test_task',
  "SITE_ID" => Array("s1"),
  "GROUP_ID" => Array("2"=>"D", "3"=>"R")
  );

$iblockId = $ib->Add($arFields);
if($iblockId){
	Bitrix\Main\Config\Option::set('test.task', 'ib', $iblockId);

	$arFields = Array(
	  "NAME" => "Телефон",
	  "ACTIVE" => "Y",
	  "SORT" => "100",
	  "CODE" => "PHONE",
	  "PROPERTY_TYPE" => "S",
	  "IBLOCK_ID" => $iblockId,
	  );

	$iblockproperty = new CIBlockProperty;
	$iblockproperty->Add($arFields);

	$arFields = Array(
	  "NAME" => "Email",
	  "ACTIVE" => "Y",
	  "SORT" => "200",
	  "CODE" => "EMAIL",
	  "PROPERTY_TYPE" => "S",
	  "IBLOCK_ID" => $iblockId,
	  );
	$iblockproperty->Add($arFields);

	$arFields = Array(
	  "NAME" => "Координаты",
	  "ACTIVE" => "Y",
	  "SORT" => "200",
	  "CODE" => "COORDINATES",
	"PROPERTY_TYPE" => "S",
	   "USER_TYPE" => "map_yandex",
	  "IBLOCK_ID" => $iblockId,
	  );
	$iblockproperty->Add($arFields);

	$arFields = Array(
	  "NAME" => "Город",
	  "ACTIVE" => "Y",
	  "SORT" => "200",
	  "CODE" => "CITY",
	  "PROPERTY_TYPE" => "S",
	  "IBLOCK_ID" => $iblockId,
	  );
	$iblockproperty->Add($arFields);
}