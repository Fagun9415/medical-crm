//print_r($_POST);exit;
            if (!empty($encounterMedicinesId)) {
                foreach ($encounterMedicinesId as $selected) {
                    $drugName = $_POST['drugName'][$selected];
                    $morning = $_POST['morning'][$selected];
                    $afternoon = $_POST['afternoon'][$selected];
                    $evening = $_POST['evening'][$selected];
                    $night = $_POST['night'][$selected];
                    $noOfDays = $_POST['noOfDays'][$selected];
                    $qty = $_POST['qty'][$selected];
                   
                    $var = $selected.','.$drugName.','.$morning.','.$afternoon.','.$evening.','.$night.','.$noOfDays.','.$qty ;
                print_r($var);
                exit;
                
                    // $medicinesDetail[] = array(
                    //     'encounterMedicinesId' => $encounterMedicinesI[$selected],
                    //     'drugName' => $drugName[$selected],
                    //     'morning' => $morning[$selected],
                    //     'afternoon' => $afternoon[$selected],
                    //     'evening' => $evening[$selected],
                    //     'night' => $night[$selected],
                    //     'comment' => $comment[$selected],
                    //     'noOfDays' => $noOfDays[$selected],
                    //     'qty' => $qty[$selected]
                    // );
                }
                

            }