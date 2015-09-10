<?php
session_start();
$datos=(object)$_SESSION['datos'];
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
/** Include PHPExcel */
require_once('Classes/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Florhedey Garrido Tapia")
							 ->setLastModifiedBy("Florhedey Garrido Tapia")
							 ->setTitle("reporte")
							 ->setSubject("reporte excel")
							 ->setDescription("reporte en excel")
							 ->setKeywords("office 2007 excel caev")
							 ->setCategory("exportados");
// Add some data
$obj=$objPHPExcel->setActiveSheetIndex(0);
#$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, 'PHPExcel');
$styleArray = array(
    'font' => array(
        'bold' => true,
		'color' => array( 'rgb' => '995000')
    )
	);

$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');	
$objPHPExcel->getActiveSheet()->getStyle('A1')
    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$obj->setCellValueByColumnAndRow(0,1,$datos->desde);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);


foreach($datos->titulo as $key => $value )
{
	$obj->setCellValueByColumnAndRow($key,2,$value);
	$obj->getCellBycolumnAndRow($key,2)->getStyle()->applyFromArray($styleArray);
}

foreach($datos->filas as $key => $value )
{
	foreach($value as $i => $v )
	{
		$obj->setCellValueByColumnAndRow($i,($key+3),$v);
		
		$objPHPExcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i))->setAutoSize(true);
	}
}
#$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(120);
#$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setAutoSize(true);
/*
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
// Miscellaneous glyphs, UTF-8
/*
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', '�����������������');
*/
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('reporte');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>

