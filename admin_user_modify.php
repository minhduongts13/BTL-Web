<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Modify User</title>
    <?php include("auth.php") ?>
    <style> .dropdown-item:hover, .dropdown-item:focus { background-color: #343a40 !important; /* Màu nền khi hover */ color: #ffffff !important; /* Màu chữ khi hover */ } </style> 

</head>

<body class="bg-black">
<div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 mb-5 shadow-lg">
        <?php
        $newloca = "homePage.php";
        if ($_SESSION['username'] == 'admin') $newloca = "homePage_admin.php";
        echo '<a href="'. $newloca .'" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>';
        ?>
        <form class="d-flex flex-grow-1" role="search" method="GET" action="search.php">
            <input id="Search" class="form-control me-2 rounded-pill border-0 shadow-sm" type="text" name="query" placeholder="Tìm kiếm bài hát, nghệ sĩ..." aria-label="Search" style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
            <button class="btn btn-success rounded-pill px-4" type="submit">Tìm kiếm</button>
        </form>

        <div class="ms-4">
            <div class="d-none d-lg-flex gap-3">
                <?php
                if ($_SESSION['username'] == 'admin') echo '
                <a href="admin_user_management.php" class="text-decoration-none text_light">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Người dùng</button>
                </a> 
                <a href="advertiser_list.php" class="text-decoration-none text_light">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Nhà quảng cáo</button>
                </a>
                <a href="advertisement_list.php" class="text-decoration-none text_light">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Quảng cáo</button>
                </a>';
                echo '
                <a class="text-decoration-none text_light" href="playlist.php?id='. $_SESSION['user_id'] .'">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Playlist của tôi</button>
                </a>
                ';
                ?>
                <a href="user_account_page.php">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Tài khoản của tôi</button>
                </a>
            </div>
            <!-- Dropdown Menu for small screens -->
            <div class="dropdown d-lg-none">
                <button class="btn btn-outline-light dropdown-toggle rounded-pill px-3 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
                <ul class="dropdown-menu dropdown-menu-end bg-black">
                    <?php
                    if ($_SESSION['username'] == 'admin') echo '
                    <li><a href="admin_user_management.php" class="dropdown-item text-light ">Người dùng</a></li>
                    <li><a href="advertiser_list.php" class="dropdown-item text-light ">Nhà quảng cáo</a></li>
                    <li><a href="advertisement_list.php" class="dropdown-item text-light">Quảng cáo</a></li>';
                    echo '
                    <li><a href="playlist.php?id='. $_SESSION['user_id'] .'" class="dropdown-item text-light">Playlist của tôi</a></li>
                    ';
                    ?>
                    <li><a href="user_account_page.php" class="dropdown-item text-light">Tài khoản của tôi</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id='song-description' class='container'>
        <div class='card bg-dark text-white shadow-lg'>
            <div class='bg-success bg-gradient p-2'>
                <h2 class='card-title text-center text-uppercase mb-0'>SỬA THÔNG TIN NGƯỜI DÙNG</h2>
            </div>

            <?php 
            include 'connect.php';
            $id = $_GET['id'];
            $statement = $db->prepare("SELECT * FROM NGUOI_DUNG WHERE ID=$id");
            $statement->execute();
            $result = $statement->fetch();

            $name = $result['Ten_dang_nhap'];
            $pass = $result['Mat_khau'];

            echo "
            <form method='post' action='admin_user_modify2.php?id=$id' id='addNewContract'>

                <div class='form-group row mt-2'>
                    <label for='name-advertiser' class='col-sm-2 col-form-label'>Tên đăng nhập</label>
                    <div class='col-8 col-md-6'>
                        <input type='text' class='form-control' id='name-advertiser' placeholder='Nhập tên đăng nhập' name='name' value='$name' required>
                    </div>
                </div>

                <div class='form-group row mt-2'>
                    <label for='description-advertiser' class='col-sm-2 col-form-label'>Mật khẩu</label>
                    <div class='col-8 col-md-6'>
                        <textarea class='form-control' id='description-advertiser' placeholder='Nhập mật khẩu' name='pass' rows='5'>$pass</textarea>
                    </div>
                </div>                

                <div class='form-group row mt-2 d-flex justify-content-center'>
                    <button class='btn btn-primary col-2 col-md-1' type='submit'>Sửa</button>
                </div>

            </form>

            <div class='mt-3 d-flex justify-content-center'>
                <a href='admin_user_management.php>
                    <button class='btn btn-light'>Quay lại</button>
                </a>    
            </div>
            ";
            
            ?>


    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>