<article class="search_top_header">
    <form action="<?php echo $linkrootshop ;?>/xu-ly.html" method="post">
        <div class="select_item_search">
            <span class="sp1_select">
                <select class="select22" name="loai" id="loai">
                    <option value="tat-ca" >Tìm tất cả</option>
					<?php
                    $cate=get_records("tbl_shop_category","status=0 AND  parent=2"," "," "," ");
                    while($row_cate=mysql_fetch_assoc($cate)){
                    ?>
                    <option value="<?php echo $row_cate['id'];?>"><?php echo $row_cate['name'];?></option>
                    <?php }?>
                    
                </select>
            </span>
        </div><!-- End .select_item_search -->
        <div class="select_input_search">
            <input name="keyword" id="keyword" class="ipt_s" type="text" placeholder="Nhập từ khóa tìm kiếm..."/>
        </div><!-- End .select_input_search -->
        <input class="btn_s" type="submit" value="&nbsp;"/>
        <div class="clear"></div>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('select.select22').each(function(){
                    var title = $(this).attr('title');
                    if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
                    $(this)
                        .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                        .after('<span class="sp2_select">' + title + '</span>')
                        .change(function(){
                            var val = $('option:selected',this).text();
                            $(this).next().text(val);
                        });
                });
            });
        </script>
        
        </form>
</article><!-- End .search_top_header -->
