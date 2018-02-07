# Yii2 CRM contacts module

## Установка
Предпочтительно через composer:
```
composer require pantera-digital/yii2-crm-contacts "@dev"
```
Или добавьте в composer.json
```
"pantera-digital/yii2-crm-contacts": "@dev"
```
и выполните команду
```
composer update
```

## Миграции
```
php yii migrate/up --migrationPath=@pantera/crm/contacts/migrations
```

## Конфигурация 
```
'modules' => [
    'contacts' => [
        'class' => '\pantera\crm\contacts\Module',
    ],
],
```
