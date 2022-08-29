Запуск проекта (OpenServer):

PHP 8.1, Apache_2.4-PHP_8.0-8.1, MySQL-5.7 

1. После клонирования запустить php init (dev - среда).
2. Поставить пакеты:
   composer require "kartik-v/yii2-widget-select2": "dev-master"
   composer require --prefer-dist yii2tech/spreadsheet
   composer require kartik-v/yii2-widget-datepicker "dev-master"
   composer require kartik-v/yii2-field-range
3. Настроить подключение к бд (common/config/main-local.php).
4. Испортировать dump.sql. Если при импорте возникнет ошибка попробывать опустить версию пхп до 7.4 и после импорта вернуть назад.
