<?php

/*** include the header ***/
include '../includes/header.php';
?>

<div class="page-header">
  <h1 style="text-align:center">MOBILE TECH SOLUTIONS</h1>
</div>

<h1 style="text-align:center">Phones For Sale</h1>
<div id="rotating-item-wrapper">
	<img class="rotating-item" src="../images/1.jpg" alt="Phone for Sale" width="650" height="300"/>
 	<img class="rotating-item" src="../images/2.jpg" alt="Phone for Sale" width="650" height="300"/>
 	<img class="rotating-item" src="../images/3.jpg" alt="Phone for Sale" width="650" height="300"/>
	<img class="rotating-item" src="../images/4.jpg" alt="Phone for Sale" width="650" height="300"/>
	<img class="rotating-item" src="../images/5.jpg" alt="Phone for Sale" width="650" height="300"/>
	<img class="rotating-item" src="../images/6.jpg" alt="Phone for Sale" width="650" height="300"/>
</div>

<SCRIPT>
$(window).load(function() { //start after HTML, images have loaded	 
    var InfiniteRotator =
    {
        init: function()
        {
            //initial fade-in time (in milliseconds)
            var initialFadeIn = 1000;
            //interval between items (in milliseconds)
            var itemInterval = 5000; 
            //cross-fade time (in milliseconds)
            var fadeTime = 2500; 
            //count number of items
            var numberOfItems = $('.rotating-item').length; 
            //set current item
            var currentItem = 0; 
            //show first item
            $('.rotating-item').eq(currentItem).fadeIn(initialFadeIn);
            //loop through the items
            var infiniteLoop = setInterval(function(){
                $('.rotating-item').eq(currentItem).fadeOut(fadeTime); 
                if(currentItem == numberOfItems -1){
                    currentItem = 0;
                }else{
                    currentItem++;
                }
                $('.rotating-item').eq(currentItem).fadeIn(fadeTime); 
            }, itemInterval);
        }
    }; 
    InfiniteRotator.init(); 
});

</SCRIPT>
