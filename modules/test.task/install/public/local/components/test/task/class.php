<?php
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Iblock\Iblock;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TestTask extends \CBitrixComponent
{
   	public function executeComponent()
    {
		$this->arResult = $this->getData();
        $this->includeComponentTemplate();
    }

	protected function getData(){
		$cache = Application::getInstance()->getCache();
        $taggedCache = Application::getInstance()->getTaggedCache();

		$iblockId = Option::get('test.task', 'ib');
        $cachePath = 'test_task';
        $cacheTtl = 86400;
        $cacheKey = 'test_task_' . $iblockId;
		$arResult = [];

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
            $arResult = $cache->getVars();
        } else {
            $taggedCache->startTagCache($cachePath);
            $taggedCache->registerTag('iblock_id_' . $iblockId);


			$elemEnt = Iblock::wakeUp($iblockId);
			$res = $elemEnt->getEntityDataClass()::getList([
				'filter' => [
					//'=ACTIVE' => 'Y'
				],
				'select' => [
					'NAME',
					'mail' => 'EMAIL.VALUE',
					'gorod'=>'CITY.VALUE',
					'maps' => 'COORDINATES.VALUE',
					'mobile' => 'PHONE.VALUE'
				]
			])->fetchAll();

			foreach($res as $item){
				if($item['maps']){
					$coord = explode(',',$item['maps']);
					$arResult['PLACEMARKS'][] = [
						'LON' => $coord[1],
						'LAT' => $coord[0],
						'TEXT' => sprintf(
							'<i><b>%s</b></i><br>Телефон: %s<br>Email: %s<br>Город: %s',
								$item['NAME'],
								$item['mobile'],
								$item['mail'],
								$item['gorod'],
							)
					];

					if(!$arResult['yandex_lat']){
						$arResult['yandex_lon'] = $coord[1];
						$arResult['yandex_lat'] = $coord[0];
					}
				}
			}

			$arResult['yandex_scale'] = 12;
			$arResult = serialize($arResult);

            $taggedCache->endTagCache();
			$cache->startDataCache();
            $cache->endDataCache($arResult);
        }

		return $arResult;
	}
}