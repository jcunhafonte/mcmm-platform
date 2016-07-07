<?php

session_start();

require("../connection/dbconnection.php");

if (isset($_GET['choice1'])) {

    $choice1 = $_GET['choice1'];

    if (isset($choice1)) {

        function getWorkingDays($startDate, $endDate)
        {
            $begin = strtotime($startDate);
            $end = strtotime($endDate);

            if ($begin > $end) {
                echo "startdate is in the future! <br />";

                return 0;
            } else {
                $no_days = 0;
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

        $query = "SELECT inicio_ferias, fim_ferias, ref_id_colaborador FROM ferias
WHERE YEAR( inicio_ferias ) = ? AND ref_id_colaborador = ?";

        $anoAtual = date('Y');
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'is', $anoAtual, $choice1);
        mysqli_stmt_bind_result($stmt, $dataInicioFerias, $dataFimFerias, $idColaborador);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);

        $dataInicioFerias = (date($dataInicioFerias));
        $dataFimFerias = (date($dataFimFerias));

        $nr_work_days = getWorkingDays($dataInicioFerias, $dataFimFerias);
        $nr_work_days = (20 - $nr_work_days);

        if ($nr_work_days == 1) {
            $textoDiasTrabalho = "1 Dia disponível";
        } else {
            $textoDiasTrabalho = $nr_work_days . " Dias disponíveis";
        }

        echo "$textoDiasTrabalho";

        mysqli_stmt_close($stmt);

    }
}