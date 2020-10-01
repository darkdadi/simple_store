<?php
session_start();

//determine request method
$request = [];
if(count($_POST) == 0){
    if(count($_GET) != 0){
        $request = $_GET;
    }
} else {
    $request = $_POST;
}


//determine what action will be performed
$cmd = isset($request['cmd']) ? $request['cmd'] : '';

//response component
$response = ['command'=>$cmd, 'valid'=>false, 'message'=>'', 'data'=>[]];
if($cmd !== ''){
    //required files
    require 'config/config.db.php';
    require 'classes/class.dbQuery.php';

    //instantiations | initializations
    $db_connect = new dbQuery();
    $db_connect->connect($config);

    switch ($cmd) {
        case 'login':
              // do things
              $_SESSION['auth'] = true;
      
              // update the response
              $response['valid'] = true;
              $response['message'] = 'Successful login'; 
              $response['data'] = $request['data'];
          break;
        case 'logout':
              // do things
              session_unset();
              session_regenerate_id();
              session_destroy();
      
              // update the response
              $response['valid'] = true;
              $response['message'] = 'Successful logout'; 
              $response['data'] = $request['data'];
          break;    
        case 'sampleList':
            require_once 'classes/class.sample_module.php';
            $handler = new SampleModule($db_connect);
            try {
                $get_list = $handler->listSample();
                if($get_list['valid']){
                    // update the response
                    $response['valid'] = true;
                    $response['message'] = 'Successful logout'; 
                    $response['data'] = $get_list['data'];
                } else {
                    // update the response
                    $response['valid'] = true;
                    $response['message'] = 'No list obtained';
                }
            } catch (Exception $err) {
                // update the response
                $response['message'] = 'An error was encountered';
                $response['data'] = ['err'=>$err->getMessage()];
            }
        break;
        case 'sampleCreate':
            require_once 'classes/class.sample_module.php';
            $handler = new SampleModule($db_connect);
            try {
                if(isset($request['data']['itemName']) && strval($request['data']['itemName']) !== ''){ // validate
                    $create = $handler->createSample($request['data']['itemName']);
                    if($create){
                        // update the response
                        $response['valid'] = true;
                        $response['message'] = 'Successfully created new item.'; 
                    } else {
                        // update the response
                        $response['message'] = 'Failed to create new item';
                    }
                } else {
                    $response['message'] = 'Item name is required.';
                }

            } catch (Exception $err) {
                // update the response
                $response['message'] = 'An error was encountered';
                $response['data'] = ['err'=>$err->getMessage()];
            }
        break;
        case 'sampleUpdate':
            require_once 'classes/class.sample_module.php';
            $handler = new SampleModule($db_connect);
            try {
                if(isset($request['data']['rowID'])){
                    if(isset($request['data']['itemName']) && strval($request['data']['itemName']) !== ''){ // validate
                        $create = $handler->updateSample(intval($request['data']['rowID']), $request['data']['itemName']);
                        if($create){
                            // update the response
                            $response['valid'] = true;
                            $response['message'] = 'Successfully updated new item.'; 
                        } else {
                            // update the response
                            $response['message'] = 'Failed to update item';
                        }
                    } else {
                        $response['message'] = 'Item name is required.';
                    }
                } else {
                    $response['message'] = 'No rowID provided.';
                }


            } catch (Exception $err) {
                // update the response
                $response['message'] = 'An error was encountered';
                $response['data'] = ['err'=>$err->getMessage()];
            }
        break;
        default:
          $response['message'] = 'Unrecognized command.';
          break;
      }
} else {
    $response['message'] = 'Command is required.';
}


//return response in JSON form
print json_encode($response);