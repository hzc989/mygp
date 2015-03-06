<?php
/**
 * PHPEXCEL生成excel文件
 * @author:HoustonWong
 * @desc 支持任意行列数据生成excel文件，暂未添加单元格样式和对齐
 */
require_once '../../libs/PHPExcel_1.8.0/Classes/PHPExcel.php';//importPHPExcel类文件


$print_str = $_GET['printStr'];
$fileName = "test_excel";//要生成的Excel文件名
//构建标题头字段
$headArr = array("课程","成绩","学分");
//数据 二维数组，每个数组代表一行，每个数组的值代表一行的一列，对应上面的标题头
$data = explode("|",$print_str);
//主调方法，调用号就会弹出下载提示框
getExcel($fileName,$headArr,$data);

 
function getExcel($fileName,$headArr,$data){
    if(empty($data) || !is_array($data)){
        die("data must be a array");
    }
    if(empty($fileName)){
        exit;
    }
    $date = date("Y_m_d",time());
     $fileName .= "_{$date}.xlsx";
 
    //创建新的PHPExcel对象
    $objPHPExcel = new PHPExcel();
   $objPHPExcel->getProperties()->setCreator('HoustonWong')
        ->setLastModifiedBy('HoustonWong')
        ->setTitle('Office 2007 XLSX Document')
        ->setSubject('Office 2007 XLSX Document')
        ->setDescription('Document for Office 2007 XLSX, generated using PHPExcel classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Result file');

     
    //设置表头---列名
    $key = ord("A");
    foreach($headArr as $v){
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
        $key += 1;
    }
    //填充课程、成绩、学分
    $row = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();
    foreach($data as $keyRow => $RowValue){ //行写入
        $span = ord("A");
        $rowArray=explode(",",$RowValue);
        foreach($rowArray as $keyColumn=>$ColumnValue){// 列写入
            $j = chr($span);
            $objActSheet->setCellValue($j.$row,$ColumnValue);
            $span++;
        }
        $row++;
    }
    //空一行 填充GPA 算法等等
    $row=$row+2;
    $Standard_GPA =$_GET['standard_num'];//标准GPA
    $Common_GPA =  $_GET['common_num'];//其他常见算法计算所得GPA
    $scoreType =$_GET['scoreType'];//成绩制
    $arith_str = $_GET['arithmeticType'];//算法
    
    $span = ord("A");
    $j = chr($span);
    $objActSheet->setCellValue($j.$row,"标准GPA");
    $span++;
    $j = chr($span);
    $objActSheet->setCellValue($j.$row,$Standard_GPA);
    $row++;
    $span = ord("A");
    $j = chr($span);
    $objActSheet->setCellValue($j.$row,$arith_str."GPA");
    $span++;
    $j = chr($span);
    $objActSheet->setCellValue($j.$row,$Common_GPA);
    
    /**配置下载excel文件头部等**/    
    $fileName = iconv("utf-8", "gb2312", $fileName);
    //设置活动单指数到第一个表,所以Excel打开这是第一个表
    $objPHPExcel->setActiveSheetIndex(0);
    //将输出重定向到一个客户端web浏览器(Excel2007)
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment; filename=\"$fileName\"");
          header('Cache-Control: max-age=0');
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $objWriter->save('php://output'); //文件通过浏览器下载
  exit;
 }?>

