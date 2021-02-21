<?php
    require_once __DIR__.'../../services/ServiceTrack.php';
    
        if (!isset($_REQUEST['action'])) {
            return;            
        } else {        
         header('Content-Type: application/json');
            $action = $_REQUEST['action'];
            switch ($action) {
              case 'getAllTracks':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new TrackService;
                $limit = 20;
                $track=$service->GetTracks($page);
                $total_pages=$service->GetTotalTracksCount($limit);
                $track['total']=$total_pages;
                $track['page']=$page;
                echo json_encode($track);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new TrackService;                
                if($service->DeleteTrack($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':
                $result=array('status'=>'1', 'message'=>'create successful');

                if (isDataValid()) {
                  $name = $_POST['name'];
                  $albumId = $_POST['albumId'];
                  $mediaTypeId = $_POST['mediaTypeId'];
                  $genreId = $_POST['genreId'];
                  $composer = $_POST['composer'];
                  $milliseconds = $_POST['milliseconds'];
                  $bytes = $_POST['bytes'];
                  $unitPrice = $_POST['unitPrice'];

                  $service = new TrackService;
                  if ($service->InsertTrack($name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice)) 
                  {
                    $result['message'] = 'success';
                  } else {
                    $result['message'] = 'failed';
                  }
                } else {
                  $result['message'] = 'field required';
                }

                echo json_encode($result);
              break;
              case 'edit':
                $id = 1;
                $result = array('status'=>'1', 'message'=>'edit successful');
                if(isset($_POST['id'])) {
                  $id = $_POST['id'];
                } else {
                  $result['message'] = 'id required';
                  echo json_encode($result);
                }

                $service = new TrackService;
                $name = $_POST['name'];
                $albumId = $_POST['albumId'];
                $mediaTypeId = $_POST['mediaTypeId'];
                $genreId = $_POST['genreId'];
                $composer = $_POST['composer'];
                $milliseconds = $_POST['milliseconds'];
                $bytes = $_POST['bytes'];
                $unitPrice = $_POST['unitPrice'];

                if ($service->UpdateTrack($name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice, $id)) 
                {
                  $track = $service->GetTrackById($id);
                  $track['message'] = 'successful';
                  echo json_encode($track);
                } else {
                  $result['message'] = 'failed';
                }
              break;
              case 'getTrackById':
                $id = 1;
                $result = array('status'=>'1', 'message'=>'successful');

                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new TrackService;
                $track = $service->GetTrackById($id);
                echo json_encode($track);
              break;
            }
        }
        
        function isDataValid()
        {
          if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['mediaTypeId']) && 
          !empty($_POST['mediaTypeId']) && isset($_POST['milliseconds']) && !empty($_POST['milliseconds']) && 
          isset($_POST['unitPrice']) && !empty($_POST['unitPrice'])) 
          {
            return true;
          } else {
            return false;
          }
        }
?>