<link rel="stylesheet" type="text/css" href="modul/synchronization/css.css">
<script type="text/javascript" src="modul/synchronization/js.js"></script>

<? if (isset($_GET[nom])) { ?>
	<div style="display:inline-block; margin-top:10px; margin-bottom:10px; text-align:center; padding:10px; background-color:#fff5f5; border:1px solid #f7dcdc; color:#333; font-size:14px">��������� <b><? echo $_GET[nom]; ?></b> �������!</div><br><br>
<? } ?>

<div class="export_block">
	<div class="export_block_head">���������� ��� � �������� � �������� (*.xls)</div>
   	<form action="modul/synchronization/obr_import_new_price.php" method="post" enctype="multipart/form-data" class="frm_import">
   		 ����: <input name="file" required type="file" style="width:245px" class="file_new_price">  
        <input name="button" type="submit" value="���������" class="button_save btn_upload_new_price"> 
        <Br>
        <div style="font-size:12px; margin-top: 12px;"><b>���������:</b> ������� | ���� | ����������</div>
   	</form>
</div>


<Br><Br><Br>


<div class="export_block">
	<div class="export_block_head">����� �������������� ������ �������� ���������.</div>
    ���������: 
    <select name="export" class="export" style="padding: 6px;">
        <option value="0">��� ���������</option>
        <?
            $result = mysql_query("SELECT * FROM katalog ORDER BY name ASC");
            $myrow = mysql_fetch_assoc($result); 	
            do
            {
				if ($myrow[url]!='') {$url = "$myrow[url]/$myrow[id]";} else {$url='$myrow[id]';}
                echo "<option value='$url'>$myrow[name]</option>";
            }while($myrow = mysql_fetch_assoc($result));
        ?>    
    </select>
    <a href="?page=export_goods" class="button_save creat_csv popup">�������������� ������</a>
    <a href="#" class="creat_csv_l" style="color:red; display:block; padding:3px;"></a>
</div>


<br><br><br>


<div class="export_block">
	<div class="export_block_head">����� ������������� ������ �������� ��������� � ���� ������� *.csv.</div>
   <form action="modul/synchronization/obr_import.php" method="post" enctype="multipart/form-data" class="frm_import">
   	   <div style="font-size:13px"><b>�������� ������ ��������:</b></div>  
       ������: 
       <select name="artic" class="artic" style="margin-right:10px">
       	<option value="0" class="artic1">1</option>
        <option value="1">2</option>
        <option value="2">3</option>
        <option value="3">4</option>
        <option value="4">5</option>
      </select>
      
       ���: 
       <select name="name_goods" class="name_goods" style="margin-right:10px">
       	<option value="0">1</option>
        <option value="1" selected class="name_goods1">2</option>
        <option value="2">3</option>
        <option value="3">4</option>
        <option value="4">5</option>
      </select>
      
      
       ����: 
       <select name="price_goods" class="price_goods" style="margin-right:10px">
       	<option value="">���</option>
       	<option value="0">1</option>
        <option value="1">2</option>
        <option selected value="2">3</option>
        <option value="3">4</option>
        <option value="4" class="price_goods1">5</option>
      </select>
      
      
      
       ��������: 
       <select name="desc_goods" class="desc_goods" style="margin-right:10px">
        <option value=""  selected>���</option>
       	<option value="0">1</option>
        <option value="1">2</option>
        <option value="2" class="desc_goods1">3</option>
        <option value="3">4</option>
        <option value="4">5</option>
      </select>
      
      
        �����������: 
       <select name="img_goods" class="img_goods" style="margin-right:10px">
        <option value=""  selected>���</option>
       	<option value="0">1</option>
        <option value="1">2</option>
        <option value="2">3</option>
        <option value="3" class="img_goods1">4</option>
        <option value="4">5</option>
      </select>     
      
      � ���������: <input name="img_prefix" type="text" style="width:100px" placeholder="site.ru">
	
    <br>            
             
       ���������: 
        <select name="import">
            <?
                $result = mysql_query("SELECT * FROM katalog ORDER BY name ASC");
                $myrow = mysql_fetch_assoc($result); 	
                do
                {
					if ($myrow[url]!="") {$val = "$myrow[url]/$myrow[id]";} else {$val = "$myrow[id]";}
                    echo "<option value='$val'>$myrow[name]</option>";
                }while($myrow = mysql_fetch_assoc($result));
            ?>    
        </select>
        ����: <input name="file" type="file" style="width:245px">  
        <label style="padding:5px; padding-left:20px; padding-right:20px" class="bitrix_chek"><input name="bitrix" type="checkbox" value=""> ��� ��� 1�-�������</label>
        <input name="button" type="submit" value="���������" class="button_save">    
    </form>
    <br><br>
    ���� ������ ����� ��������� ���:<br><br>
    <img src="img/csv.jpg" width="429" height="295">
    
    <br><br>
    ���� �� ������ ��������� html �����! ���� �� ������������� ������ �� 1�-�������, �� ����� �������� �������� ���� � ������� ������� � ��������� ��������� (���� �� �������� html ����).
    � ������� �� ������ ���� �������, ����� � ��������, �������� �� ������ ������!
</div>