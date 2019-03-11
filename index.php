<?php 
     require('includes/getapi.php' );
     require('includes/header.php' );
?>

    <div class="container">
        <div class="row ea">
            <h1>Energy Australia</h1>
        </div>
        <div class="row carshow">
            <h2>Cars in the show!</h2>
        </div>
        <div class="row shows">
          <div class="panel-group" id="accordion">
            <?php
                $energyAustraliaAPI = "http://eacodingtest.digital.energyaustralia.com.au/api/v1/cars";
                $carShows = getAllCarShows($energyAustraliaAPI);
                $allCars = listAllCars($carShows);
                $sortedList = sortCarsByMake($allCars);
                $sortedListArr = json_decode($sortedList, true);

                if(trim($carShows) !== '""' && $carShows !=="Failed Downstream service" && trim($sortedList) !== ""){
                    foreach($sortedListArr as $key =>$item){
                        $panel = "";
                        $panel .= '<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse' .$key .'">'
                                . ( (trim($item['make']) !== "") ? $item['make'] : 'nil' ).'</a>
                                </h4>
                            </div>
                            <div id="collapse' .$key .'" class="panel-collapse collapse">
                                <div class="panel-body">';
                        $panel .= '<h5> Model: ' .( (trim($item['model'])  !=="" )? $item['model'] :  'nil' ).'</h5>';
                        $panel .= '<h5> Show Name: ' .( (trim($item['show']) !=="" )? $item['show'] : 'No Name defined!'  ).'</h5>';

                        $panel .= '</div></div></div>';
                        echo $panel;
                    }
                }else if(trim($carShows) ==='""' || trim($carShows) === null){
                    echo "<h4 class='warning'>There is no car Show at the moment!<h4>";
                }else{
                    echo "<h4 class='warning'>Something is wrong with the server!<br> Couldn't fetch any carshow, please refresh the page!<h4>";
                }
            ?>

          </div>


        </div>



    </div>

<?php require('includes/footer.php'); ?>

