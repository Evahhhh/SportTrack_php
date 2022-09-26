<?php
include VIEWS_DIR."/header.html";
echo('<pre>');
var_dump($data);
echo('</pre>');
foreach ($data as $activity) {
    echo('<pre>');
    var_dump ($activity); 
    echo('</pre>');
}

include VIEWS_DIR."/footer.html";
?>