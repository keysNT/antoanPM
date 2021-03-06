<?php
ob_start();
require_once "../../layout/header.php";
require_once '../../../lib/database.php';
$db = new Database();
$cate_id = $db->fetchAll("category"); //lay data tu bang cate=>them vao form add
$productname = $db->fetchAll("product");
if (isset($_POST['addproduct'])) {
    if (isset($_FILES['thunbar'])) {
        // Nếu file upload không bị lỗi,
        // Tức là thuộc tính error > 0
        if ($_FILES['thunbar']['error'] > 0) {
            echo 'File Upload Bị Lỗi';
        } else {
            // Upload file
            move_uploaded_file($_FILES['thunbar']['tmp_name'], 'C:\xampp\htdocs\qhlmstore\public\upload\product\ ' . $_FILES['thunbar']['name']); //code upload anh
        }
    }
}
var_dump($_POST);
$check=0;//bien xet them moi san pham bi trung

//bat loi them moi trung nhau ne$productname=$db->fetchAll("product");
if (isset($_POST) && $_POST!=NULL) {
    foreach ($productname as $key => $item) {
        if ($_POST["name"] == $item["name"]) {
           $check=1;
        }
    }
    if($check==0){
    $db->addproduct($_POST,$_FILES['thunbar']['name'] );//truyen vao $post va ten file,vi ten file k dc luu trong $post ma dc luutrong bien $file
    header('Location: http://localhost/qhlmstore/admin/modules/products/index.php');
      exit();
    }else{
        $error="san pham da ton tai";
    }
}
ob_end_flush();
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Them moi san pham
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i></i> <a href="index.php">View Product</a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="addproduct.php"  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Danh Muc San Pham</label>
                <div class="col-sm-7">
                    <select class="form-control col-sm-7" name="category_id" id="category_id">
                        <option value="">Chon Danh Muc San Pham</option>
<?php
foreach ($cate_id as $key => $item) {
    ?>
                        <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"] ?></option>     
    <?php
}
//foreach lay data tu bang category=>gan cho tung option
?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label" >Ten San Pham</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                           <p class="text-danger"><?php if(isset($error)){echo $error;} ?></p>
                </div>
            </div>
             <div class="form-group">
                <label for="input" class="col-sm-2 control-label">SoLuong</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="Soluong" name="Soluong" placeholder="Soluong" required>

                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Gia San Pham</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" placeholder="GiaSanPham" required>

                </div>
            </div>
                <div class="form-group">
                <label for="input" class="col-sm-2 control-label">CPU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cpu" name="cpu" placeholder="CPU" required>

                </div>
            </div>
                <div class="form-group">
                <label for="input" class="col-sm-2 control-label">RAM</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="ram" name="ram" placeholder="Dung lượng RAM" required>

                </div>
            </div>
                <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Hệ điều hành</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hdh" name="hdh" placeholder="Hệ Điều Hành" required>

                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">VGA</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="vga" name="vga" placeholder="VGA" required>

                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">HDD</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="hdd" name="hdd" placeholder="Dung Lượng Bộ Nhớ" required>

                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Sale</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="sale" name="sale" placeholder="10%" >
                </div>


                <label for="input" class="col-sm-2 control-label">Hinh Anh</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="thunbar" name="thunbar" required>
                </div>

            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Noi Dung</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary " name="addproduct">ADD</button>
                </div>
            </div>
        </form>
    </div>   
</div>
<!-- /.row -->
<?php
require_once "../../layout/footer.php";
?>
 