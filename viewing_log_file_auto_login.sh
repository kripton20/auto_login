#!/bin/bash
# Смотрим лог работы прожения auto_multi_login.
echo

# Последние 10 строк строк.
echo "Последние 10 строк строк."
tail /home/vmail/auto_login/logs/auto_multi_login.log
echo

# Лог-файл с выборкой строк.
echo "Лог-файл с выборкой строк."
grep -E "starting" /home/vmail/auto_login/logs/auto_multi_login.log && echo
grep -E "exception" /home/vmail/auto_login/logs/auto_multi_login.log && echo
grep -E "stopping" /home/vmail/auto_login/logs/auto_multi_login.log && echo
 
# clear && sh /var/www/viewing_log_files.sh | # grep -E "" /var/log/rm_duplicate_messages/full_rm_duplicate.log | # grep -E "2018_1\s" && echo && # | sort -k7

# Как запускать.
# sh /home/vmail/auto_login/viewingLogFiles.sh & sh /home/vmail/rc147/viewingLogFiles.sh
