<?php require_once("../layout/header.php")?>
<?php require_once("../auth/isLogin.php")?>
<!-- <form action="" method="POST">
    <button class="btn btn-info" name="logout">Logout</button>
</form> -->

<div class="container-fluid d-flex row mx-auto bg-light waiter">
    <div class="invoice col-md-5 bg-white my-2" style="height: 97vh;">
        <div class="d-flex mt-3 ms-5">
            <div class="align-content-center">
            <img src="../assets/image/profile.png" alt="waiter" style="width: 100px; height: 100px; border-radius: 70px;">
            </div>
            <div class="align-content-center mt-3 ms-4">
                <h3>Waiter Name</h3>
                <p>waiter@gmail.com</p>
            </div>
        </div>
        <div style="height: 420px; overflow:auto; overflow-x: hidden;" id="table-container">
            <table class="table table-striped mt-3  me-2" >
               <thead>
                   <tr>
                       <th>No.</th>
                       <th>Item</th>
                       <th>Price</th>
                       <th>Qty</th>
                       <th></th>
                       <th>Total</th>
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
                
                <tr>
                    <td>1</td>
                    <td>Hot Pot</td>
                    <td>12000</td>
                    <td>2</td>
                    <td style="width: 130px;"><button class="btn btn-sm btn-success"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                    <td>24000</td>
                </tr>
               </tbody>
            </table>
        </div>
        <div class=" bg-light">
            <div class="d-flex justify-content-between mx-2 border-top" >
                <h5  style="height:40px; line-height: 40px;">Total</h5>
                <h5  style="height:40px; line-height: 40px;">1980 MMK</h5>
            </div>
        </div>
    </div>
    <div class="menu col-md-7" style="height: 97vh;">
        <form action="" method="POST">
            <button class="btn btn-info" name="logout">Logout</button>
        </form>
    </div>
</div>

<?php require_once("../layout/footer.php")?>
