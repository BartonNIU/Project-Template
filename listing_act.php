<?php include "includes/header.php"; ?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
            <!-- wrapper -->
            <div id="wrapper">
                <div class="content">
                    <!-- Map -->
                    <div class="map-container column-map right-pos-map">
                        <div id="map-main"></div>
                        <ul class="mapnavigation">
                            <li><a href="#" class="prevmap-nav">Prev</a></li>
                            <li><a href="#" class="nextmap-nav">Next</a></li>
                        </ul>
                    </div>
                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="col-list-wrap left-list">
                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            <div class="container">
                                <div class="listsearch-header fl-wrap">

                                    <?php
                                    if($_POST['value'] != "") {
                                        echo '<h3>Results For : <span>'.$_POST['value'].'</span></h3>';
                                    }
                                    elseif ($_POST['value'] == ""){
                                        echo '<h3>Results For: All Budget Ranges</span></h3>';
                                    }
                                    ?>


                                    <div class="listing-view-layout">
                                        <ul>
                                            <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                                            <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <form action="listing_act.php" method="post">
                                <!-- listsearch-input-wrap  -->
                                <div class="listsearch-input-wrap fl-wrap">
                                    <div class="listsearch-input-item">
                                        <i class="mbri-key single-i"></i>
                                        <input type="text" name="postcode" placeholder="Postcode?" value=""/>
                                    </div>
<!--                                    <div class="listsearch-input-item">-->
<!--                                        <select data-placeholder="Location" class="chosen-select" >-->
<!--                                            <option>All Locations</option>-->
<!--                                            <option>Bronx</option>-->
<!--                                            <option>Brooklyn</option>-->
<!--                                            <option>Manhattan</option>-->
<!--                                            <option>Queens</option>-->
<!--                                            <option>Staten Island</option>-->
<!--                                        </select>-->
<!--                                    </div>-->

                                    <div class="listsearch-input-item">
                                        <select name="value" data-placeholder="All Range Budgets" class="chosen-select" id="value">
                                            <option value="All Budget Ranges">All Budget Ranges</option>
                                            <option value="Free">Free</option>
                                            <option value="less than $20">less than $20</option>
                                            <option value="$20-$50">$20-$50</option>
                                            <option value="$50-$100">$50-$100</option>
                                            <option value="more than $100">more than $100</option>
                                        </select>
                                    </div>


                                    <!--<div class="listsearch-input-text" id="autocomplete-container">
                                        <label><i class="mbri-map-pin"></i> Enter Addres </label>
                                        <input type="text" placeholder="Destination , Area , Street" id="autocomplete-input" class="qodef-archive-places-search" value=""/>
                                        <a  href="#"  class="loc-act qodef-archive-current-location"><i class="fa fa-dot-circle-o"></i></a>
                                    </div>-->
                                    <!-- hidden-listing-filter -->
                                    <!--<div class="hidden-listing-filter fl-wrap">
                                        <div class="distance-input fl-wrap">
                                            <div class="distance-title"> Radius around selected destination <span></span> km</div>
                                            <div class="distance-radius-wrap fl-wrap">
                                                <input class="distance-radius rangeslider--horizontal" type="range" min="1" max="100" step="1" value="1" data-title="Radius around selected destination">
                                            </div>
                                        </div>-->
                                        <!-- Checkboxes -->
                                       <!-- <div class=" fl-wrap filter-tags">
                                            <h4>Filter by Tags</h4>
                                            <input id="check-aa" type="checkbox" name="check">
                                            <label for="check-aa">Elevator in building</label>
                                            <input id="check-b" type="checkbox" name="check">
                                            <label for="check-b">Friendly workspace</label>
                                            <input id="check-c" type="checkbox" name="check">
                                            <label for="check-c">Instant Book</label>
                                            <input id="check-d" type="checkbox" name="check">
                                            <label for="check-d">Wireless Internet</label>
                                        </div>
                                    </div>-->
                                    <!-- hidden-listing-filter end -->
                                    <br/><br/><br/><br/>

                                    <button type="submit" class="button fs-map-btn">Update</button>
<!--                                    <div class="more-filter-option">More Filters <span></span></div>-->
                                </div>
                                </form>
                                <!-- listsearch-input-wrap end -->
                            </div>
                        </div>
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">
                            <a class="custom-scroll-link back-to-filters btf-l" href="#lisfw"><i class="fa fa-angle-double-up"></i><span>Back to Filters</span></a>
                            <div class="container">

                                <?php
                                $postcode=$_POST['postcode'];
                                $suburb=$_POST['suburb'];



                                // Random Image function
                                function random_image($directory)
                                {
                                    $leading = substr($directory, 0, 1);
                                    $trailing = substr($directory, -1, 1);

                                    if($leading == '/')
                                    {
                                        $directory = substr($directory, 1);
                                    }
                                    if($trailing != '/')
                                    {
                                        $directory = $directory . '/';
                                    }

                                    if(empty($directory) or !is_dir($directory))
                                    {
                                        die('Directory: ' . $directory . ' not found.');
                                    }

                                    $files = scandir($directory, 1);

                                    $make_array = array();

                                    foreach($files AS $id => $file)
                                    {
                                        $info = pathinfo($directory . $file);

                                        $image_extensions = array('jpg', 'jpeg', 'gif', 'png', 'ico');
                                        if(!in_array($info['extension'], $image_extensions))
                                        {
                                            unset($file);
                                        }
                                        else
                                        {
                                            $file = str_replace(' ', '%20', $file);
                                            $temp = array($id => $file);
                                            array_push($make_array, $temp);
                                        }
                                    }

                                    if(sizeof($make_array) == 0)
                                    {
                                        die('No images in ' . $directory . ' Directory');
                                    }

                                    $total = count($make_array) - 1;

                                    $random_image = rand(0, $total);
                                    return $directory . $make_array[$random_image][$random_image];

                                }

                                $postcode=$_POST['postcode'];
                                $suburb=$_POST['suburb'];

                                //                       $postcode= $mysqli->real_escape_string($postcode);

                                // $mysqli = new mysqli("localhost","root","","csv_db");
                                $mysqli = new mysqli("localhost","nrh","666","fit5120");


                                /* check connection */
                                if (mysqli_connect_errno()){
                                    printf("Connect failed: %s\n", mysqli_connect_error());
                                    exit();
                                }

                                if($postcode == "" && $suburb == "") {
                                    if (($_POST['value']) == 'Free') {
                                        $query = $mysqli->query("Select * from activity WHERE fee='Free'");
                                    } elseif (($_POST['value']) == 'less than $20') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix <= 20");
                                    } elseif (($_POST['value']) == '$20-$50') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 20 AND fee_fix <= 50");
                                    } elseif (($_POST['value']) == '$50-$100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 50 AND fee_fix <= 100");
                                    } elseif (($_POST['value']) == 'more than $100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 100");
                                    }
                                    else {
                                        $query = $mysqli->query("Select * from activity");
                                    }
                                }

                                elseif($postcode != "" && $suburb == ""){
                                    if (($_POST['value']) == 'Free') {
                                        $query = $mysqli->query("Select * from activity WHERE fee='Free' AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == 'less than $20') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix <= 20 AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == '$20-$50') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 20 AND fee_fix <= 50 AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == '$50-$100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 50 AND fee_fix <= 100 AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == 'more than $100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 100 AND post_code='$postcode'");
                                    }
                                    else {
                                        $query = $mysqli->query("Select * from activity WHERE post_code='$postcode'");
                                    }
                                }

                                elseif($postcode == "" && $suburb != ""){
                                    if (($_POST['value']) == 'Free') {
                                        $query = $mysqli->query("Select * from activity WHERE fee='Free' AND suburb='$suburb'");
                                    } elseif (($_POST['value']) == 'less than $20') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix <= 20 AND suburb='$suburb'");
                                    } elseif (($_POST['value']) == '$20-$50') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 20 AND fee_fix <= 50 AND suburb='$suburb'");
                                    } elseif (($_POST['value']) == '$50-$100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 50 AND fee_fix <= 100 AND suburb='$suburb'");
                                    } elseif (($_POST['value']) == 'more than $100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 100 AND suburb='$suburb'");
                                    }
                                    else {
                                        $query = $mysqli->query("Select * from activity WHERE suburb='$suburb'");
                                    }
                                }

                                elseif($postcode != "" && $suburb != ""){
                                    if (($_POST['value']) == 'Free') {
                                        $query = $mysqli->query("Select * from activity WHERE fee='Free' AND suburb='$suburb' AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == 'less than $20') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix <= 20 AND suburb='$suburb' AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == '$20-$50') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 20 AND fee_fix <= 50 AND suburb='$suburb' AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == '$50-$100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 50 AND fee_fix <= 100 AND suburb='$suburb' AND post_code='$postcode'");
                                    } elseif (($_POST['value']) == 'more than $100') {
                                        $query = $mysqli->query("Select * from activity WHERE fee_fix > 100 AND suburb='$suburb' AND post_code='$postcode'");
                                    }
                                    else {
                                        $query = $mysqli->query("Select * from activity WHERE suburb='$suburb' AND post_code='$postcode'");
                                    }
                                }

                                else{
                                    $query = $mysqli->query("Select * from activity");
                                }

                                $row_cnt = $query ->num_rows;
                                if( $row_cnt == 0){
                                    echo '<p> We apologize, there is no data found for your selection </p>';
                                }

                                while($row = $query -> fetch_array())
                                {
                                    //<!-- listing-item -->
                                    echo  '<div class="listing-item">';
                                    echo    '<article class="geodir-category-listing fl-wrap">';
                                    echo      '<div class="geodir-category-img">';
                                    echo "<img src=" . random_image('picture/Activities') . " />";
                                    echo       '<div class="overlay"></div>';
//                                      echo      '<div class="list-post-counter"><span>1523</span><i class="fa fa-heart"></i></div>';
                                    echo  '</div>';
                                    echo '<div class="geodir-category-content fl-wrap">';
//                                        echo '<a class="listing-geodir-category" href="listing.html">'. $row['Category'] . '</a>';
                                    echo '<a class="listing-geodir-category">Activity</a>';
//                                         echo   '<div class="listing-avatar"><a href="author-single.html"><img src="images/avatar/1.jpg" alt=""></a>';
//                                          echo      '<span class="avatar-tooltip">Added By  <strong>Mark Rose</strong></span>';
//                                          echo  '</div>';
//                                    echo '<h3><a href="listing-single.html">'. $row['place_name']. '</a></h3>';
                                    echo '<h3>'. $row['activity_title']. '</h3>';
                                    echo '<p> Fee:'. $row['fee']. ' </p>';
                                    echo '<p> Postcode:'. $row['post_code']. ' </p>';
                                    echo  '<p>'. $row['description']. '</p>';
                                    echo  '<div class="geodir-category-options fl-wrap">';
//                                           echo     '<div class="listing-rating card-popup-rainingvis" data-starrating2="4">';
//                                            echo       ' <span>(17 reviews)</span>';
//                                            echo    '</div>';
                                    echo '<div class="geodir-category-location"><a  href="#'.$row['ID'] .'" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i>'. $row['address'].'</a></div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</article>';
                                    echo '</div>';
                                    // <!-- listing-item end-->
                                }



                                /* close connection */
                                $mysqli->close();
                                ?>

                                <!--Sessions for map filters -->
                                <?php

                                if (isset($_POST['postcode'] )){
                                    $_SESSION['postcode']=$_POST['postcode'];
                                }
                                else{
                                    $_SESSION['postcode'] = "";
                                }
                                if (isset($_POST['suburb']) ){
                                    //echo $_POST["category"];
                                    $_SESSION['suburb']=$_POST['suburb'];
                                }
                                else{
                                    $_SESSION['suburb'] = "";
                                }

                                if (isset($_POST['value']) ){
                                    $_SESSION['option_activity']=$_POST['value'];
                                }
                                else{
                                    $_SESSION['option_activity'] = "";}

                                if (isset($_POST['keyword_place']) ){
                                    $_SESSION['keyword_place']=$_POST['keyword_place'];
                                }
                                else{
                                    $_SESSION['keyword_place'] = "";

                                }
                                ?>






                                <!-- listing-item -->
                             <!--   <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>4</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Restourants</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Lisa Smith</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Luxury Restourant</a></h3>
                                            <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales, sed lobortis est placerat.</p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                                    <span>(7 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#0" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->


                                <!-- listing-item -->
                              <!--  <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>15</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Event</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Mark Rose</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Event In City Mol</a></h3>
                                            <p>Morbi suscipit erat in diam bibendum rutrum in nisl. Aliquam et purus ante.</p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4">
                                                    <span>(17 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#1" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->
<!--                                <div class="clearfix"></div>-->
                                <!-- listing-item -->
                               <!-- <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>553</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Restourants</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Adam Koncy</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Luxury Restourant</a></h3>
                                            <p>Sed non neque elit. Sed ut imperdie.</p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                                    <span>(7 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#2" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->
                                <!-- listing-item -->
                                <!--<div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>47</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Fitness</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Gym in the Center</a></h3>
                                            <p>Mauris in erat justo. Nullam ac urna eu. </p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                                    <span>(23 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#3" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->
<!--                                <div class="clearfix"></div>-->
                                <!-- listing-item -->
                               <!-- <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>3</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Shops</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Nasty Wood</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Shop in Boutique Zone</a></h3>
                                            <p>Morbiaccumsan ipsum velit tincidunt . </p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4">
                                                    <span>(6 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#4" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->
                                <!-- listing-item -->
                              <!--  <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <img src="../images/all/1.jpg" alt="">
                                            <div class="overlay"></div>
                                            <div class="list-post-counter"><span>35</span><i class="fa fa-heart"></i></div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <a class="listing-geodir-category" href="../listing.html">Hotels</a>
                                            <div class="listing-avatar"><a href="author-single.html"><img src="../images/avatar/1.jpg" alt=""></a>
                                                <span class="avatar-tooltip">Added By  <strong>Kliff Antony</strong></span>
                                            </div>
                                            <h3><a href="listing-single.html">Luxary Hotel</a></h3>
                                            <p>Lorem ipsum gravida nibh vel velit.</p>
                                            <div class="geodir-category-options fl-wrap">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5">
                                                    <span>(11 reviews)</span>
                                                </div>
                                                <div class="geodir-category-location"><a  href="#5" class="map-item"><i class="fa fa-map-marker" aria-hidden="true"></i> 27th Brooklyn New York, NY 10065</a></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                                <!-- listing-item end-->
                            </div>
<!--                            <a class="load-more-button" href="#">Load more <i class="fa fa-circle-o-notch"></i> </a>-->
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap -->
                    <div class="limit-box fl-wrap"></div>
                    <!--section -->
<!--                    <section class="gradient-bg">-->
<!--                        <div class="cirle-bg">-->
<!--                            <div class="bg" data-bg="images/bg/circle.png"></div>-->
<!--                        </div>-->
<!--                        <div class="container">-->
<!--                            <div class="join-wrap fl-wrap">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-8">-->
<!--                                        <h3>Join our online community</h3>-->
<!--                                        <p>Grow your marketing and be happy with your online business</p>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4"><a href="#" class="join-wrap-btn modal-open">Sign Up <i class="fa fa-sign-in"></i></a></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </section>-->
                    <!--section end -->
                </div>
                <!--content end -->
            </div>
                <?php
                // pass data to response_activity.php for map searching
                $_SESSION['postcode_activity'] = $_POST['postcode'];
                $_SESSION['suburb_activity'] = $_POST['suburb'];
                $_SESSION['budget_activity'] = $_POST['value'];
                ?>
            <!-- wrapper end -->
            <!--footer -->
            <?php include "includes/footer.php"; ?>
            <!--footer end  -->
            <!--register form -->
            <?php include "includes/registerform.php"; ?>
            <!--register form end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
<!--		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6uvEZqkQXhf_Ai-vj50Phw-zMEaw7zLo&libraries=places&callback=initAutocomplete"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6uvEZqkQXhf_Ai-vj50Phw-zMEaw7zLo"></script>
        <script type="text/javascript" src="js/map_infobox.js"></script>
        <script type="text/javascript" src="js/markerclusterer.js"></script>
        <script type="text/javascript" src="js/maps_activity.js"></script>
    </body>
</html>
