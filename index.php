<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>mmbbs Hannover Raumplanungsprojekt</title>
    <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="js/js.js" type="text/javascript"></script>

</head>
<body>
step 1 = parse the list of Classes from mmbbs homepage

<?php

use classes\ParseMe;
use classes\test;

require_once "classes/myAutoloader.php";


$a= new Test;
var_dump($a);



ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


function printIfCan($data)
{
    $type = gettype($data);
    if (
        ($type == 'string') ||
        ($type == 'integer') ||
        ($type == 'float') ||
        ($type == 'double') ||
        ($type == 'boolean')
    ) {
        echo $data;
    } else echo 'cant print that ' . $type;
}


function typeIs($data)
{
    $type = gettype($data);
    if (
        ($type == 'string') ||
        ($type == 'integer') ||
        ($type == 'float') ||
        ($type == 'double') ||
        ($type == 'boolean')
    ) {
        echo '<br> ' . $data . ' ist vom typ' . $type;
    } elseif (
        ($type == 'array') ||
        ($type == 'object')
    ) {
        var_dump($data);
        echo '<br> angegebener parameter  ist ein ' . $type . ' und wird weiter gesplitet';
        splitObject($data);
    } elseif ($type == 'NULL') {
        echo '<br>parameter ist null';
    } elseif ($type == 'resource') {
        echo '<br> es ist recourse, eventuell db abfrage ?';
    } else {
        echo 'es ist kein gültiger php dateityp gegeben worden';
    }
}

function splitObject($data)

{
    echo '<br> starte Split Object Funktion<br>';

    foreach ($data as $index => $foo) {
        echo '<br>index ';
        typeIs($foo);
        echo '<br>value ';
        typeIs($foo);
    }
    echo '<br> Beende Split Object funtiony<br>';

}

$root = 'http://stundenplan.mmbbs.de/plan1011/ver_kla/04/c/c';
$add = '00094.htm';

$parseme = $root . $add;
echo'<br><a href='.$parseme.' target=\"_blank\">'.$parseme.'</a>';
//$html = file_get_html($parseme);

$resultArray=null;
//include 'classes/ParseMe.php';

$html = file_get_contents('tabelle.html');
ParseMe::weekPlanForMMBBSClass(file_get_contents($parseme));


//$resultArray = ParseMe ::elementFromHTML('TABLE',file_get_contents($parseme));
//$resultArray = ParseMe ::elementFromHTML('table',$html);

/*


var_dump($resultArray);


$table = $resultArray['result'];
$t2 = $table;

echo'table2222222222222222222'.$t2;
$resultArray2 = ParseMe ::firstElementFromHTML('TR',$table);





var_dump($resultArray2);
echo'<br><br><br><br><br> das rest array is '.$resultArray2['rest'];
echo'<br><br><br><br><br> JETZ TALL AUF ENIMAL FUNKTIONSTEST';

echo $t2;

$resultArray3 = ParseMe ::allElementsFromHTML('TR',$t2);
var_dump($resultArray3);
echo'<br><br><br><br><br> ALL ELLEMENTS FUNKTION TEST ! das rest array is '.ParseMe ::allElementsFromHTML('TR',$t2)['result'];


//$resultArray = ParseMe ::elementFromHTML('table',$resultArray['rest']);
//var_dump($resultArray);

//$html = file_get_contents($parseme);

//$resultArray = ParseMe ::elementFromHTML('table',file_get_contents($parseme));
//var_dump($resultArray);


/*
ParseTable::cutOut('a', 'ich möchte nichts davon in meinem endstring haben !<a sondern nur das hier> eventuell inclusive dieses A aber in anderen klammern ?</a>das hier kann auch weg.');
/*


$ret = $html->find('td[[colspan=6]');
//$ret=['a'=>'1'];
echo '<br>print check';


foreach ($ret as $i => $foo) {
    printIfCan($i);
    printIfCan($foo);
    echo($foo);
    //echo'<br>'.$index.'=>'.$foo;
}


function getClassname($html)
{
    $table = ($html->find('font'));
    $class = "";
    $ClassDescription = "";
    $endNow = 0;
    foreach ($table as $foo) {
        echo('<br>' . $foo);
        if ($foo->size == 6) {
            $class = $foo;
            $endNow = -2;
        }
        if ($endNow == -1) {
            $ClassDescription = $foo;
            break;
        }
        $endNow++;
    }
    echo('<br> CLASS = ' . $class . ' description=' . $ClassDescription);
}

getClassname($html); //das hier parst die namen der klase und derer beschreibung raus !


//echo $html->plaintext;


$table = $html->find('center');
$html='';


ParseTable::parseMeATable($table);
$counter = 0;

/*
foreach ($table as $index => $foo) {
    printIfCan($foo);
    if ($foo->border == 3) {
        echo('<br>THATS THE ONE ! ' . $foo);
    }
    echo('<br>' . $index);
    printIfCan($foo);
    $counter++;
    foreach ($foo as $i2 => $f2) {
        echo($i2 . '=>' . $f2);
        if ($i2 == 'nodes') {
            echo "DAS HIRE";
            foreach ($f2 as $i3 => $f3) {
                echo('[f3]' . $i3 . '=>' . $f3);
                if ($i3 == 7) {
                    //var_dump($f3);
                    echo '<br> table';
                    $string = (string)$f3;
                    echo "tale soll nun auseinander genomme nwerden";
                    $tableRow = 1;
                    echo('<br>f3 ist vom typ her' . gettype($f3));
                    foreach ($f3 as $i4 => $f4) {
                        echo('<br>f4 ist vom typ her' . gettype($f4));
                        echo('<br>i4 ist vom typ her' . gettype($i4));
                        echo "<br>i4=>f4 --> ";
                        echo $i4 . '=>' . $f4;
                    }

                    printIfCan($f3);
                    echo('length of the string is' . sizeof($string));
                    ?>

                    <script>
                        printme(<?php echo($f3); ?>);
                    </script>
                    <?php
                    echo('<br> end');
                }
            }
        }
    }
}

$html = $html = file_get_html('tabelle.html');

$html='';


ParseTable::parseMeATable($htm);
/*
echo "<br>hier wird localetabelle aufgerufen<br>";
echo($html);

$rows = $html->firstChild();
echo '<br>' . $rows;
$row = $html->find('tr');

?>
<script>printme(<?php echo($row); ?>);</script>
';
<?php
foreach ($row as $i => $foo) {
    echo '<br>i=';
    printIfCan($i);
    echo'=>';
    printIfCan($foo);
    }





ParseTable::parseMeATable($html);

/*
foreach($html->find('center') as $foo);{
    echo ('<br> got one'.$foo);
}
*/
?>
</body>
</html>