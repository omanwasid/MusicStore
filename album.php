<?php
    require_once __DIR__.'../../services/ServiceAlbum.php';
    
        if (!isset($_REQUEST['action'])) {
            return;            
        } else {
            header('Content-Type: application/json');
            $action = $_REQUEST['action'];
            switch ($action) {
              case 'getAllAlbums':             
                $page = 1;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }
                $service = new AlbumService;
                $limit = 20;
                $album=$service->GetAlbums($page);
                $total_pages=$service->GetTotatlAlbumCount($limit);
                $album['total']=$total_pages;
                $album['page']=$page;
                echo json_encode($album);
              break;
              case 'delete':
                $id = 1;
                $result=array('status'=>'1','message'=>'delete succefull');
                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                }

                $service = new AlbumService;                
                if($service->DeleteAlbum($id)){
                  $result['message']='success';
                }else{
                  $result['message']='failed';
                }
                
                echo json_encode($result);
              break;
              case 'create':
                $result=array('status'=>'1', 'message'=>'create successful');

                if (isDataValid()) {
                    $title = $_POST['title'];
                    $artistId = $_POST['artisId'];

                    $service = new AlbumService;
                    if ($service->InsertAlbum($title, $artisId)) {
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

                $service = new AlbumService;
                $title = $_POST['title'];
                $artistId = $_POST['artisId'];

                if($service->UpdataAlbum($title, $artistId, $id)) {
                  $album = $service->GetAlbumById($id);
                  $album['message'] = 'successful';
                  echo json_encode($album);
                } else {
                  $result['message'] = 'failed';
                }
              break;
              case 'getAlbumById':
                $id = 1;
                $result = array('status'=>'1', 'message'=>'successful');

                if(isset($_GET['id'])){
                  $id =$_GET['id'];
                }else{
                  $result['message']='id required';
                  echo json_encode($result);
                }

                $service = new AlbumService;
                $album = $service->GetAlbumById($id);
                echo json_encode($album);
              break;
            }
        }

        function isDataValid() 
        {
            if (isset($_POST['title']) && !empty($_POST['title'])) 
            {   
                return true;
            } else {
                return false;
            }
        }  
?>