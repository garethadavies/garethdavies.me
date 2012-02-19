<?php include '../php/const.php'; ?>

<?php
/*$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);*/
$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);
?>

<?php

// build the individual requests as above, but do not execute them
    $ch_head = curl_init($rootdir . 'php/head.php');
    $ch_header = curl_init($rootdir . 'php/header.php');
	$ch_nav = curl_init($rootdir . 'php/nav.php');
	$ch_footer = curl_init($rootdir . 'php/footer.php');
	$ch_end = curl_init($rootdir . 'php/end.php');
    curl_setopt($ch_head, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_header, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_nav, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_footer, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_end, CURLOPT_RETURNTRANSFER, true);
    
    // build the multi-curl handle, adding both $ch
    $mh = curl_multi_init();
    curl_multi_add_handle($mh, $ch_head);
    curl_multi_add_handle($mh, $ch_header);
	curl_multi_add_handle($mh, $ch_nav);
	curl_multi_add_handle($mh, $ch_footer);
	curl_multi_add_handle($mh, $ch_end);
    
    // execute all queries simultaneously, and continue when all are complete
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running);
    
    // all of our requests are done, we can now access the results
    $response_head = curl_multi_getcontent($ch_head);
    $response_header = curl_multi_getcontent($ch_header);
	$response_nav = curl_multi_getcontent($ch_nav);
	$response_footer = curl_multi_getcontent($ch_footer);
	$response_end = curl_multi_getcontent($ch_end);

	echo $response_head;

?>

</head>

<body id="<?=$name?>">
    
    <?php echo $response_header; ?>
        
        <?php echo $response_nav; ?>
            
            <section>
            
                <ul id="work-listing">
                    <li><a href="<?php echo $rootdir . 'work/youth-space'?>" id="aYouth"><img src="../img/youth_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/hazel-oak'?>" id="aHazel"><img src="../img/hazel_thumb_over.jpg" alt="" title="" /></a></li>
                    <li class="no-margin"><a href="<?php echo $rootdir . 'work/birmingham-city-university'?>" id="aBCU"><img src="../img/bcu_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/gamer-camp'?>" id="aGC"><img src="../img/gc_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/videonet'?>" id="aVideonet"><img src="../img/videonet_thumb_over.jpg" alt="" title="" /></a></li>
                    <li class="no-margin"><a href="<?php echo $rootdir . 'work/richard-woolley'?>" id="aRW"><img src="../img/rw_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/nti-birmingham'?>" id="aNTI"><img src="../img/nti_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/animation-forum'?>" id="aAFWM"><img src="../img/afwm_thumb_over.jpg" alt="" title="" /></a></li>
                    <li class="no-margin"><a href="<?php echo $rootdir . 'work/inspiration-bank'?>" id="aIB"><img src="../img/ib_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/little-palm'?>" id="aLP"><img src="../img/lp_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/fridge-productions'?>" id="aFridge"><img src="../img/fridge_thumb_over.jpg" alt="" title="" /></a></li>
                    <li class="no-margin"><a href="<?php echo $rootdir . 'work/media-talent-bank'?>" id="aMTB"><img src="../img/mtb_thumb_over.jpg" alt="" title="" /></a></li>
                    <li><a href="<?php echo $rootdir . 'work/tales-of-creativity'?>" id="aTOC"><img src="../img/toc_thumb_over.jpg" alt="" title="" /></a></li>
                </ul>
            
            </section>

		<?php echo $response_footer; ?>
		
<?php echo $response_end; ?>