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
    <title>Spoticon - The Artist</title>
    <?php include("auth.php") ?>
</head>
<body class="bg-black">
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>

        <!-- Thanh tìm kiếm -->
        <form class="d-flex flex-grow-1" role="search">
            <input id="Search" 
                class="form-control me-2 rounded-pill border-0 shadow-sm" 
                type="search" 
                placeholder="Tìm kiếm nghệ sĩ, nghệ sĩ..." 
                aria-label="Search" 
                style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
            <button class="btn btn-success rounded-pill px-4" type="submit">Tìm kiếm</button>
        </form>

        <!-- Các nút chức năng -->
        <div class="ms-4 d-flex gap-3">
            <a href="advertiser_list.php" class="text-decoration-none text_light">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Nhà quảng cáo</button>
            </a>
            <a href="advertisement_list.php" class="text-decoration-none text_light">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Quảng cáo</button>
            </a>
            <?php 
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
    </div>

    
    <div id="artist-description" class="container">
        <div class="card bg-dark text-white shadow-lg">
            <!-- Tiêu đề nghệ sĩ -->
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">NGHỆ SĨ</h2>
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
                            $stmt = $db->prepare("SELECT 
                                    NGHE_SI.ID AS Ma_Nghe_Si,
                                    NGHE_SI.Nghe_danh AS Nghe_Danh,
                                    NGHE_SI.Mo_ta AS Mo_Ta,
                                    NGHE_SI.Ho AS Ho_Nghe_Si,
                                    NGHE_SI.Ten AS Ten_Nghe_Si,
                                    NGHE_SI.ID_nha_phat_hanh AS ID_Nha_Phat_Hanh,
                                    NGHE_SI.ID_nhom_nhac AS ID_Nhom_Nhac
                                FROM 
                                    NGHE_SI
                                WHERE 
                                    NGHE_SI.ID = $id;
                                GROUP BY 
                                    NGHE_SI.ID
                            ");

                            $stmt->execute();

                            $result = $stmt->fetchAll();


                            $stmt = $db->prepare("SELECT NHA_PHAT_HANH.Ten_nha_phat_hanh AS Ten_Nph
                                        FROM NGHE_SI, NHA_PHAT_HANH
                                        WHERE NGHE_SI.ID_nha_phat_hanh = NHA_PHAT_HANH.ID;                             
                            ");

                            $stmt->execute();

                            $result2 = $stmt->fetchAll();
                            $stmt = $db->prepare("SELECT NHOM_NHAC.Ten_nhom_nhac AS Ten_Nhom_Nhac
                                        FROM NGHE_SI, NHOM_NHAC
                                        WHERE NGHE_SI.ID_nhom_nhac = NHOM_NHAC.ID;                             
                            ");

                            $stmt->execute();

                            $result3 = $stmt->fetchAll();

                            if (count($result3)>0) {
                                $tenNhomNhac = $result3[0]['Ten_Nhom_Nhac'];
                            }
                            else {
                                $tenNhomNhac = "Không có";
                            }
                            if (count($result) > 0) {
                                    $result[0]['Ho_Ten'] = trim($result[0]['Ho_Nghe_Si']).' '.trim($result[0]['Ten_Nghe_Si']);
                                    echo '
                                    <h2 class="card-title fw-bold text-uppercase">' . $result[0]['Nghe_Danh'] . '</h2>
                                    <ul class="list-unstyled mt-3">
                                        <li><strong>Họ tên::</strong> ' . $result[0]['Ho_Ten'] . '</li>
                                        <li><strong>Mô tả:</strong> ' . $result[0]['Mo_Ta'] . '</li>
                                        <li><strong>Thuộc nhà phát hành:</strong> ' . $result2[0]['Ten_Nph'] . '</li>
                                        <li><strong>Nhóm nhạc:</strong> ' . $tenNhomNhac . '</li>
                                    </ul>';
            
                            } else {
                                echo "Không tìm thấy nghệ sĩ";
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
                    <h4 class="mt-4">Các bài hát nổi bật</h4>
                            <div class="border-top pt-3">
                                <!-- Mỗi bài hát-->
                                <?php
                                    include 'connect.php'; // Kết nối đến CSDL
                                        $id = $_GET['id'];
                                        //Hiển thị 5 bài hát có lượt nghe cao nhất từ ID nghệ sĩ
                                        $stmt = $db->prepare("CALL GetTop5SongsByArtist($id);
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
                                                            <h5 class="mb-1">' . $result[$i]['Ten_Bai_Hat'] . '</h5>
                                                            <p class="mb-0"> Lượt nghe: ' . $result[$i]['Luot_Nghe'] . '</p>
                                                            <p class="mb-0"> Ngày phát hành: ' . $result[$i]['Ngay_Phat_Hanh'] . '</p>
                                                        </div>
                                                        <div class="col text-end align-middle">
                                                            <form action="song_page.php" method="get" style="display:inline;">
                                                                <input type="hidden" name="id" value="' . $result[$i]['ID_Bai_Hat'] . '">
                                                                <button type="submit" class="btn btn-success">Xem chi tiết</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                        } else {
                                            echo "Nghệ sĩ này chưa có bài hát nào.";
                                        }
                                ?>
                                
                                <!-- Thêm nút xem thêm -->
                                <div class="text-center">
                                    <button class="btn btn-outline-success btn-sm">Xem thêm bài hát</button>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
        <div id="footer" class="bg-black mt-2 text-light border-top border-white">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <a href="homePage.php">
                            <img src="./assets/image/icon/logo.png" alt="">   
                        </a>   
                    </div>
                    <div class="socials-list d-flex justify-content-center mt-1">
                        <a href=""><i class="ti-facebook text-light me-1"></i></a>
                        <a href=""><i class="ti-instagram text-light me-1"></i></a>
                        <a href=""><i class="ti-linux text-light me-1"></i></a>
                        <a href=""><i class="ti-pinterest text-light me-1"></i></a>
                        <a href=""><i class="ti-twitter text-light me-1"></i></a>
                        <a href=""><i class="ti-linkedin text-light"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold fs-3">Liên Hệ</p>
                    <p> <i class="ti-location-pin"></i> Số 123, Đường ABS, Thành phố XYZ</p>
                    <p> <i class="ti-mobile"></i> Phone: <a href="tel:+00151515">0123456789</a></p>
                    <p> <i class="ti-email"></i> Email: <a href="mailto:quangminh4141@gmail.com">Spoticon@mail.com</a></p>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold fs-3">Hỗ Trợ</p>
                    <p>Điều khoản và Dịch vụ</p>
                    <p>Chính sách</p>
                    <p>Về chúng tôi</p>
                </div>    
            </div>
        </div>
    </div>

    
</body>
</html>