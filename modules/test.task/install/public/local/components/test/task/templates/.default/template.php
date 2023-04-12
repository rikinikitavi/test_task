<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => $arResult,
		"MAP_WIDTH" => "600",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "",
		"API_KEY" => ""
	),
	false
);