<?php
    require_once __DIR__.'../../services/ServiceMediaType.php';

    $service = new MediaTypeService;
    $mediaType = $service->GetMediaType();
?>

<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Media Types</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>MediaType ID</th>
                    <th>Name</th>                    
                </tr>
                <?php foreach($mediaType as $type): ?>
                <tr>
                    <td><?= $type->MediaTypeId; ?></td>
                    <td><?= $type->Name; ?></td>                    
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    