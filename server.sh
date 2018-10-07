#!/bin/bash

# coded by shutdown57 ( alinko )
# < alinkokomansuby@gmail.com >
# https://justalinko.github.io

# COLOR | WARNA
m="\e[0;31m" # merah
k="\e[0;33m" # kuning
h="\e[0;32m" # hijau
b="\e[0;34m" # biru
lm="\e[1;31m" # merah terang
lk="\e[1;33m" # kuning terang
lh="\e[1;32m" # hijau terang
lb="\e[1;34m" # biru terang seterang masa depan kita.
n="\e[0m" # clear / netral
w="\e[1;37m" # putih tebal


## check dependencies & internet connection ##
x_check()
{
	echo "[!] Checking internet connection ..."
	ping 8.8.8.8 -c 3 > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo "[!] `uname -n` Now online. ready for work !"
		sleep 1
	else
		echo "[-] `uname -n` Offline :'( "
		echo -n "[?] Apakah anda ingin melanjutkan? [y/N] "; read yn
		if [[ $yn == 'N' || $yn == '' || $yn == 'n' ]]; then
			echo "[@] Exiting program ..."
			sleep 1
			exit 
		fi
	fi
	echo "[!] Checking Dependencies ..."
	sleep 1
	echo "----------------------------------"
	echo -n "[!] WGET ........... "
	which wget > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		sleep 0.5
	else
		echo -e $lm"[ERROR]"$n
		echo "[@] Installing wget ........."
		apt-get install wget -y
	fi
	echo -n "[!] CURL ........... "
	which curl > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		sleep 0.5
	else
		echo -e $lm"[ERROR]"$n
		echo "[@] Installing curl ........"
		apt-get install curl -y
	fi
	echo -n "[!] UNZIP ........... "
	which unzip > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		sleep 0.5
	else
		echo -e $lm"[ERROR]"$n
		echo "[@] Installing unzip ........."
		apt-get install unzip -y
		x_check
	fi
	clear
}
## end check ##

x_add_repo()
{
	echo -n "[!] Checking apt-add-repository ..."
	which apt-add-repository > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		apt-get install -y software-properties-common
		x_add_repo
	fi
	cat /etc/apt/sources.list.d/ondrej-php7.0-*.list > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo "[!] Updating system ..."
		apt-get update -y
	else
		add-apt-repository ppa:ondrej/php
		echo "[!] Updating system ..."
		apt-get update -y
		apt-get upgrade -y
	fi
}

## banner function ##
x_banner()
{

echo -e "[!]     $lh   Installer v1.0 2018  $n     [!]"
echo -e $lm"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"$n
echo "Date     :: "`date`
echo "Hostname :: "`hostname`
echo "Kernel   :: "`uname -a`
echo -e $lk"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"$n
echo ""
}
## end banner function ##



## options menu function ##
x_option()
{
	echo -e $lh"[1]$n Update & Upgrade system "
	echo -e $lh"[2]$n Install LAMPP ($lk Apache2$n )"
	echo -e $lh"[3]$n Install LEMPP ($lb Nginx$n )"
	echo -e $lh"[4]$n Install wordpress and configure."
	echo -e $lh"[5]$n Install Monitorix"
	echo -e $lh"[6]$n Remove VirtualHost ( Blog )."
	echo -e $lh"[7]$n Remove all"
	echo -e $lh"[8]$n Fix error"
	echo -e $lh"[9]$n Upgrade Server."
	echo -e $lh"[10]$n Install iOnCube"
	echo ""
	echo -n -e "`uname -n`#Options >>"; read opt
}
## end options menu function ##

## monitorix install function ##
x_monitorix()
{
	echo "[!] Downloading Monitorix please wait .... "
	wget https://www.monitorix.org/monitorix_3.10.1-izzy1_all.deb -O monitorix_alinko.deb > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	apt-get install rrdtool perl libwww-perl libmailtools-perl libmime-lite-perl librrds-perl -y
	apt-get install libdbi-perl libxml-simple-perl libhttp-server-simple-perl libconfig-general-perl -y
	apt-get install libio-socket-ssl-perl -y
	echo "[!] Installing monitorix ...."
	dpkg -i monitorix_alinko.deb
	echo -n "[!] Configuring monitorix ..."
	sed -i "s|base_url = /monitorix|base_url =/m|g" /etc/monitorix/monitorix.conf
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	echo "[!] Restarting monitorix ..."
	/etc/init.d/monitorix restart
	echo -e "[!] Done.. access monitorix to $lk http://server:8080/m $n"
}
## end monitorix install func ##


## LAMPP AND LEMPP INSTALLATION AND CONFIGURATION ##
x_lampp()
{
	echo "[!] Installing Apache please wait ..."
	apt-get install apache2 -y
	echo "[!] Enable rewrite mode ..."
	a2enmod rewrite
	echo "[!] Installing MariaDB-Server please wait ..."
	apt-get install mariadb-server -y
	mysql_secure_installation
	x_add_repo
	echo "[!] Installing PHP please wait ..."
	apt-get install php7.0 php7.0-common php7.0-cli php7.0-curl php7.0-zip php7.0-imagick php7.0-mbstring php7.0-mysql libapache2-mod-php7.0 -y
	echo "[!] Installing phpmyadmin ..."
	apt-get install phpmyadmin -y
	echo "[!] Fixing broken install ..."
	apt-get -f install
}
x_lempp()
{
	echo "[!] Installing nginx ...."
	apt-get install nginx -y
	echo "[!] Checking firewall ..."
	which ufw > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
			echo -e $lh"[!] Detected firewall ..."$n
			sleep 0.5
			echo "[!] Allowing nginx in firewall ..."
			ufw allow 'Nginx HTTP'
			ufw status
			if [[ $? -eq 0 ]]; then
				echo -e $lh"[!] Nginx firewall allowed!"$n
			else
				echo -e $lm"[!] Nginx firewall not allowed :("$n
			fi
		else
			echo -e $lk"  Firewall not found."$n
	fi

	echo "[!] Installing MariaDB-Server ..."
	apt-get install mariadb-server -y
	mysql_secure_installation

	echo "[!] Installing phpmyadmin ..."
	apt-get install phpmyadmin -y
	echo "[!] Creating symlink '/usr/share/phpmyadmin' ..."
	ln -s /usr/share/phpmyadmin/ /var/www/html/

	x_add_repo
	echo "[!] Installing PHP please wait ..."
	apt-get install php7.0 php7.0-fpm php php7.0-common php7.0-cli php7.0-curl php7.0-zip php7.0-imagick php7.0-mbstring php7.0-mysql -y
	echo "[!] Load php.ini file ... "
	php -r 'echo php_ini_loaded_file();' > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		echo -n -e "php.ini file :"$lk
		phpini=$(php -r 'echo php_ini_loaded_file();')
		echo $phpini
		echo $n
	else
		echo -e $lm"[ERROR]"$n
		echo "php.ini not found.";
		exit;
	fi
	echo "[!] Setting cgi.fix_pathinfo ..."
	sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" $phpini
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	wget http://x.linuxcode.org/default-config.txt -O /etc/nginx/sites-available/default
	dpkg -s php | grep Status > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		v=$(php -r 'echo phpversion();')
		IFS="." read -r -a vv <<< "$v"
		pv=${vv[0]}.${vv[1]}
	else
		pv="null"
	fi
	echo "[!] Restarting php7.0-fpm ..."
	/etc/init.d/php7.0-fpm restart
	echo "[!] Restarting nginx ..."
	/etc/init.d/nginx restart
	echo "[!] Fixing broken install ..."
	apt-get -f install


}
## EOF ########################################

## WORDPRESS INSTALLATION ##
x_wordpress()
{
	if [[ ! -f wp_alinko.zip ]]; then
			echo -n -e "[!] Downloading wordpress please wait ..."
			wget https://wordpress.org/latest.zip -O wp_alinko.zip > /dev/null 2>&1
			if [[ -f wp_alinko.zip ]]; then
				echo -e $lh"[OK]"$n
			else
				echo -e $lm"[ERROR]"$n
				exit
			fi
	fi
	webserver=""
	echo -n -e "[!] Checking Apache ..."
	sleep 0.5
	cat /etc/apache2/apache2.conf > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		webserver="apache2"
	else
		echo -e $lm"[ERROR]"$n
		echo "[Apache Not installed]"
	fi
	echo -n -e "[!] Checking nginx ..."
	sleep 0.5
	cat /etc/nginx/sites-available/default > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		webserver="nginx"
	else
		echo -e $lm"[ERROR]"$n
		echo "[nginx Not installed]"

	fi
	if [[ $webserver == "" ]]; then
	    echo "[!] Anda harus menginstall webserver nginx/apache2 !"
		exit
	fi
	echo -n -e "Masukin domain [ex : mawar.com] ::"; read domain
	xzip="/var/www/${domain}"
	unzip wp_alinko.zip -d $xzip
	echo -e -n "[!] Moving $xzip/wordpress to $xzip ..."
	mv $xzip/wordpress/* $xzip/
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	echo -e -n "[!] Giving permission for$lh $xzip $n ..."
	chmod 755 -R $xzip && chown www-data:www-data -R $xzip
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	echo -e -n "[!] Moving wp-config-sample.php to wp-config.php ..."
	sleep 1
	mv $xzip/wp-config-sample.php $xzip/wp-config.php
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	if [[ $webserver == 'apache2' ]]; then
		
		x_virtualHost $domain
	elif [[ $webserver == 'nginx' ]]; then

		x_virtualHost_nginx $domain
	else
		exit
	fi

	wget http://api.wordpress.org/secret-key/1.1/salt -O salt.wp
	sed -i '/#@-/r salt.wp' $xzip/wp-config.php
	sed -i "/#@+/,/#@-/d" $xzip/wp-config.php

	
	echo -e -n "[!] Configuring database ..."
	sleep 1
	echo ""
	echo "[?] Untuk membuat user & database baru di perlukan akses root di database server."
	echo -n "[?] Masukan password dari 'root' ::"; read pwroot
	echo ""
	echo "[------------ DATABASE CONFIGURATION ----------]"
	echo ""
	IFS="." read -r -a info <<< "$domain"
	db=$(echo db_${info[0]} | sed "s/-/_/g")
	user=$(echo u_${info[0]} | sed "s/-/_/g")
	pass=`cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 12 | head -n 1`
	echo "Hostname      : localhost"
	echo "Username      : $user"
	echo "Database name : $db "
	echo "password      : $pass"

	if [[ $ynx == 'y' || $ynx == 'Y' || $ynx == '' ]]; then
		echo -n -e "[!] Creating user $lh $user $n ..."
		mysql -u 'root' -p$pwroot -h "localhost" -e "CREATE USER '$user'@'localhost';" > /dev/null 2>&1 
		if [[ $? -eq 0 ]]; then
			echo -e lh"[OK]"$n
		else
			echo -e $lm"[ERROR]"$n
		fi
		echo -n -e "[!] Creating database$lh $db $n ..."
		mysql -u 'root' -p$pwroot -h "localhost" -e "drop database if exists $db;create database $db;"
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
		else
			echo -e $lm"[ERROR]"$n
			exit
		fi
		echo -n -e "[!] Giving access permission to '$user' ..."
		mysql -u 'root' -p$pwroot -h "localhost" -e "GRANT ALL PRIVILEGES ON $db.* TO '$user'@'localhost' identified by '$pass';"
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
			echo "[!] Show databases from user '$user' ..."
			mysql -u $user -p$pass -h "localhost" -e "show databases;"
		else
			echo -e $lm"[ERROR]"$n
		fi

	fi
	echo "[!] Configuring wp-config.php ..."
	echo ""
	sleep 0.5
	echo -n "[+] Setting hostname to 'localhost' ..."
	sed -i "s/localhost/localhost/g" $xzip/wp-config.php
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	sleep 0.5
	echo -n "[+] Setting username to $user ..."
	sed -i "s/username_here/$user/g" $xzip/wp-config.php
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	sleep 0.5
	echo -n "[+] Setting password to $pass ..."
	sed -i "s/password_here/$pass/g" $xzip/wp-config.php
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	sleep 0.5
	echo -n "[+] Setting database name to $db ..."
	sed -i "s/database_name_here/$db/g" $xzip/wp-config.php
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	echo " ..... SETTING DATABASE DONE ..... "
	echo ""
	echo -n "[!] Lanjutkan install wordpress CLI ? [Y/n] "; read ayn
	if [[ $ayn == 'y' || $ayn == 'Y' || $ayn == '' ]]; then
		url="http://$domain"
		title="wordpress $domain"
		echo -n "Wordpress::Username   >>"; read username
		echo -n "Wordpress::password   >>"; read password
		echo -n "Wordpress::Email      >>"; read email
		echo "[!] Downloading examples Database ..."
		wget http://x.linuxcode.org/example-db.sql -O example-db.sql
		
		pw_wp=`openssl passwd -salt "Rkm8PYEH" -1 $password`
		echo "[!] password hashing : $pw_wp ...."
		echo -e -n $lb"[i]$n Waiting for finishing installation ..."
		sed "s|username_x|"${username}"|g" -i example-db.sql
		sed "s|password_x|"${pw_wp}"|g" -i example-db.sql
		sed "s|email_x|"${email}"|g" -i example-db.sql
		sed "s|www_site_url|"${url}"|g" -i example-db.sql
		mysql -u 'root' -p$pwroot -D $db < example-db.sql
		#curl -s -X POST -d "weblog_title=${title}&user_name=${username}&admin_password=${password}&admin_password2=${password}&admin_email=${email}&blog_public=0&pw_weak=checked&Submit=Install%20WordPress&language=id" "${url}/wp-admin/install.php?step=2" | grep "Success" > /dev/null 2>&1
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[SUCCESS]"$n
		else
			echo -e $lm"[ERROR]"$n
			exit
		fi
	fi
	sleep 0.5
	echo -e $lh"Installation finished !$n $lk $url $n"
	 rm example-db.sql > /dev/null 2>&1
	 rm salt.wp > /dev/null 2>&1
	echo "----- [DATABASE INFO] -------"
	echo "Hostname      : localhost"
	echo "Username      : $user"
	echo "Database name : $db "
	echo "password      : $pass"
}
############ END WORDPRESS INSTALLATION ############




######### VIRTUALHOST AREA CONFIGURATION #############
x_virtualHost()
{
	echo "[!] Configuring VirtualHost ..."
	echo "
<VirtualHost *:80>
			ServerAdmin webmaster@${1}
			ServerName ${1}
			ServerAlias ${1}
			DocumentRoot /var/www/${1}/
			<Directory />
				AllowOverride All
			</Directory>
			<Directory /var/www/${1}/>
				Options Indexes FollowSymLinks MultiViews
				AllowOverride all
				Require all granted
			</Directory>
			ErrorLog /var/log/apache2/${1}-error.log
			LogLevel error
			CustomLog /var/log/apache2/${1}-access.log combined
</VirtualHost>" > /etc/apache2/sites-available/${1}.conf
	echo "[!] Enable sites ${1} ..."
	a2ensite $1
	echo "[!] Restarting apache2 ..."
	/etc/init.d/apache2 restart
	echo "[!] Setting VirtualHost Done .."
}

x_ioncube()
{
	uname -i | grep "64" > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo "[!] Detected 64bit system ..."
		sis="64"
	else
		echo "[!] Detected 32bit system ..."
		sis="32"
	fi
	echo "[!] Downloading iOnCube ..."
	if [[ $sis == "64" ]]; then
		wget http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz
		tar xfz ioncube_loaders_lin_x86-64.tar.gz
	elif [[ $sis == "32" ]]; then
		wget http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86.tar.gz
		tar xfz ioncube_loaders_lin_x86.tar.gz
	fi
	echo "[!] Installing php-gd ..."
	apt-get install php7.0-gd -y

	echo "[!] Detecting extension dir ..."
	php -i | grep extension_dir
	echo "..........................."
	echo -n "Masukan directory extension_dir ::"; read exdir
	echo "[!] Copying loader ioncube ..."
	cp ioncube/ioncube_loader_lin_7.0.so $exdir/
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
	else
		echo -e $lm"[ERROR]"$n
		exit
	fi
	echo "[!] Configuring '/etc/php/7.0/apache2/php.ini' ..."
	echo "zend_extension = /usr/lib/php/20151012/ioncube_loader_lin_7.0.so" >> /etc/php/7.0/apache2/php.ini
	echo "[!] Configuring '/etc/php/7.0/cli/php.ini' ..."
	echo "zend_extension = /usr/lib/php/20151012/ioncube_loader_lin_7.0.so" >> /etc/php/7.0/cli/php.ini
	echo "[!] Configuring '/etc/php/7.0/cgi/php.ini' ..."
	echo "zend_extension = /usr/lib/php/20151012/ioncube_loader_lin_7.0.so" >> /etc/php/7.0/cgi/php.ini
	echo "[!] Configuring '/etc/php/7.0/fpm/php.ini' ..."
	echo "zend_extension = /usr/lib/php/20151012/ioncube_loader_lin_7.0.so" >> /etc/php/7.0/fpm/php.ini

	echo "[!] Restarting ..."
	/etc/init.d/apache2 restart
	/etc/init.d/php7.0-fpm restart

	echo "[~]  Done ....."

	php -v

	echo " --- enter for continue ---"
	read x
}

x_virtualHost_nginx()
{
wget http://x.linuxcode.org/config.txt -O example-config.txt

sed -i "s|domain_example|${1}|g" example-config.txt
mv example-config.txt /etc/nginx/sites-available/${1}
echo "[!] Creating symlink '/etc/nginx/sites-available/${1}' to '/etc/nginx/sites-enabled/${1}"
	ln -s /etc/nginx/sites-available/${1} /etc/nginx/sites-enabled/${1} 
echo "[!] Restarting nginx ..."
	/etc/init.d/nginx restart
echo "[!] Setting VirtualHost Done ..."	
rm example-config.txt
}
########### END VIRTUALHOST AREA CONFIGURATION ################


x_update_upgrade()
{
	apt-get upgrade -y
	apt-get update -y
	apt-get -f install
	apt-get update --fix-missing
	apt-get autoremove
	apt-get install unzip
}
x_back()
{
	echo "[!] Proses telah selesai ..."
	echo -n "[?] Apakah anda ingin kembali ke menu utama ? [Y/n] "; read x
	if [[ $x == 'y' || $x == '' || $x == 'Y' ]]; then
		x_main
	else
		echo "[!] Keluar dari program ..."
		sleep 1
		exit
	fi
}
x_action()
{
	if [[ $opt == '1' ]]; then
		x_update_upgrade
		x_back
	elif [[ $opt == '2' ]]; then
		x_lampp
		x_back
	elif [[ $opt == '3' ]]; then
		x_lempp
		x_back
	elif [[ $opt == '4' ]]; then
		x_wordpress
		x_back
	elif [[ $opt == '5' ]]; then
		x_monitorix
		x_back
	elif [[ $opt == '6' ]]; then
		x_remove_vhost
		x_back
	elif [[ $opt == '7' ]]; then
		x_remove_all
		x_back
	elif [[ $opt == '8' ]]; then
		x_fix_error
		x_back
	elif [[ $opt == '9' ]]; then
		x_upgrade
		x_back
	elif [[ $opt == '10' ]]; then
		x_ioncube
		x_back
	else
		x_main
	fi
}
x_remove_vhost()
{
	webserver=""
	echo -n -e "[!] Checking Apache ..."
	sleep 0.5
	cat /etc/apache2/apache2.conf > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		webserver="apache2"
	else
		echo -e $lm"[ERROR]"$n
		echo "[Apache Not installed]"
	fi
	echo -n -e "[!] Checking nginx ..."
	sleep 0.5
	cat /etc/nginx/sites-available/default > /dev/null 2>&1
	if [[ $? -eq 0 ]]; then
		echo -e $lh"[OK]"$n
		webserver="nginx"
	else
		echo -e $lm"[ERROR]"$n
		echo "[nginx Not installed]"
		
	fi
	if [[ $webserver == "" ]]; then
		echo "[!] Anda harus menginstall webserver nginx/apache2 !"
		exit
	fi
	echo -n "Masukan nama domain ::"; read dm

	if [[ $webserver == 'apache2' ]]; then
		echo -n "[!] Checking domain ..."
		ls /etc/apache2/sites-available/  | grep "${dm}" > /dev/null 2>&1
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n" -> Domain $dm ada "
		else
			echo -e $lm"[ERROR]"$n" -> Domain $dm tidak ada"
			exit
		fi
		echo -n "[!] Disabling vHost $dm ..."
		a2dissite $dm
		echo -n "[!] Removing vhost configuration $dm ..."
		rm /etc/apache2/sites-available/${dm}.conf
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
		else
			echo -e $lm"[ERROR]"$n
			exit
		fi
		echo "[!] Restarting webserver ..."
		/etc/init.d/apache2 restart
	elif [[ $webserver == 'nginx' ]]; then
		echo -n "[!] Checking domain ..."
		ls /etc/nginx/sites-available/ | grep "${dm}" > /dev/null 2>&1
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n" -> Domain $dm ada "
		else
			echo -e $lm"[ERROR]"$n" -> Domain $dm tidak ada"
			exit
		fi
		echo -n "[!] Removing vHost $dm .."
		rm /etc/nginx/sites-available/${dm}
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
		else
			echo -e $ln"[ERROR]"$n
			exit
		fi
		echo "[!] Restarting webserver ..."
		/etc/init.d/nginx restart
	fi
		echo "[!] Untuk menghapus database blog di perlukan akses root database."
		echo -n "Masukan database root password ::"; read pwroot
		IFS="." read -r -a info <<< "$dm"
		dbname=$(echo db_${info[0]} | sed "s/-/_/g")
		usname=$(echo u_${info[0]} | sed "s/-/_/g")
		echo -n "[!] Removing database $dbname ..."
		mysql -u 'root' -p$pwroot -e "DROP DATABASE $dbname;"
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
		else
			echo -e $lm"[ERROR]"$n
			exit
		fi
		echo -n "[!] Removing user $usname ..."
		mysql -u 'root' -p$pwroot -e "DELETE FROM mysql.user WHERE User='$usname' AND Host='localhost';"
		if [[ $? -eq 0 ]]; then
			echo -e $lh"[OK]"$n
		else
			echo -e $lm"[ERROR]"$n
			exit
		fi
	rm -rf /var/www/${dm}
	echo "[!] Proses menghapus $dm selesai !"
}
x_main()
{
	x_banner
	x_option
	x_action
}
x_remove_all()
{
	apt-get purge apache2 mariadb-server php phpmyadmin nginx monitorix -y
	apt-get purge php7.0 php7.0-common php7.0-cli php7.0-curl php7.0-zip php7.0-imagick php7.0-mbstring php7.0-mysql libapache2-mod-php -y
	apt-get autoremove
	apt-get clean
	apt-get autoclean
}
x_fix_error()
{
	apt-get update -y
	apt-get update --fix-missing
	apt-get upgrade -y
	apt-get -f install -y
	apt-get autoremove -y
	apt-get clean -y
	apt-get autoclean -y
}
x_upgrade()
{
	apt-get install update-manager-core
	do-release-upgrade -d
}
if [[ `whoami` != 'root' ]]; then
	echo "[!] Script ini harus di jalankan oleh superuser (root)."
else
	x_check
	x_main
fi