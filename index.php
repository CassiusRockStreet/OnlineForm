<?php require_once('./views/includes/header.php');
    $GetData = new pullRecords();
    $PoolFeedsColumns = $GetData->AllColumns();
    $FeedsValues = $GetData->getAllFrields();
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <center><h2>All captured fields</h2></center>
            </div>
        </div>
        <div class="row">   
            <div class="col-md-12">
                <center><p>Click the button to add new data <a href="form.php" class="btn btn-custom">Add submission</a></p></center>
                <table class="table table-condensed table-striped table-bordered">
                <tbody>
                <?php 
                if(!sizeOf($FeedsValues) > 0){
                    $NoData = "<tr><td colspan=".sizeOf($PoolFeedsColumns)." style='color:red'>Do data found...</td></tr>";
                }
                echo "<tr>";
                    foreach($PoolFeedsColumns as $column){
                        echo "
                            <th>$column</th>
                        ";
                    }
                    echo "</tr>";
                    $i = 0;
                    while($i < sizeOf($FeedsValues)){
                        $counts = 0;
                        echo "<tr>";
                        while($counts < sizeOf($PoolFeedsColumns)){
                            if($PoolFeedsColumns[$counts] == "phone"){
                                echo "<td>+27".substr($FeedsValues[$i][$PoolFeedsColumns[$counts]],1)."</td>";
                            }else{
                                echo "<td>".$FeedsValues[$i][$PoolFeedsColumns[$counts]]."</td>";
                            }
                            $counts++;
                        }
                        $i++;
                        echo "</tr>";
                    }
                    echo $NoData;
                ?>
                </table>
            </div>  
        </div>
    </div>
<?php require_once('./views/includes/footer.php');?>