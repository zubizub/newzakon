<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:left; width:120px">����</th>
    <th style="text-align:left; width:120px">������</th>
    <th style="text-align:left; width:120px">������</th>
    <th style="">��� �������������</th>
    <th style="text-align:right; width:180px">������������</th>
  </tr>


<?

//������ � ����
$result = mysql_query("SELECT * FROM logs ORDER BY id DESC LIMIT 220");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		echo "
		  <tr>
			<td>$myrow[date]</td>
			<td>$myrow[razdel]</td>
			<td>$myrow[who_edit]</td>
			<td>$myrow[action]</td>
			<td style='text-align:right'>$myrow[user]</td>
		  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}

?>

</table>

<br>
<div style="font-size:12px; font-weight:bold">������� ���������� ��������� 220 �������� � ������� ����������.</div>