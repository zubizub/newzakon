<?
$query = "SELECT * FROM users WHERE id='$myrow_r[uid]'";
$result_u = mysql_query($query);
$user = mysql_fetch_assoc($result_u);

?> 
<? if ($myrow_r['moderation'] ==1):?>
<tr class="tbl_file_tr11" id="<?=$myrow_r['id'];?>">
  <form action="/blocks/obr_market_offer.php" method="post">
            <td class="tbl_file_td1"><img src="/img/ico_doc.png" class="hidden-xs"><b><?=$myrow_r[usluga];?></b><br/><?=$myrow_r[opisanie];?></td>
            <td class="tbl_file_td2"><img src="/img/ico_money.png" class="ico_money hidden-xs"><?=$myrow_r[cena];?></td>
                <td class="tbl_file_td3"><a href="/userinf/<?=$user[uid];?>/" class="nameUserDoc"><?= $user[fio]; ?></a></td>
                <!-- <td class="tbl_file_td3">Телефон: <?//= $user[phone]; ?></td> -->
                <td class="tbl_file_td4 tbl_file_td4-11">
                 <input type="hidden" value="<?=$myrow_r[id];?>" name="id">
    
    
    <input class="banMainRazmestit-title4_ blueBtn" type="submit" class="to-cart" value="заказать">
    
                </td>
                </form>
          </tr>
<?endif;?>