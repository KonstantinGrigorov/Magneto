<?php

/* 
 * @var Magicstore_Lesson_Block_View $this
 */
// die('www1');
$arrData = $this->getRequestedRecord()->getData();
//var_dump($arrData); ?>
<?php
if (isset($arrData) AND is_array($arrData)) {
    foreach ($arrData as $one) {
        echo "<ul> comment №". $one['request_id']."   
                <li> user: ".$one['name']." </li>
                <li> say: ".$one['contact']."</li>
              </ul></br>";
    }
}
?>
<!--<ul>
      
    <li><?= $this->getRequestedRecord()->getName() ?>/li>
    <li><?= $this->getRequestedRecord()->getContact() ?></li>
    
</ul>-->