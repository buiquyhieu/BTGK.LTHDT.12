<?php
function excel(){
        require_once 'C:\xampp\htdocs\HieuBQ\PHPExcel\PHPExcel\Classes\PHPExcel.php';
        $filename = 'C:\Users\Administrator\Desktop\bang_diem_hd.xlsx';
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objReader->setReadDataOnly(true);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load("$filename");

        $total_sheets=$objPHPExcel->getSheetCount();

        $allSheetName=$objPHPExcel->getSheetNames();
        $objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow    = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        for ($row = 2; $row <= $highestRow;++$row)
        {
            for ($col = 0; $col <$highestColumnIndex;++$col)
            {
                $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $key=$objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
                $arraydata[$row-2][$key]=$value;
            }
        }
        return $arraydata;
}

