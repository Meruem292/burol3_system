<?php
if(isset($_POST['export'])){
    include "db.php";

    $SQL1 = "SELECT CONCAT(age, ' years old') as AgeGroup, COUNT(*) as NumberofResident FROM user GROUP BY age";
    $SQL2 = "SELECT gender as Gender, COUNT(*) as NumberofResident FROM user GROUP BY gender";
    $SQL3 = "SELECT type as DocumentType, COUNT(*) as Count FROM documents WHERE status = 'Approved' GROUP BY type";

    $arrsql = array($SQL1, $SQL2, $SQL3);
    $arrhead = array("Resident By Age", "Resident By Gender", "Total Requested Documents");

    foreach(array_combine($arrsql, $arrhead) as $query => $header) {
        $exportData = $pdo->query($query);

        $header = "$header\n";
        $result = '';

        if ($query === $SQL1) {
            $header .= "Age Group\tCount\n";
        } elseif ($query === $SQL2) {
            $header .= "Gender\tCount\n";
        } elseif ($query === $SQL3) {
            $header .= "Document Type\tCount\n";
        } else {
            for ($i = 0; $i < $exportData->columnCount(); $i++) {
                $header .= $exportData->getColumnMeta($i)['name'] . "\t";
            }
        }

        while ($row = $exportData->fetch(PDO::FETCH_ASSOC)) {
            $line = '';
            foreach ($row as $key => $value) {
                if ($query === $SQL1 || $query === $SQL2 || $query === $SQL3) {
                    $line .= $value . "\t";
                } else {
                    if (!isset($value) || $value == "") {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
            }
            $result .= trim($line) . "\n";
        }
        $result = str_replace("\r", "", $result);

        if ($result == "") {
            $result = "\nNo Record(s) Found!\n";
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=export.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$result\n\n";
    }
}
?>
