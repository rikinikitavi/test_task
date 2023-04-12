<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страница");
?><?$APPLICATION->IncludeComponent(
  "test:task",
  ".default",
Array()
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>