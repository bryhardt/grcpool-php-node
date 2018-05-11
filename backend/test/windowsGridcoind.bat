@echo off
REM This is for simulating gridcoinresearchd on Windows.

if %1%==getinfo (	
	echo {
	echo    "version" : "v3.7.10.0-g250d96a5c",
	echo    "minor_version" : 317,
	echo    "protocolversion" : 180323,
	echo    "walletversion" : 60000,
	echo    "balance" : 36236.55481858,
	echo    "newmint" : 0.00000000,
	echo    "stake" : 0.00000000,
	echo    "blocks" : 1242718,
	echo    "timeoffset" : -261,
	echo    "moneysupply" : 404138752.86833793,
	echo    "connections" : 20,
	echo    "proxy" : "",
	echo    "ip" : "206.221.190.250",
	echo    "difficulty" : {
	echo        "proof-of-work" : 8.23948943,
	echo        "proof-of-stake" : 2.85682759
	echo    },
	echo    "testnet" : false,
	echo    "keypoololdest" : 1525878945,
	echo    "keypoolsize" : 101,
	echo    "paytxfee" : 0.00010000,
	echo    "mininput" : 0.00000000,
	echo    "errors" : ""
	echo }
)

if %1%==superblockage (
	echo {
    echo "Superblock Age" : 82960,
    echo "Superblock Timestamp" : "05-09-2018 21:49:36",
    echo "Superblock Block Number" : "554932",
    echo "Pending Superblock Height" : "0"
	echo }
)

 if %1%==execute  (
 	if %2%==superblockage (
 		echo [
    	echo {
        echo "Command" : "superblockage"
    	echo },
    	echo {
        echo "Superblock Age" : 48079,
        echo "Superblock Timestamp" : "05-10-2018 07:24:32",
        echo "Superblock Block Number" : "1242501",
        echo "Pending Superblock Height" : "0"
    	echo }
		echo ]
 	)
 )