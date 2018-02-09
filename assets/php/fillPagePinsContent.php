 <?php
	require_once("dbapi.php");
	require_once("cleanXML.php");
	
	$result = getPinData();
	$fieldArray = array();
	
	$dom = new DOMDocument;
	$dom->loadXml('<html><body/></html>');
	$body = $dom->documentElement->firstChild;
	
	$supported_image = array(
		'gif',
		'jpg',
		'jpeg',
		'png'
	);
	
	
		while ($tableRow = $result->fetch_assoc()) {
		array_push($fieldArray, $tableRow['name']);
		array_push($fieldArray, $tableRow['content']);
		array_push($fieldArray, $tableRow['image']);
		}
		
		for($i = 0; $i<count($fieldArray); $i+=3) {
				$cursor = $i+1;
				$cursor2 = $i+2;
				$clean1 = cleanXML($fieldArray[$i]);
				$clean2 = cleanXML($fieldArray[$cursor]);
				$clean3 = cleanXML($fieldArray[$cursor2]);
				$template = $dom->createDocumentFragment();
				
				
				$template->appendXML("<div class = 'name'><h1>{$clean1}</h1></div>");
				$template->appendXML("<br />");
				$template->appendXML("<div class = 'content'><p>{$clean2}</p></div>");
				$template->appendXML("<br />");
				$template->appendXML("<div class = 'tomb_image'><img src='{$clean3}'/></div>");
				$template->appendXML("<br />");
				/*$template->appendXML("<br />");
					echo 'Large title';
				} else if ($clean1 === 'content'){
				   $template->appendXML("<div class = '{$clean1}'><p>{$clean2}</p></div>");
				   $template->appendXML("<br />");
					echo 'Med title';
				} else if ($clean1 === 'Small_Title'){
				   $template->appendXML("<div class = '{$clean1}'>{$clean1}'><h3>{$clean2}</h3></div>");
				   $template->appendXML("<br />");
					echo 'Small title';
				} else if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $clean2)) {
				   $template->appendXML("<div class = '{$clean1}'><img src='{$clean2}'/></div>");
				   $template->appendXML("<br />");
					echo 'It was an image';
				} else if (filter_var($clean2, FILTER_VALIDATE_URL)){
				   $template->appendXML("<div class = '{$clean1}'><a href='{$clean2}'>{$clean2}</a></div>");
				   $template->appendXML("<br />");
					echo 'It was a link';
				} else {
				   $template->appendXML("<div class = '{$clean1}'><p>{$clean2}</p></div>");
				   $template->appendXML("<br />");
					echo "Doesn't seem like anything to me";
				}*/
				
				
				$body->appendChild($template);
				}
   
	echo $dom->saveXml();
	
	?>