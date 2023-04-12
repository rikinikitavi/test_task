<?php

$oElement = new CIBlockElement();

$arFields = array(
   "ACTIVE" => "Y", 
   "IBLOCK_ID" => $iblockId,
   "NAME" => "Maytoni. Мосфильмовская, 53",
   "PROPERTY_VALUES" => array(
	   "PHONE" =>"+74957777929", 
	   "EMAIL" =>"maytoni1@maytoni.ru",
	   "COORDINATES" =>"55.704231,37.496223",
	   "CITY" =>"Москва",
   )
);

$oElement->Add($arFields); 

$arFields = array(
   "ACTIVE" => "Y", 
   "IBLOCK_ID" => $iblockId,
   "NAME" => "Maytoni. Нахимовский, 24",
   "PROPERTY_VALUES" => array(
	   "PHONE" =>"+79014697647", 
	   "EMAIL" =>"maytoni2@maytoni.ru",
	   "COORDINATES" =>"55.672644,37.586157",
	   "CITY" =>"Москва",
   )
);

$oElement->Add($arFields); 

