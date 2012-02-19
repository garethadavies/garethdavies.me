<?php include '../php/const.php'; ?>

<?php
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

			<h2>About</h2>
            
            <div class="about-column-left">
            
            	<p>My name is Gareth Davies and I am a professional website designer and developer living in Birmingham, England.</p>

                <p>I offer a broad range of services focusing on the creation of bespoke website designs with <abbr title="World Wide Web Consortium">W3C</abbr> standards compliant <abbr title="HyperText Markup Language">HTML</abbr>/<abbr title="Cascading Style Sheets">CSS</abbr> coding. If you need a dynamic website I can also plug your site into a database and take care of all the boring coding that makes it work.</p>
                
                <p>When I'm not at my desk I can usually be found watching a film, listening to music, struggling in the gym or spending time with my beautiful daughter.</p>
                
                <p id="cv"><a href="../GarethDaviesCV.pdf">Download my <abbr title="Curriculum Vitae">CV</abbr></a> <span class="normal">(<a href="http://get.adobe.com/reader/" title="You will need Adobe Reader to view my CV">PDF</a>, 68KB)</span></p>
                
                <h3>Current Availability</h3>
                
                <p>I am currently working for Birmingham City University as a Front-End Web Developer. However, I am always interested in hearing from people who need help creating an online presence or are looking to employ someone like me. Feel free to email me at <a href="mailto:info@garethdavies.me">info@garethdavies.me</a>.</p>

            </div>
            
            <aside class="about-column-right">
            	
                <h3 id="hidden-about-title" class="hidden">Weapons of Choice</h3>
                
            	<div class="column-left">
                	
                    <section>
                    
                        <h5>Applications</h5>
                        
                        <ul class="tick">
                            <li>Visual Studio</li>
                            <li>Dreamweaver</li>
                            <li>Fireworks</li>
                            <li>Photoshop</li>
                            <li><abbr title="Microsoft Sequel Server">MSSQL</abbr> Server</li>
                            <li>Illustrator</li>
                        </ul>
                    
                    </section>

                </div>
            
            	<div class="column-right">
                	
                    <section>
                    
                		<h5>Scripting</h5>
                    
                        <ul class="tick">
                            <li><abbr title="HyperText Markup Language">HTML</abbr></li>
                            <li><abbr title="Cascading Style Sheets">CSS</abbr></li>
                            <li>Javascript</li>
                            <li>JQuery</li>
                            <li>ASP.NET C#</li>
                            <li><abbr title="Structured Query Language">SQL</abbr></li>
                        </ul>
                    
                    </section>
                
                </div>
            
            </aside>
            
            <div class="clear"></div>

		<?php echo $response_footer; ?>
		
<?php echo $response_end; ?> 