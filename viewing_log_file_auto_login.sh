#!/bin/bash
# Смотрим лог работы прожения auto_multi_login.
echo

# Полный вывод содержимого файла auto_multi_login.log.
#cat /home/vmail/auto_login/logs/auto_multi_login.log

# Последние 20 строк строк.
echo "Последние 20 строк строк."
tail -n40 /home/vmail/auto_login/logs/auto_multi_login.log
echo

# Лог-файл с выборкой строк.
echo "Лог-файл с выборкой строк."
grep -E "starting" /home/vmail/auto_login/logs/auto_multi_login.log && echo
grep -E "exception" /home/vmail/auto_login/logs/auto_multi_login.log && echo
grep -E "stopping" /home/vmail/auto_login/logs/auto_multi_login.log && echo

# Как запускать.
# sh /home/vmail/auto_login/logs/auto_multi_login.log
