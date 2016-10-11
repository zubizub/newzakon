<?

//генерация капчи

 $ARR_number = array('kjh345jnk456','hjkhg87sdf5','sdfg79s6f6gts7','sjoerughs76isert','esrgsueri7129ujgd','sergy74shtg','90845yhggsdf','serghi734th','sdfh78123hnjdr','dfiug7345y3h4');
 
 $i = rand(0,9);
 $primer = "Решите пример: <img src='/img/number/$ARR_number[$i].png' width='25' height='21'>";
 $primer .= "<b>+</b>"; 
 $j = rand(0,9);
 $primer .= "<img src='/img/number/$ARR_number[$j].png' width='25' height='21'>";
 $primer .= "<b>=</b>";
 $rechen_primer = $i + $j;
 $summa_number = ((($rechen_primer*1024)+((228-$rechen_primer*2)*132))*32)*$rechen_primer*3;
?>