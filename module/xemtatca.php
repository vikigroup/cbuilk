<!-------------------
<script language="javascript">
    var is_busy=false;//neu ajax dang duoc gui thi khong thuc hien gui them
    var page=1; //trang hien tai
    var record_num=6;// so record hien thi
    var stopped=false ;//trang thai phan trang
    $(document).ready(function()
    {
        $('#load_more').click(function()
        {
            $element=$('#content');
            $btn=$(this);
            if(is_busy==true)
            {
                return false;
            }
            page++;
            $btn.html('Loadding...');
            $.ajax({
                type:'get',
                datatype:'',
                url:'',
                data:{},
                success: function()
                {
                    var html='';
                    //neu trang ke het du lieu
                    if(result.length<=record_num)
                    {
                        //lap du lieu
                        //xo du lieu
                        //xoa button loadmore
                    }
                    else
                    {
                        //lap du lieu ,bo recor cuoi cung
                        //them du lieu
                        //xoa button load more
                    }
                }
            })
                .alway(function(){
                    // doi value cho button
                    $btn.html('LOAD MORE');
                    is_busy=false;
                })
        })
    });
</script>
-------------------------------->
<section class="list-cate">
    <!-----
    <h2 class="t-mn-dm">
        Tất cả danh mục
    </h2><!-- End .t-mn-dm -->

    <div class="f-list">
        <ul class="ul-list">
            <?php
            $cate=get_records("tbl_shop_category","status=0 AND  parent=2","sort ASC "," "," ");
            //$cate=get_records("tbl_shop_category","status=0 AND  parent=2","sort ASC"," "," ");
            $t=mysql_num_rows($cate);
            $k=1;
            $n=1;
            while($row_cate=mysql_fetch_assoc($cate)){
                ?>
                <li class="fix-box-sizing">

                    <a href="<?php echo $linkrootshop?>/<?php echo $row_cate['subject'];?>.html"  title="<?php echo $row_cate['name'];?>">
                       <img class="imgAllProduct" src="<?php echo $linkrootshop?>/web/<?php echo $row_cate['image']; ?>"> <?php echo $row_cate['name'];?>
                    </a>
                    <ul>
                        <?php
                        //------------------loadmore----------------------
                        //$page=isset($_GET['page'])? (int)$_GET['page']:1;
                        //if($page<1)
                        //{
                         //   $page=1;
                        //}
                        //$limit=6;
                        //$start=($limit*$page)-$limit;
                        //------------------end#loadmore-------------------
                        $cate1=get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'","sort DESC"," "," ");
                        while($row_cate1=mysql_fetch_assoc($cate1))
                        {
                            ?>
                            <li>
                                <a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html" title=""><?php echo $row_cate1['name'];?>
                                    <img class="imgAllProduct1" src="<?php echo $linkrootshop?>/web/<?php echo $row_cate1['image']; ?>"?>
                                    <!------them load more---------->
                                    <a href="#" class="button" id="load_more">+</a>

                                </a>


                            </li>
                        <?php }?>
                    </ul>
                </li>
            <?php }?>
        </ul>
        <div class="clear"></div>
    </div><!-- End .f-list -->

</section>

