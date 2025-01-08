<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/artist_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Spoticon - Người dùng</title>
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

    
    <div id="artist-description" class="container">
        <div class="card bg-dark text-white shadow-lg">
            <!-- Tiêu đề nghệ sĩ -->
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">NGƯỜI DÙNG</h2>
            </div>

            <!-- Nội dung nghệ sĩ -->
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <!-- Hình ảnh -->
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3 text-center">
                        <?php
                        $img = array('https://yt3.googleusercontent.com/oN0p3-PD3HUzn2KbMm4fVhvRrKtJhodGlwocI184BBSpybcQIphSeh3Z0i7WBgTq7e12yKxb=s900-c-k-c0x00ffffff-no-rj', 'https://th.bing.com/th/id/OIP.byu4wb3Ag5IKYqZcJT_eXwHaHa?w=683&h=683&rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.6007a8c23db45c36488bfa7a0035d090?rik=y7ZfdfdUUiPaaw&pid=ImgRaw&r=0', 'https://cdnphoto.dantri.com.vn/ecdPkKw4WCg-NR0Zi2shwRYyUlo=/thumb_w/1020/2022/11/10/micheal-jackson-1668044313441.jpg', 'https://media.vov.vn/sites/default/files/styles/large/public/2021-08/image_7.jpeg.jpg', 'https://yt3.googleusercontent.com/gam065jhT3tmDHVFglA846lO0oNHImdty7Vw2ATuWOzcamMWmsNYzVqrmtlWX1egn6BKYq__Mw=s900-c-k-c0x00ffffff-no-rj');
                        $img_i = rand(0, count($img) - 1);
                        echo '<img src="'. $img[$img_i] .'" class="img-fluid rounded shadow-sm" alt="Image">';
                        ?>
                        </div>

                    <!-- Thông tin nghệ sĩ -->
                    <div class="col-md-6">
                        <?php
                            include 'connect.php'; // Kết nối đến CSDL
                            $id = $_GET['id'];
                            $stmt = $db->prepare("SELECT *
                                FROM 
                                    NGUOI_DUNG
                                WHERE 
                                    NGUOI_DUNG.ID = $id;
                            ");

                            $stmt->execute();

                            $result = $stmt->fetchAll();


                            if (count($result) > 0) {
                                    echo '
                                    <ul class="list-unstyled mt-3">
                                        <li><strong>Tên người dùng:</strong> ' . $result[0]['Ten_dang_nhap'] . '</li>
                                        <li><strong>Mật khẩu người dùng:</strong> ' . $result[0]['Mat_khau'] . '</li>
                                    </ul>';
            
                            } else {
                                echo "Không tìm thấy người dùng";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card bg-dark text-white shadow-lg">
            <div class="card-body">    
                <div class="container mt-4">
                    <!-- Hiển thị bài hát nổi bật-->
                    <h4 class="mt-4">Các bình luận của người dùng</h4>
                            <div class="border-top pt-3">
                                <!-- Mỗi bài hát-->
                                <?php
                                    include 'connect.php'; // Kết nối đến CSDL
                                        $id = $_GET['id'];
                                        //Hiển thị 5 bài hát có lượt nghe cao nhất từ ID nghệ sĩ
                                        $stmt = $db->prepare("SELECT BAI_HAT.Ten_bai_hat AS Ten_bai_hat, NOI_DUNG_BINH_LUAN.Noidung AS Noi_dung, BAI_HAT.ID AS ID_bai_hat, NGUOI_DUNG.ID AS ID_nguoi_dung
                                        FROM NGUOI_DUNG, BINH_LUAN, NOI_DUNG_BINH_LUAN, BAI_HAT
                                        WHERE BINH_LUAN.ID_Nguoi_dung=NGUOI_DUNG.ID AND NOI_DUNG_BINH_LUAN.ID_Bai_hat=BAI_HAT.ID AND NOI_DUNG_BINH_LUAN.ID_nguoi_dung=NGUOI_DUNG.ID AND BAI_HAT.ID=BINH_LUAN.ID_Bai_hat AND NGUOI_DUNG.ID=$id;
                                                ");

                                        $stmt->execute();

                                        $result = $stmt->fetchAll();

                                        if (count($result) > 0) {
                                            for ($i=0;$i<count($result);$i++) {
                                                echo 
                                                '<div >
                                                                                                                                                                   
                                                    <div class="row my-3 p-3" id="showSongs">
                                                        <div class="col-auto">
                                                            <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User Avatar">
                                                        </div>   
                                                        <div class="col">
                                                            <h5 class="mb-1">' . $result[$i]['Noi_dung'] . '</h5>
                                                            <p class="mb-0"> Bài hát: ' . $result[$i]['Ten_bai_hat'] . '</p>
                                                        </div>
                                                        <div class="col text-end align-middle">
                                                            <form action="../song_page.php" method="get" style="display:inline;">
                                                                <input type="hidden" name="id" value="' . $result[$i]['ID_bai_hat'] . '">
                                                                <button type="submit" class="btn btn-success">Xem chi tiết</button>
                                                            </form>
                                                            <form action="admin_delete_comment.php" method="get" style="display:inline;">
                                                                <input type="hidden" name="idUser" value="' . $id. '">
                                                                <input type="hidden" name="idSong" value="' . $result[$i]['ID_bai_hat']. '">
                                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                                            </form>
                                                        </div>
                                                       
                                                    </div>
                                                </div>';
                                            }
                                        } else {
                                            echo "Người dùng này chưa có bình luận nào.";
                                        }
                                ?>
                                
                                <!-- Thêm nút xem thêm -->
                                <div class="text-center">
                                    <button class="btn btn-outline-success btn-sm">Xem thêm</button>
                                </div>
                            </div>
                                                            
                </div>
                
            </div>
        </div>
        <div class="justify-content-center text-center mt-3">
            <form action="admin_user_management.php" method="get" style="display:inline;">
                                                                <button type="submit" class="btn btn-success">Quay lại</button>
            </form>
        </div>
    </div>

        <div id="footer" class="bg-black mt-2 text-light border-top border-white text-center py-4">
    <div class="row">
        <div class="col-12 col-md-4">
            <a href="homePage.php">
                <img src="./assets/image/icon/logo.png" alt="Spoticon logo" class="img-fluid">   
            </a>
            <div class="socials-list d-flex justify-content-center mt-2">
                <a href=""><i class="ti-facebook text-light me-2"></i></a>
                <a href=""><i class="ti-instagram text-light me-2"></i></a>
                <a href=""><i class="ti-linux text-light me-2"></i></a>
                <a href=""><i class="ti-pinterest text-light me-2"></i></a>
                <a href=""><i class="ti-twitter text-light me-2"></i></a>
                <a href=""><i class="ti-linkedin text-light"></i></a>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <p class="fw-bold fs-5 mt-3">Liên Hệ</p>
            <p> <i class="ti-location-pin"></i> Số 123, Đường ABS, Thành phố XYZ</p>
            <p> <i class="ti-mobile"></i> Phone: <a href="tel:+00151515">0123456789</a></p>
            <p> <i class="ti-email"></i> Email: <a href="mailto:quangminh4141@gmail.com">Spoticon@mail.com</a></p>
        </div>
        <div class="col-12 col-md-4">
            <p class="fw-bold fs-5 mt-3">Hỗ Trợ</p>
            <p>Điều khoản và Dịch vụ</p>
            <p>Chính sách</p>
            <p>Về chúng tôi</p>
        </div>    
    </div>
</div>

    </div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>