<?php require_once("../layout/header.php") ?>
<?php require_once("../auth/isLogin.php") ?> 
<?php 
if(isset($_GET['deleteId'])){
    $deleteId = $_GET['deleteId'];
    delete_user($mysqli,$deleteId);
    };
    
$row = get_users($mysqli);
$row_count = COUNT($row->fetch_all()); //get number of users

$pagination_link = ceil($row_count/3);

    $limit = 3;
    $page = isset($_GET['pageNo'])? intval($_GET['pageNo']) : 1;
    $offset = ($page - 1) * $limit;
    $numberTitle = ($page*$limit)-$limit;
    // var_dump($page);
    // var_dump($pagination_link);
    // var_dump($row_count)
    
 ?>
<!-- //to get userid from cookie name -->
<div class="main">
    <?php require_once("../layout/sidebar.php") ?>
    <div class="content w-100">
        <?php require_once("../layout/navbar.php") ?>
        <div class="card w-90 mt-2 mx-1">
            <div class="card-title fs-3 text-center">User List</div>
            <div class="card-body">
                <table class="table table-striped  w-100 mx-auto">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $users = get_user_with_offset($mysqli,$offset,$limit);
                if(isset($_POST['search_data'])){
                    if($_POST['search_data'] != ""){
                        $searchData = $_POST['search_data'];
                        // echo $searchData;
                     $users =   get_data_with_search_data($mysqli,$searchData);
                   
                    }
                }
                while($user_list =$users->fetch_assoc()){
                    // var_dump($user_list);
                ?>
                    <tr>
                        <td><?= $numberTitle + 1 ?></td>
                        <td><?= $user_list['username']?></td>
                        <td><?= $user_list['useremail']?></td>
                        <td><?php
                        switch ($user_list['role']) {
                            case "1":
                                echo "admin";
                                break;
                            case "2":
                                echo "cashier";
                                break;
                            case "3":
                                echo "kitchen";
                                break;
                            case "4":
                                echo "waiter";
                                break;
                            default:
                                break;
                        }?>
                    </td>
                     <td>
                    <?php if ($user_list['id'] === $user['id']) { ?>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                    <?php } else { ?>
                      <button class="btn btn-sm btn-danger deleteUser" data-value="<?= $user_list['id']; ?>" data-bs-toggle = "modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                    <?php } ?>
                  </td>
                    </tr>
                 <?php $numberTitle++; } ?>
                </tbody>
                </table>
                <?php if(!($row_count<=$limit)){?>
                    <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($page <= 1) echo 'disabled' ?>" >
                            <a class="page-link" href="?pageNo=<?= $page-1; ?>">Previous</a>
                        </li>
                        <?php $j=1;
                        while($pagination_link >= $j){?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $j) echo 'active' ?>" href="?pageNo=<?= $j ?>"><?php echo $j;?></a>
                        </li>
                        <?php $j++; } ?>
                        <li class="page-item <?php if($pagination_link == $page) echo 'disabled' ?>">
                            <a class="page-link"" href="?pageNo=<?= $page+1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- modal box to delete user -->
<div class="modal modal-sm" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation Message</h5>
        <button type="button" class="btn-close btn-sm" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete..</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" id="deleteBtn">OK</button>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>
<?php require_once("../layout/footer.php") ?>