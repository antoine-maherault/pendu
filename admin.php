<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN</title>
</head>
	<style>
		main {
			font-family: monospace;
			font-size: 2em;
		}
		#mainwrapper {
			display: flex;
			justify-content: center;
		}
		a {
			text-decoration: none;
			color: white;
		}
		a:hover {
			color: black;
		}
		header {
			font-family: monospace;
			font-size: 2em;
			padding: 5px ;
			background-color: darkslateblue;
		}
		table {
			margin-top: 30px;
			padding: 10px ;
			background-color: darkslateblue;
			color: white;
		}
		table td {
			padding: 10px;
		}
		table input {
			font-family: monospace;
			border: none;
			background-color: white;
			color: darkslateblue;
		}
		table input:hover {
			background-color: slateblue;
			color: white;
		}
		#addiv {
			margin-top: 30px;
			color: white;
			padding: 10px;
			background-color: darkslateblue;
		}
		#addiv input {
			font-family: monospace;
			font-size: 1em;
		}
		#subwrapper {
			display: flex;
			justify-content: center;
		}
	</style>
<body>
	<header>
			<a href="index.php">play</a>
	</header>
<main>
	<div id="mainwrapper">
<?php 

// display and delete words ________________

$testarr = explode(' ',file_get_contents('mots.txt')); // i explode it to foreach, not necessary though
echo '<table>';
foreach ($testarr as $k => $words) {
	echo '<tr><td>'.$words.'<br/></td>';
    echo '<td><form method ="post" action="">   
            <input type="submit" value="delete" name="'.$words.'" /> 
        </form></div></td></tr>';
    if( $k == 0){
    	$first= $words;
    } else {
    	if(isset($_POST[$words])){
			 $deleted = implode(' ',array_diff($testarr,array($words))); // I implode it into string to delete it
			 file_put_contents('mots.txt', $deleted);
			 header('Location:admin.php');
		}
    }
}
echo '</table>';


function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   ' ', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}


?>
		<span>
			&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; <!-- some space -->
		</span>
		<div id="addiv">
			<span> add a word here </span>
		    <form method ="post">
		        <input type="text" name="letter" pattern="[A-Za-z]*" /> <!-- first security to avoid anything that is not a letter -->
		    </form>  
		</div>
	</div> <!-- mainwrapper -->
	<div id="subwrapper">
<?php 

// ADD A word_______________________________

if(isset($_POST['letter']) and !empty($_POST['letter'])){
	if(!strpos($_POST['letter'], ' ')){
		if(ctype_alpha($_POST['letter'])){ 	// second security to avoid anything else that s not a letter 
			$text= implode(' ',$testarr);
			$addword=strtoupper(htmlspecialchars(cleanString($_POST['letter']))); // some more security and change accented letters with not accented relatives
				//check for same word
			if( !strpos(file_get_contents('mots.txt'), (' '.$addword)) and 
				!strpos(file_get_contents('mots.txt'), ($addword.' ')) and
				$first !== $addword ){
				//echo $first;
				//echo $addword;
				//echo '!'.$text.'!';
				$text .= ' '.$addword;
				file_put_contents('mots.txt', $text);
				header('Location:admin.php');
			} else {
				echo '<span>this word has already been taken</span>';
			}
		} else {
			echo '<span>invalid input</span>';
		}
	} else {
		echo '<span>invalid input</span>';
	}
}

?>	
	<div>
</main>
	<footer>
	</footer>
</body>
</html>