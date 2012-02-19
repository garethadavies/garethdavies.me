<?php include '../../php/const.php'; ?>

<?php
$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);
?>

<?php // build the individual requests as above, but do not execute them
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

	echo $response_head; ?>

</head>

<body id="<?=$name?>">

	<?php echo $response_header; ?>
        
        <?php echo $response_nav; ?>

			<header>
            
            	<h2>Birmingham City University</h2>
            
            	<p class="no-top-margin"><a href="http://www.bcu.ac.uk">http://www.bcu.ac.uk</a></p>
            
            </header>
            
            <div class="work-ipad">
            
            	<div class="flexslider">
            
                    <ul class="slides">
                        <li><img src="../../img/ipad_bcu_1.jpg" alt="" title="Birmingham City University website screenshot" /></li>
                        <li><img src="../../img/ipad_bcu_2.jpg" alt="" title="Birmingham City University website screenshot" /></li>
                        <li><img src="../../img/ipad_bcu_3.jpg" alt="" title="Birmingham City University website screenshot" /></li>
                        <li><img src="../../img/ipad_bcu_4.jpg" alt="" title="Birmingham City University website screenshot" /></li>
                    </ul>
            
            	</div>
            
            </div>

		<?php echo $response_footer; ?>
		
<?php echo $response_end; ?> 