<?php
require_once '../../libs/PHPExcel_1.8.0/Classes/PHPExcel.php';//importPHPExcel类文件
$upFilePath = "./uploads";//上传文件暂存目录
if (file_exists($_FILES['fileToUpload']['tmp_name'])) {
    $ok = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upFilePath .$_FILES['fileToUpload']['name']);
}
//$ok用于判断是否上传成功和是否移动重命名

/**读取excel文件的方法**/
function readxls($file){
$exelfile= $file;//上传文件被移动后的路径和文件名    
$PHPReader = new PHPExcel_Reader_Excel2007(); 
/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/ 
if(!$PHPReader->canRead($exelfile)){ 
$PHPReader = new PHPExcel_Reader_Excel5(); 
if(!$PHPReader->canRead($exelfile)){ 
echo 'no Excel'; 
return ; } 
}    
$PHPExcel = $PHPReader->load($exelfile); 
/**读取excel文件中的第一个工作表*/ 
$currentSheet = $PHPExcel->getSheet(0); 
/**取得最大的列号*/ 
$allColumn = $currentSheet->getHighestColumn(); 
/**取得一共有多少行*/ 
$allRow = $currentSheet->getHighestRow(); 
/**新建一个空数组**/
$a=array();
/**从第二行开始输出，因为excel表中第一行为列名*/ 
for($currentRow = 2;$currentRow <= $allRow;$currentRow++){ 
/**从第A列开始读取*/ 
    $b=array('name'=>'','score'=>'','credit'=>'');
    for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){ 
        $val=$currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**获取该格的数据，其中ord()将字符转为十进制数*/ 
        if ($currentColumn === 'A') {
                iconv('utf-8','gbk//IGNORE', $val);//对汉字转码成utf-8
                $b['name'] = $val;
            }
        if ($currentColumn === 'B') {
                $b['score'] = $val;
            }
        if($currentColumn==='C'){
            $b['credit']=$val;
            }           
    }
    array_push($a,$b); 
}
return $a;

}

if($ok === FALSE){
    echo json_encode('{msg:上传失败}');
  }else{
  $path=$upFilePath .$_FILES['fileToUpload']['name'];    
  $arr=readxls($path);    
  echo "{msg:" . json_encode($arr) . "}";
  }
?>

