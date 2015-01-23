<?php
namespace classes;
/**
 * Created by IntelliJ IDEA.
 * User: Vilkaz
 * Date: 10.01.2015
 * Time: 17:58
 */
class ParseMe
{


    public static function weekPlanForMMBBSClass($html)
    {

        $rows = self::giveMeRowsFromHtml($html); // gibt alle rows der tabelle (16 Stück, die erste sidn wochentagnamen, nacher kommen die inhalte)
        $time = array(); // ein array wo von der index 1, alle start und end times drin sind.
        $lectures = array();
        $rowNR = 0;
        foreach ($rows as $i => $row) {
            echo '<br>hier wär die initierung lectures[ '.$rowNR.'][x] <br>  ';
            echo '<br><br>' . $i . '=>' . $row;
            $columCounter = 1;
            /**
             hier wird geguckt, hat diese reihe überhaupt noch ein TR oder isses schon zuende.
            nur die alle erste reihe hat mit 100% garantie alle collumns.
             * im ersten ist doi ezeit zu finden.

             * first we check.
            */

            $allImportantTDs = self::allElementsFromHTML('TD colspan=',$row);
            echo'<br> es gabs '.sizeof($allImportantTDs).' TDs die den Ellement TD colspan= in sich hatten';
            foreach ($allImportantTDs as $td){
                echo'<br><br>next TD = '.$td;
                echo'<br>';
            }


/*
            if (strpos($row, 'TD') != null) {
                //hier wird geguckt ob diese TR über eine Font methode verfügt. denn die Daten stehen nu rin Font tags !
                if (strpos($row, 'font') != null) {
                    /*
                    //jetzt sind wir in einem untericht drinnen, der immer 3 t rellemente ALS ERSTES HAT hat
                    // im mittelrem sind leider mehr als 1 font, daher können wir nicht direkt fonts
                    // inhalt sich nehmen, sondern müssen zuerstnach TRs filtern.
                    Alternativ könnten wir nach FETT markierten sachen suchen als Klassname, und sachen wo klammern vorkommen als Raum,
                    und der rest = Lehrer kürzel.
                                        */
            /*
                    $tr = self::allElementsFromHTML('TR', $row);
                    foreach ($tr as $index => $value) {
                        echo'<br>'.$index.'=>'.$value;
                    }

                    //$lectures[] = self::dayContentFromRow($row);
                }

            }
    */


            $row = self ::giveTagsBack($row);
            echo strip_tags($row, '<TR>');

            $time[] = self:: TimeFromRows($row);
            $lectures[] = self::dayContentFromRow($row);
            $rowNR++;
        }
        echo '<br> lecture';
        echo '<pre>';
        var_dump($lectures);
        echo '<pre>';
        echo '<br> time';
        echo '<pre>';
        var_dump($time);
        echo '<pre>';

    }


    public static function firstElementFromHTML($element, $pureHTML)
    {
        $html = self:: replaceStr($pureHTML);
        $searchHere = '';
        //$html = $pureHTML;
        $searchHere = self::cutUntilElementStarts($element, $html);
        $testString = '';
        do {
            $stringArray = self::addStringUntilNextCloserTag($element, $searchHere);
            $testString .= $stringArray['addThisToString'];
            $searchHere = $stringArray['restString'];
            if (strlen($searchHere) <= 0) {
                // echo '<br><br><br>DI EDATEI IST DURCH UND es gabs kein befriedigendes Ergebniss ! Checke die Eingabe nochmal ! ';
                break;
            }
            //  echo'<br>unser Abschnitt'.$testString;
        } while (self::compareOpeningsAndClosings($element, $testString) == false);
        /*
         echo '<br> es sind nun gleich viele opener und closer Tags des ellements ' . $element . 'in dem String drin.';
         echo '<br> somti wird ein array aus 2 Strings zurückgegeben ';
         echo '<br> \'result\'=>das richtige Ergebniss';
         echo '<br> \'rest\'=>der Rest des Strings für weitere Bearbeitung';
         echo '<br>';
        */
        return ['result' => $testString, 'rest' => $searchHere];
    }

    public static function allElementsFromHTML($element, $html)
    {
        $results = array();
        $counter = 0;

        do {
            $strings = self::firstElementFromHTML($element, $html);
            $results[$counter] = $strings['result'];
            $html = $strings['rest'];
            $counter++;
        } while (strpos($html, $element) != null);
        return $results;

    }


    public static function cutOut($giveMeThat, $fromThis)
    {
        $giveMeThat = self::replaceStr($giveMeThat);
        $fromThis = self::replaceStr($fromThis);
        $beginCutAt = strpos($fromThis, '[' . $giveMeThat); // + strlen($giveMeThat) +1;
        $endCutAt = strpos($fromThis, '/' . $giveMeThat . ']') + strlen($giveMeThat) + 2;
        $result = substr($fromThis, $beginCutAt, $endCutAt - $beginCutAt);
        // echo '<br>Ergebniss=' . $result;

    }


    private static function replaceStr($string)
    {
        $string = str_replace("<", "[", $string);
        $string = str_replace(">", "]", $string);
        return $string;
    }

    private static function giveTagsBack($string)
    {
        $string = str_replace("[", "<", $string);
        $string = str_replace("]", ">", $string);
        return $string;
    }

    private static function cutUntilElementStarts($element, $html)
    {
        $beginCutAt = 1;
        $opener = '[' . $element . '<br>';
        // echo'<br> opener = '.$opener;
        //echo '<br><br> wir müssen nun den Opener in dem folgendem String finden:';
        // echo '<br>' . $opener;
        $beginCutAt = strpos($html, $opener);
        //  echo'<br><br> unser SearchString sol lerst ab ellement Nr '.$beginCutAt;
        $restString = substr($html, strpos($html, '[' . $element));
        //  echo'<br> reststring = '. $restString;
        return substr($html, strpos($html, '[' . $element));
    }

    private static function compareOpeningsAndClosings($element, $testString)
    {
        $opening = '[' . $element;
        $closing = '/' . $element . ']';
        $amountOfOpenings = substr_count($testString, $opening);
        $amountOfClosings = substr_count($testString, $closing);
        return (($amountOfOpenings == $amountOfClosings) && ($amountOfClosings > 0));
    }


    private static function addStringUntilNextCloserTag($element, $html)
    {
        $endCutAt = strpos($html, '/' . $element . ']') + strlen($element) + 2;
        return ['addThisToString' => substr($html, 0, $endCutAt), 'restString' => substr($html, $endCutAt)];
    }


    private static function giveMeRowsFromHtml($html)
    {
        $table = self::firstElementFromHTML('TABLE', $html)['result'];
        $rows = array();
        $stringArray = array();
        $searchHere = $table;
        for ($i = 0; $i <= 32; $i++) {
            $stringArray = self::firstElementFromHTML('TR', $searchHere);
            // jede wite tr ist einfach leer, diese werden hier rausgefiltert.
            if (strpos($stringArray['result'], 'TD') != null) {
                $rows[] = $stringArray['result'];
            }
            $searchHere = $stringArray['rest'];
        }
        return $rows;
    }


    private static function TimeFromRows($row)
    {
        $fonts = self::allElementsFromHTML('font', $row);
        return
            array('startTime' => self::timeFromRow($fonts[1], '[', ']'),
                'endTime' => self::timeFromRow($fonts[2], '[', ']'));
    }

    private static function timeFromRow($string, $opener, $closer)
    {
        do {
            $beginCutHere = strpos($string, $closer);
            $string = substr($string, $beginCutHere + 1);
            $endCurHere = strpos($string, $opener);
            $string = substr($string, 0, $endCurHere);
        } while (strpos($string, $closer) != null);
        return $string;
    }

    private static function dayContentFromRow($row)
    {
        $fonts = self::allElementsFromHTML('font', $row);
        $row = self ::giveTagsBack($row);
        echo strip_tags($row, '<TR>');
        foreach ($fonts as $i => $f) {
            $f = self ::giveTagsBack($f);
            echo '<br>' . $i . '=>' . strip_tags($f, '<TR>');
        }
        return $fonts;
    }

    private static function removeTagContent($row)
    {
        $beginCutHere = strpos($row, '[');
        $restString = $row;
        while ($beginCutHere != null) {
            $endCut = strpos($restString, ']');
            $restString = substr($restString, $endCut);
        }
    }
}




