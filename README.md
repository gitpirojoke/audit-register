# audit-register
Тестовый проект реестра.

Для разрешения зависимостей требуется composer

Базовый URL http://audit-register/ 

Развертывание:

создать бд - create database auditregister character set utf8 collate utf8_unicode_ci;

подтянуть репозиторий - git clone https://github.com/gitpirojoke/audit-register.git;

подтянуть зависимости - composer install

выполнить миграции - http://audit-register/migrate/index

засеять таблицы смп и аудитор http://audit-register/seed/index

