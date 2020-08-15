<?php 
    if ( isset( $_POST["Name"] ) && isset( $_POST["Email"] ) ){

        $Name = $_POST["Name"];
        $Email = $_POST["Email"];
        if( !empty($Name) && !empty($Email) ){
            $Profile = $_POST["Profile"];
            $Work = $_POST["Work"];
            $Study = $_POST["Study"];
            $Tourism = $_POST["Tourism"];
            $University = $_POST["University"];
            $Personal = $_POST["Personal"];
            $Reasons = $Work.''.$Study.''.$Tourism.''.$University.''.$Personal;
            $TopLearningPriority = $_POST["TopLearningPriority"];
            $SecondLearningPriority = $_POST["SecondLearningPriority"];
            $ThirdLearningPriority = $_POST["ThirdLearningPriority"];
            $FourthLearningPriority = $_POST["FourthLearningPriority"];
            $Message = $_POST["Message"];
            $TO = 'markfuentes2991@gmail.com';
            $mailTitle = "Cirkuits Contact";
            $msg = '
                            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Contact</title>
                    <style>
                        .header{
                            background-color:#343A40;;
                        }
                        .img-container{
                            position: relative;
                            width: 30%;
                            margin: auto;            
                            text-align: center;
                        }
                        .table{
                            position: relative;
                            width: 100%;
                            text-align: center;
                        }
                        table{
                            width: 100%;
                            border: 2px solid black;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <div class="img-container">
                            <img src="../img/bw_logo.png" alt="">
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Profile</th>
                                <th>Reason to apply</th>
                                <th>Top Learning priority</th>
                                <th>Second Learning priority</th>
                                <th>Third Learning priority</th>
                                <th>Fourth Learning priority</th>
                                <th>Message</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$Name.'</td>
                                    <td>'.$Email.'</td>
                                    <td>'.$Profile.'</td>
                                    <td>'.$Reasons.'</td>
                                    <td>'.$TopLearningPriority.'</td>
                                    <td>'.$SecondLearningPriority.'</td>
                                    <td>'.$ThirdLearningPriority.'</td>
                                    <td>'.$FourthLearningPriority.'</td>
                                    <td>'.$Message.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
                </html>';
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $result = true;
            //$result = mail($TO, $mailTitle, $msg, $cabeceras);
            if($result){
                $resObject = array("status"=>1);
            }else{
                $resObject = array("status"=>1);
            }
        }else{
            $resObject = array("status"=>0);
        }        
        $resJSON = json_encode($resObject);
        echo $resJSON;
    }

?>