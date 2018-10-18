#!/bin/bash
# /**
# ***************************************************************
# * PaniCode v2.0-2018
# * 
# *
# * @author Alin Koko Mansuby < alinkokomansuby@gmail.com >
# * @version 2.0-2018
# * @copyright 2018 (c) alinko.id
# * @license The MIT License (MIT)
# *
# ***************************************************************
# */

which php > /dev/null 2>&1
if [[ $? -eq 0 ]]; then
	echo "[+] PHP Server for development [+] "
	echo ""
	sleep 0.5
	echo "[!] PaniCode :: Listening 127.0.0.1:5758 ..."
	echo -e "\033[1;32m"
	php -S 127.0.0.1:5758 > /dev/null 
	echo -e "\033[0m"
else
	echo "[-] PHP Not installed."
	exit 1
fi