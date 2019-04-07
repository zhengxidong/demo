<?php
  
   session_start();

   if(isset($_POST['veri']) && $_POST['veri'] == $_SESSION['verification']){ echo '1'; }else{ echo '2'; }

?>