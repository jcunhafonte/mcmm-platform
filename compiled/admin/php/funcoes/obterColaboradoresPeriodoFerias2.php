<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_GET['choice1']) && isset($_GET['choice2'])) {

    $choice1 = $_GET['choice1'];
    $choice2 = $_GET['choice2'];
    $choice3 = $_GET['choice3'];

    $choice1 = $_GET['choice1'];
    $choice1 = strtotime($choice1);
    $novaChoice1 = date('Y-m-d', $choice1);

    $choice2 = $_GET['choice2'];
    $choice2 = strtotime($choice2);
    $novaChoice2 = date('Y-m-d', $choice2);

    if(isset($choice3)){

        function getWorkingDays($startDate, $endDate)
        {
            $begin = strtotime($startDate);
            $end   = strtotime($endDate);

            if ($begin > $end) {
                echo "startdate is in the future! <br />";

                return 0;
            } else {
                $no_days  = 0;
                $weekends = 0;
                while ($begin <= $end) {
                    $no_days++; // no of days in the given interval
                    $what_day = date("N", $begin);
                    if ($what_day > 5) { // 6 and 7 are weekend days
                        $weekends++;
                    };
                    $begin += 86400; // +1 day
                };
                $working_days = $no_days - $weekends;

                return $working_days;
            }
        }

        $nr_work_days = getWorkingDays($novaChoice1, $novaChoice2);

        echo "<input id='numeroDiasRestantesColaboradores' type='number' value='$nr_work_days'>";

    }
}