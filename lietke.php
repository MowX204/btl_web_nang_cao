<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liet ke danh sach sinh vien</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">DANH SACH SINH VIEN</h1>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Them moi sinh vien
        </button>
    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Ma sinh vien</th>
        <th>Ho ten</th>
        <th>Lop</th>
        <th>Thao tac</th>
      </tr>
    </thead>
    <?php
    //ket noi
    require_once 'ketnoi.php';
    //cau lenh
    $lietke_sql = "SELECT * FROM sinhvien order by lop, hoten";
    //thuc thi cau lenh
    $result = mysqli_query($conn, $lietke_sql);
    //duyet result va in ra
    while ($r = mysqli_fetch_assoc($result)){
    ?>
        <tr>
        <td><?php echo $r['masv'];?></td>
        <td><?php echo $r['hoten'];?></td>
        <td><?php echo $r['lop'];?></td>
        <td><a href="edit.php?sid=<?php echo $r['id'];?>" class="btn btn-info">Sua</a>
        <a onclick="return confirm('Ban co muon xoa sinh vien nay khong?');" href="xoa.php?sid=<?php echo $r['id'];?>" class="btn btn-danger">Xoa</a></td>
      </tr>
    <?php
    }
    ?>
    </tbody>
    </table>
    <tbody>
    
    </div>
    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Them Sinh Vien</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="them.php" method="post">
            <div class="form-group">
                <label for="hoten">Ho ten</label>
                <input type="text" id="hoten" class="form-control" name="hoten">
            </div>
            <div class="form-group">
                <label for="masv">Ma sinh vien</label>
                <input type="text" name="masv" id="masv" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Lop</label>
                <input type="text" id="lop" name="lop" class="form-control">
            </div>
            <button  class="btn btn-success">Them sinh vien</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</body>
</html>
