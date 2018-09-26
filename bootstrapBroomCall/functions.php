<?php
/*
* 3 string param
* creates navigation bar links
* no return value
*
*/
function menuItem($pathAPP, $currentPage, $label){
     ?>

    <li <?php 
    if ($pathAPP . $currentPage == $_SERVER["PHP_SELF"]){
        echo " class=\"active\"";
      }
    ?>> <a href="<?php echo $pathAPP . $currentPage; ?>"><?php echo $label;  ?></i></a></li>
    <?php 
}


/**
 * 
 * 2 params
 * $_POST array and KEY value
 * checks if input is ok
 * no return value 
 */
function inputErrorHandling(array $post, $key){

    if($post[$key] == ""){
        return "Input is empty!"; 
    } else if(strlen($post[$key]) > 50){
        return 'You entered '.strlen($post[$key]).' character, maximum is 50.';
    }
      
}

function dateErrorHandling(array $post, $key){

    if(!empty($post[$key])){
        $dateTime = DateTime::createFromFormat('Y-m-d', $post[$key]);
       
        if(!$dateTime){
          return "Date format is not correct, please enter dd.MM.yyyy. (e.g. for today " . date("d.m.Y.") . ")";
        }else {
            return 0; 
        }

      }else {
        return "Service date is not entered."; 
      }   
}

/**
 * 
 * cURL function for random password
 * no param
 * return string
 */
function getPassword() {

    // Create a new cURL resource
    $curl = curl_init(); 

    if (!$curl) {
        die("Couldn't initialize a cURL handle"); 
    }

    // Set the file URL to fetch through cURL
    curl_setopt($curl, CURLOPT_URL, "https://www.random.org/passwords/?num=5&len=20&format=html&rnd=new");

    // Set a different user agent string (Googlebot)
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'); 

    // Follow redirects, if any
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 

    // Fail the cURL request if response code = 400 (like 404 errors) 
    curl_setopt($curl, CURLOPT_FAILONERROR, true); 

    // Return the actual result of the curl result instead of success code
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Wait for 10 seconds to connect, set 0 to wait indefinitely
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

    // Execute the cURL request for a maximum of 50 seconds
    curl_setopt($curl, CURLOPT_TIMEOUT, 50);

    // Do not check the SSL certificates
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 

    // Fetch the URL and save the content in $html variable
    $html = curl_exec($curl); 

    // close cURL resource to free up system resources
    curl_close($curl);

    $doc= new DOMDocument();
    $doc->loadHTML($html, LIBXML_NOWARNING | LIBXML_NOERROR);
    $xPath = new DOMXPath($doc);
    $nodes = $xPath->query('//*[@id="invisible"]/ul[2]/li[1]');
    $password; 
    foreach ($nodes as $node)
    {
        $password = $node->nodeValue;
    }

    return $password; 
}
?>