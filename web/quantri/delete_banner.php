<?php

	if($_SESSION['kh_login_id']){
		$iduser=$_SESSION['kh_login_id'];
		$idshop=get_field('tbl_shop','iduser',$iduser,'id');
		$shop = getRecord('tbl_shop',"id ='".$idshop."'");
		print_r($shop);
		if(file_exists('../'.$shop['banner'])) @unlink('../'.$shop['banner']);
		
		$arrField = array(
			"banner"          => "''"
		); 
		$result = update("tbl_shop",$arrField,"id='".$shop['id']."'");
		echo '<script>window.location="./?act=home&cat='.$_REQUEST['cat'].'&page='.$_REQUEST['page'].'&code=1"</script>';
		
	}
?>