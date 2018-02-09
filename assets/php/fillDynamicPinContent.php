 <?php
	require_once("dbapi.php");
	require_once("cleanXML.php");
	
	$result = getPinData();
	$fieldArray = array();
	$name = $_GET["name"];
	
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
			if ($name === ($fieldArray[$i])) {
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
					
					
					$body->appendChild($template);
					}
				}
	$trim_off_front = strpos($dom->saveHTML(),'<body>') + 6;
	$trim_off_end = (strrpos($dom->saveHTML(),'</body>')) - strlen($dom->saveHTML());

	echo substr($dom->saveHTML(), $trim_off_front, $trim_off_end);
	
	?>