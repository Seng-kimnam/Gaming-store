<?php

$footer1 = [
    "Shop", "RazerStores", "RazerCafe", "Store Locator", "Purchase Programs",
    "Bulk Order Program", "Education", "Only at Razer", "RazerStore Rewards"
];
// 2nd field of footer store in array -->
$footer2 = array('Explore', "Technology", "Chroma RGB", "Concepts", "Esports", "Collabs");
// 3rd field of footer store in array -->
$footer3 = array("Support", "Get Help", "Registeration", "RazerStore Support", "RazerCare", "Manage Razer ID", 'Support Video', 'Recycling', 'Accessibility');
 // 4 th field of footer store in array -->
$footer4 = array('Company', 'About', 'Careers', 'Newsrooms', 'zVenture', 'Contact Us') ;
// 5 th field of footer store in array -->
$footer5 = array('Follow Us','fa-facebook','fa-instagram','fa-threads','fa-x-twitter','fa-youtube','fa-tiktok','fa-discord'); 

?>

<html>
<footer class="footer">
        <div class="container-list">
            <ul class="link">
                <?php foreach ($footer1 as $f1) :
                    echo '<li class="link-list"><a href="#">' . $f1 . '</a></li>';
                endforeach;
                ?>

            </ul>
        </div>
        <div class="container-list">
            <ul class="link">
                <?php foreach ($footer2 as $f2) :
                    echo '<li class="link-list"><a href="#">' .  $f2 . '</a></li>';
                endforeach;
                ?>
            </ul>
        </div>
        <div class="container-list">
            <ul class="link">
                <?php foreach ($footer3 as $f3) :
                    echo '<li class="link-list"><a href="#">' . $f3 . '</a></li>';
                endforeach; ?>
            </ul>
        </div>
        <div class="container-list">
            <ul class="link">
                <?php foreach ($footer4 as $f4) :
                    echo '<li class="link-list"><a href="#">' . $f4 . '</a></li>';
                endforeach; ?>
            </ul>
        </div>
        <div class="container-list">
            <ul class="link">
                <?php
                 foreach ($footer5 as $f5) 
                {
                    // the ternary operator can not use echo in both, either true or false ouput 
                   echo $f5 === 'Follow Us' ? 
                    '  <li class="link-list"><a href="#">'. $f5 . '</a></li>'
                     :  '<li class="link-list"><a href="#"><i class="fa-brands '. $f5. '"></i></a></li>' ;
                }
               
                ?>
            </ul>
        </div>
       
    </footer>
</html>