<div class="slider box">
	<div style="height:290px; background-color:#FFF; position:relative">               
		<?            
                $result_pages = mysql_query("SELECT * FROM pages WHERE url='3'");
                $kol_pages = mysql_num_rows($result_pages);
                $i=1;
                if ($kol_pages != 0) 
                {
                    $myrow_pages = mysql_fetch_array($result_pages);
                    
                    do
                    {
                        $TITLE_S[$i] = $myrow_pages[name];
                        $TEXT_S[$i] = strip_tags($myrow_pages[text]);
                        if ($i==1) {$disp='block';} else {$disp='none';}
                        
                        echo "<img src='/cms/modul/materials/upload/img/$myrow_pages[img]' style='position:absolute; z-index:20; top:0px; right:0px; width:100%; height:100%; display:$disp' class='slid_img slid_img$i'>";
                        $i++;
                    }while($myrow_pages = mysql_fetch_array($result_pages));
                }
            ?>               
    
    	<div style="width:300px; height:290px; background-image:url(img/bg_slider.png); z-index:30; color:#FFF; position:absolute; right:0px; top:0px;">

			<?
                for ($j=1; $j<$i; $j++)
                {
                    if ($j==1) {echo "<div class='title_slid title_slid$j'>$TITLE_S[$j]</div>";} 
					else {echo "<div class='title_slid title_slid$j' style='display:none'>$TITLE_S[$j]</div>";}
                }
            ?>                
        	

		<?
                for ($j=1; $j<$i; $j++)
                {
                    if ($j==1) {echo "<div class='text_slid type_devel text_slid$j'>$TEXT_S[$j]</div> ";} 
					else {echo "<div class='text_slid type_devel text_slid$j' style='display:none'>$TEXT_S[$j]</div> ";}
                }
            ?>                        
        	                   
        </div>    
        <img src="/img/slid_elem.png"  style="position:absolute; z-index:50; top:44px; right:300px;">

        <div class="slid_downblock">
			<?
                for ($j=1; $j<$i; $j++)
                {
                    if ($j==1) {echo '<a href="#" class="popup slid_btn slid_btn_h" num_slide="'.$j.'"></a>';} 
					else {echo '<a href="#" class="popup slid_btn" num_slide="'.$j.'"></a>';}
                }
            ?>
            <input type="hidden" name="count_slide" class="count_slide" value="<? echo $j; ?>">
        </div>
    </div>
</div>     