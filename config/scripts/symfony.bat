@echo off
call cd ../
call symfony composer install
call symfony composer update
REM echo yes | call symfony console doctrine:migrations:migrate