<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class Test_Task extends CModule
{
    public $MODULE_ID = 'test.task';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    function __construct()
    {
        $this->MODULE_NAME = 'Модуль тестового задания';
        $this->MODULE_DESCRIPTION = 'Тестовое задание с картами';
        $this->PARTNER_NAME = 'Тестовый партнер';
		$this->PARTNER_URI = '/test_task/';

        $arModuleVersion = array();

        $path = str_replace('\\', '/', __FILE__);
        $path = substr($path, 0, strlen($path) - strlen('/index.php'));
        include($path . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        } else {
            $this->MODULE_VERSION = '0.0.1';
            $this->MODULE_VERSION_DATE = '2023-04-10 10:00:00';
        }
    }

    public function DoInstall()
    {
        global $APPLICATION;

		ModuleManager::registerModule($this->MODULE_ID);
	
		if (Loader::includeModule($this->MODULE_ID)) {
			require_once 'create_iblocks.php';
			require_once 'create_test_data.php';
			$this->InstallFiles();
			return true;
		} else {
			ModuleManager::unRegisterModule($this->MODULE_ID);
			$APPLICATION->ThrowException('Не удалось подключить модуль');
			return false;
		}
    }

    public function InstallFiles()
    {
        CopyDirFiles(
            __DIR__ . '/public',
            $_SERVER['DOCUMENT_ROOT'],
            true,
            true
        );
    }

    public function DoUninstall()
    {
        $this->UnInstallFiles();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        return true;
    }

    public function UnInstallFiles()
    {
        DeleteDirFiles(__DIR__ . '/public', $_SERVER['DOCUMENT_ROOT']);
    }
}
