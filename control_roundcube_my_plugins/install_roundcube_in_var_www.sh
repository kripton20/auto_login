# Удаляем папку web-приложения, копируем папку web-приложения в папку "www", Редактируем файл конфигурации, копируем, изменим владельца папок, установим права, переименовываем.
rm -Rf /var/www/roundcubemail-147-{2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50}/ && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-2 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-3 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-4 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-5 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-6 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-7 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-8 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-9 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-10 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-11 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-12 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-13 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-14 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-15 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-16 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-17 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-18 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-19 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-20 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-21 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-22 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-23 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-24 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-25 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-26 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-27 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-28 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-29 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-30 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-31 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-32 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-33 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-34 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-35 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-36 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-37 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-38 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-39 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-40 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-41 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-42 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-43 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-44 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-45 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-46 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-47 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-48 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-49 && 
cp -r /home/vmail/rc147/ /var/www/roundcubemail-147-50 
chown -vR www-data:www-data /var/www/roundcubemail-147-{2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50}/ 
chmod -vR 0755 /var/www/roundcubemail-147-{2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50}/ 

#find /var/www/roundcubemail-1.4.7 -type f -exec chmod 644 {} \;
#find /var/www/roundcubemail-1.4.7 -type d -exec chmod 755 {} \;

mcedit /var/www/roundcubemail-147-2/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-3/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-4/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-5/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-6/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-7/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-8/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-9/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-10/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-11/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-12/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-13/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-14/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-15/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-16/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-17/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-18/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-19/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-20/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-21/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-22/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-23/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-24/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-25/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-26/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-27/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-28/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-29/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-30/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-31/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-32/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-33/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-34/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-35/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-36/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-37/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-38/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-39/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-40/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-41/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-42/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-43/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-44/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-45/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-46/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-47/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-48/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-49/config/config.inc.php && 
mcedit /var/www/roundcubemail-147-50/config/config.inc.php
