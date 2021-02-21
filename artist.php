<?php
    require_once __DIR__.'../../services/ServiceArtists.php';
    
        if (!isset($_REQUEST['action'])) {
            return;            
        } else {            
         header('Content-Type: application/json');
            $action = $_REQUEST['action'];
            switch ($action) {
              case 'getAllArtists':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new ArtistService;
                $limit = 20;
                $artist=$service->GetArtists($page);
                $total_pages=$service->GetTotalArtistsCount($limit);
                $artist['total']=$total_pages;
                $artist['page']=$page;
                echo json_encode($artist);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new ArtistService;                
                if($service->DeleteArtist($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':
                $result=array('status'=>'1','message'=>'create sufull');

                if (isDataValid()) {
                  $name = $_POST['name'];

                  $service = new ArtistService;
                  if ($service->InsertArtist($name)) {
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
                $result=array('status'=>'1','message'=>'edit succefull');
                if(isset($_POST['id'])){
                  $id =$_POST['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new ArtistService;
                $name = $_POST['name'];

                if ($service->UpdateArtist($name, $id)) 
                {
                  $artist = $service->GetArtistById($id);
                  $artist['message'] = 'successful';
                  echo json_encode($artist);
                } else {
                  $result['message'] = 'failed';
                }
              break;
              case 'getArtistById':
                $id = 1;
                $result=array('status'=>'1','message'=>' succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new ArtistService;                
                $artist = $service->GetArtistById($id);
                echo json_encode($artist);
              break;
            }
        }

        function isDataValid() 
        {
          if (isset($_POST['name']) && !empty($_POST['name'])) 
          {   
              return true;
          } else {
              return false;
          }
        } 
  
?>