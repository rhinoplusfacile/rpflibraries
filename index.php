<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TEST SCRIPTS</title>
    </head>
    <body>
        <?php
            function test($name)
            {
                $parts = preg_split('/\s+(as\s+)?/i', $name);
                var_dump($name, $parts);
            }

            test('egoinoege');
            test('egoineo egoinoe');
            test('egoineg as egoinoe');
            test('egoinoeg AS egoineo');
            test('eoginoeg   egoinoeg');
            test('gas andgo');
            test('asasas as asasasas');
        ?>
    </body>
</html>
