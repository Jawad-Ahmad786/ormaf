<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../org_chart/css/bootstrap.css">
    <link rel="stylesheet" href="css/chart.css">
    <!-- jQuery includes -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script src="js/jquery_002.js"></script>

    <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : false
        });
    });
    </script>
  </head>

  <body>
  

    <ul id="org" style="display:none">
   <li class="">
       Department
       <ul>
         <li id="beer">Beer</li>
         
         
         <li class="">Vegetables
          	<ul>
             <li>Pumpkin</li>
             <li>A link and paragraph is all we need.</li>
           </ul>
         </li>
         
         
         <li class="fruit">Fruit
           <ul>
             <li class="">Apple
               <ul>
                 <li>Granny Smith</li>
               </ul>
             </li>
             <li class="">Berries
               <ul>
                 <li>Blueberry</li>
                 <li><img src="images/raspberry.jpg" alt="Raspberry"></li>
                 <li>Cucumber</li>
               </ul>
             </li>
           </ul>
         </li>
         
         
         <li>Bread</li>
         
         
         <li class="">Chocolate
           <ul>
             <li>Topdeck</li>
             <li>Reese's Cups</li>
           </ul>
         </li>
       </ul>
     </li>
   </ul>            
    <div id="chart" class="orgChart">
    </div>
  
    
    


</body></html>