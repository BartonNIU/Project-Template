<?php
$homeActive = "";
$actActive = "";
$expActive = "act-link";
$faqActive = "";
?>
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
                    <div class="listsearch-header fl-wrap" id="cat">
                        <!--Showing List Result Title-->
                        <?php
                        if($_GET['category'] != "") {
                            echo '<h3>EXPLORE PARKS and AMENITIES</h3>';

                            echo '<br><br><br>';
                            echo '<h3>List For : <span>'.$_GET['category'].'</span></h3>';


                        }
                        elseif ($_GET['category'] == ""){
                            echo '<h3>EXPLORE PARKS and AMENITIES</span></h3>';
                        }
                        ?>
                        <!--End of Showing List Result Title-->

                        <div class="listing-view-layout">
                            <ul>
                                <li><a class="grid active" href="#"><i class="fa fa-th-large"></i></a></li>
                                <li><a class="list" href="#"><i class="fa fa-list-ul"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <form  id= "pageinput" >
                    <!-- listsearch-input-wrap  -->
                    <!-- Insert Postcode  -->
                    <div class="listsearch-input-wrap fl-wrap">
                        <div class="listsearch-input-item">
                            <i class="mbri-key single-i"></i>
                            <input type="text" name="userinput_place" placeholder="Search by Postcode" value="" id="search_text" onchange="ajaxSearch_place()">
                        </div>

                        <!-- Select Category  -->
                        <div class="listsearch-input-item category">
                            <select multiple="multiple" name="category[]" data-placeholder="All Categories" class="chosen-select" id="value" onchange="ajaxSearch_place()">
<!--                                                                            <option value="*">All Categories</option>-->
                                <option value="Garden">Garden</option>
                                <option value="Farm">Farm</option>
                                <option value="Venue">Venue</option>
                                <option value="Park">Park</option>
                                <option value="Reserve">Reserve</option>
                                <option value="Sports Center">Sports Center</option>
                            </select>
                            <input type="hidden" name="hidden_category" id="hidden_category" />
                        </div>
                        <button type="button" class="button fs-map-btn" onclick="ajaxSearch_place()">Update</button>
                        <?php


                        $catCatch = $_GET['category'];
                        if($catCatch != "")
                        {
                            //$_POST['category'] = $catCatch;
                            $_SESSION["category"] = $catCatch;
                        }
                        else {
                            $catCatch = '';
                            $_SESSION["category"] ="";
                        }
                        //echo $catCatch;
                        ?>
                        <div class=" fl-wrap filter-tags">
                            <h4>Filter by Amenities</h4>
                            <ul>
                                <li>
                                    <input id="disabled_access" type="checkbox" name="check_disable" class="common_selector disabled_access" value="disabled_access" onchange="ajaxSearch_place()">
                                    <label for="disabled_access">Disabled Access </label>
                                    <input id="fencing" type="checkbox" name="check_fencing" class="common_selector fencing" value="fencing" onchange="ajaxSearch_place()">
                                    <label for="fencing">Fencing  </label>
                                    <input id="slides" type="checkbox" name="check_slide" class="common_selector slides" value="slides" onchange="ajaxSearch_place()">
                                    <label for="slides">Slides</label>
                                    <input id="toilet" type="checkbox" name="check_toilet" class="common_selector toilet" value="toilet" onchange="ajaxSearch_place()">
                                    <label for="toilet">Public Toilet</label>

                                </li>
                                <span></span><br><br><br>
                            </ul>
                        </div>

                        <!-- hidden-listing-filter -->
                        <div class="hidden-listing-filter fl-wrap">
                            <!-- Checkboxes Filter-->

                            <div class=" fl-wrap filter-tags">

                                <ul>
                                    <li>
                                        <input id="rockers" type="checkbox" name="check_rocker" class="common_selector rockers" value="rockers" onchange="ajaxSearch_place()">
                                        <label for="rockers">Rockers</label>
                                        <input id="climbers" type="checkbox" name="check_climber" class="common_selector climbers" value="climbers" onchange="ajaxSearch_place()">
                                        <label for="climbers">Climbers</label>
                                        <input id="see_saws" type="checkbox" name="check_saw" class="common_selector see_saws" value="see_saws" onchange="ajaxSearch_place()">
                                        <label for="see_saws">See Saws</label>
                                        <input id="swings" type="checkbox" name="check_swing" class="common_selector swings" value="swings" onchange="ajaxSearch_place()">
                                        <label for="swings">Swings</label>
                                        <input id="shade" type="checkbox" name="check_shade" class="common_selector shade" value="shade" onchange="ajaxSearch_place()">
                                        <label for="shade">Shade</label>
                                        <input id="bus_stops" type="checkbox" name="check_bus_stops" class="common_selector bus_stops" value="bus_stops" onchange="ajaxSearch_place()">
                                        <label for="bus_stops">Bus Access</label>
                                    </li>

                                    <br><br>

                                    <li>
                                    <input id="play_structure" type="checkbox" name="check_play" class="common_selector play_structure" value="play_structure" onchange="ajaxSearch_place()">
                                    <label for="play_structure">Play Structure &nbsp</label>
                                    <input id="liberty_swings" type="checkbox" name="check_liberty" class="common_selector liberty_swings" value="liberty_swings" onchange="ajaxSearch_place()">
                                    <label for="liberty_swings">Liberty Swings</label>
                                    <input id="chinup_bar" type="checkbox" name="check_chinup" class="common_selector chinup_bar" value="chinup_bar" onchange="ajaxSearch_place()">
                                    <label for="chinup_bar">Chinup Bars &nbsp</label>
                                    <input id="bells_chimes" type="checkbox" name="check_bell" class="common_selector bells_chimes" value="bells_chimes" onchange="ajaxSearch_place()">
                                    <label for="bells_chimes">Wind Chimes</label>
                                    <input id="trains_stops" type="checkbox" name="check_trains_stops" class="common_selector trains_stops" value="trains_stops" onchange="ajaxSearch_place()">
                                    <label for="trains_stops">Train Access</label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- hidden-listing-filter end -->
                        <br/><br/><br/><br/>

                        <div class="more-filter-option">More Filters <span></span></div>
                    </div>
                    </form>
                    <!-- listsearch-input-wrap end -->
                </div>
            </div>
            <!-- list-main-wrap-->
            <div class="list-main-wrap fl-wrap card-listing scroller">
                <!--                            <a class="custom-scroll-link back-to-filters btf-l" href="#lisfw"><i class="fa fa-angle-double-up"></i><span>Back to Filters</span></a> -->
                <div id="result" class="container">
                    <!--                                <div class="scroller">-->
                    <div class="row filter_data ">
                        <!--Result from database will be here-->
                        <!--                                </div>-->
                    </div>
                </div>
            </div>
            <!-- list-main-wrap end-->
        </div>
        <!--col-list-wrap -->
        <div class="limit-box fl-wrap"></div>
    </div>
    <!--content end -->
</div>
<!-- wrapper end -->
<?php
//if (issset($_GET['category'])){
//$_SESSION["mainpage_category"] = urldecode($_GET['category']);
//}
//?>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6uvEZqkQXhf_Ai-vj50Phw-zMEaw7zLo"></script>
<script type="text/javascript" src="js/map_infobox.js"></script>
<script type="text/javascript" src="js/markerclusterer.js"></script>
<script type="text/javascript" src="js/maps.js"></script>
<style>
    #loading
    {
        text-align:center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>
<script>
    $(document).ready(function()
    {
        filter_data();
        // function filter_data()
        function filter_data(query)
        {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch';
            var disabled_access = get_filter('disabled_access');
            var toilet = get_filter('toilet');
            var fencing = get_filter('fencing');
            var slides = get_filter('slides');
            var rockers = get_filter('rockers');
            var climbers = get_filter('climbers');
            var see_saws = get_filter('see_saws');
            var swings = get_filter('swings');
            var liberty_swings = get_filter('liberty_swings');
            var play_structure = get_filter('play_structure');
            var chinup_bar = get_filter('chinup_bar');
            var bells_chimes = get_filter('bells_chimes');
            var shade = get_filter('shade');
            var bus_stops = get_filter('bus_stops');
            var trains_stops = get_filter('trains_stops');

            var category = $('#value').val();


            var cat = [];
            var catchCat ='';

            catchCat  = <?php echo json_encode($catCatch, JSON_HEX_TAG); ?>;


            // if (!category)
            // {
            //     if (catchCat != '') {
            //         cat.push(catchCat);
            //         category = cat;
            //     }
            //
            // }
            //
            // else
            // if (category.length > 0){
            //     const catchCat = '';
            //     category = $('#value').val();
            // }

            $.ajax({
                url:"fetch.php",
                method:"POST",
                // data:{action:action, query:query, disabled_access:disabled_access, toilet:toilet, fencing:fencing,
                //     slides:slides, category:category, rockers:rockers,climbers:climbers, see_saws:see_saws,
                //     swings:swings,liberty_swings:liberty_swings,play_structure:play_structure,
                //     chinup_bar:chinup_bar, bells_chimes:bells_chimes, shade:shade, bus_stops:bus_stops, trains_stops:trains_stops},
                // data:$("#pageinput").serialize(),
                data:$("#pageinput").serialize(),category:category,
                success:function(data){
                    $('.filter_data').html(data);
                }
            });

        }

        function get_filter(class_name){
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });

        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                filter_data(search);
            }
            else
            {
                filter_data();
            }
        });

        //multi select drop down list
        $('#value').change(function(){
            $('#hidden_category').val($('#value').val());
            var category = [];
            category = $('#hidden_category').val();

            filter_data();
        });

        $('#pageinput').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    });

    // function listname_ajax(){
    //     $.post("",$(this).serialize(),function (data) {
    //         $('#cat').html('<h3>List For : <span>' + data + '</span>');
    //     })
    // }



</script>


</body>
</html>



