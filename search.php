<?php
   $con = mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
     
    mysqli_select_db($con, "csv_db") or die(mysqli_error($con));
    
    
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">


                <div class="btn-group">
                 <a href="index.html">        <button class="buttonactive">Home</button></a>
                  <a href="library.html">        <button class="button">Library</button></a>
                  <a href="about.html">        <button class="button">About Us</button></a>
                   </div>
                   
                   <div class="image" style="float:right ">
                   <img src="images/logo 2.png" alt="LOGO" width="250" height="80"/>
                   
         </div>        
</div>

<?php


    $query = $_GET['query']; 
    // gets value sent over search form
     
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($con,"SELECT * FROM `table 2` WHERE (`COL 3` LIKE '%".$query."%')") or die(mysqli_error($con));
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>Career: ".$results['COL 3']."</h3>Major: ".$results['COL 5']."</p>";
                echo "<p> Education: ".$results['COL 6']."<br>Category: ".$results['COL 2']."</p>";

                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         

?>
</body>
</html>