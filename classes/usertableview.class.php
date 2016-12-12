<?php

  class usertableview {

     public function getHTML($errors='') {
       if(isset($errors)){
         $errorhtml = '
                      <div id="errors" class="errors">
                        <p>'.$errors.'</p>
                      </div>
         ';
       } else {
         $errorhtml = '';
       }
       try {
         //Get database
         $db = dbConn::getConnection();
 			   $stmt = $db->query('SELECT memberID, username, email FROM members ORDER BY memberID');
 		  	 $array = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         $headers = array(
             '0' => 'MemberID',
             '1' => 'Username',
             '2' => 'Email'
         );
         array_unshift($array, $headers);

 		   } catch(PDOException $e) {
 		     echo '<p>'.$e->getMessage().'</p>';
 		   }
       $table = new table();
       $table_h = $table->getHTML($array);
       $table_html = '
           <h1>User table</h1>
           '.$errorhtml.'
           '.$table_h.'

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
           <script src="js/plugins.js"></script>
           <script src="js/main.js"></script>
       ';

       return $table_html;
    }

}
