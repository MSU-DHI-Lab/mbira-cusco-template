<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 10/6/15
 * Time: 3:32 PM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Site $site) {

    $site->setEmail('xuzhi1@cse.msu.edu');
    $site->setRoot('/~xuzhi1/mbira');

    $dbuser = "mbira_try";
    $dbname = "mbira_try";
    $dbpass = "p151H0PP2s";
    $dbhost = "megaman.matrix.msu.edu";   // the server the database is on


    define("DBUSER",$dbuser);
    define("DBHOST",$dbhost);
    define("DBPASS", $dbpass);
    define("DBNAME", $dbname);

    $host = "mysql:host=".DBHOST.";dbname=".DBNAME;

    $site->dbConfigure($host,DBUSER,DBPASS);
};
