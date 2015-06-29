<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Nature One
 */
?>
<style> 
    
   .foot{

        font-weight: bold;
        text-align: center;
    }

    .icon-cont {

      position:relative; 
      z-index: 1500 !important; 
      background: url(iconbg.png) repeat; 
      height:6%;
      max-height: 10%;
    }

   .icon-cont .divimg
    {
        width: auto  !important; 
        height: 90% !important;
        padding-left: 30px; 
        padding-top:3px; 
    }

  

</style>
 
  <div id="footer">
        <div class="footer-top">
                    <div class="social_icons" style=" position:relative !important; z-index:1000 !important; margin-top: -20px !important; ">
                       
                        <div class="icon-cont" >
                            
                          <a href="#">  <img class="divimg" src="fbblack.png" onmouseover=src="fbblue.png" onmouseout=src="fbblack.png"  > </a>

                          <a href="#"> <img  class="divimg" src="gogplusblack.png" onmouseover=src="gogplusred.png" onmouseout=src="gogplusblack.png" ></a>

                           <a href="#"> <img class="divimg" src="instablack.png" onmouseover=src="instapurple.png" onmouseout=src="instablack.png" ></a>


                           <a href="#"> <img class="divimg" src="twitblack.png" onmouseover=src="twitblue.png" onmouseout=src="twitblack.png"></a>

                            <a href="#"> <img class="divimg" src="pinblack.png" onmouseover=src="pinred.png" onmouseout=src="pinblack.png" ></a>
                            
                          <a href="#"> <img class="divimg" src="pencilblack.png" onmouseover=src="pencilblue.png" onmouseout=src="pencilblack.png" style="float:right !important;  padding-top:3px; padding-right:100px !important;" ></a>

                            <div style="float:right; padding-top:10px; padding-right:20px; padding-top: 20px;">
                                 
                                  <img src="rs.png" >
                            
                            </div>
                         </div>
            
                        </div>
                     </div>
                    <div class="middle-align">
                        <div class="footer-column">
                            <div class="foot" style="display:block;"> Our Story </div>
                                <div  class="foot"> About Us </div>
                                    <div  class="foot"> Comments and Suggestion </div>
                                </div><!-- footer-column -->
                            <div class="footer-column" style="margin-right:0;">
                            <div class="foot"> Contact Us </div>
                                <div class="foot"> Shipping and Returns </div>
                            <div class="foot"> FAQs </div>
                        </div><!-- footer-column --><div class="clear"></div>
                    </div><!-- middle-align -->
                </div><!-- footer-top -->
       
</div><!-- footer -->
        </div><!-- main-container -->
  
<?php wp_footer(); ?>

</body>
</html>