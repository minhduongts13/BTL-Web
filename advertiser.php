<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/advertisers.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Nhà quảng cáo</title>
    <?php include("auth.php") ?>
    <style> .dropdown-item:hover, .dropdown-item:focus { background-color: #343a40 !important; /* Màu nền khi hover */ color: #ffffff !important; /* Màu chữ khi hover */ } </style> 

    <script>
        $(document).ready(function() {
            $("#returnListAdvertiser").click(function () {
                $("#song-description").load('advertiser_list_without_footer.php');
            })
        })

        function modify(idAds) {
            $("#song-description").load('advertiser_modifier.php?idAds=' + idAds);
        }
    </script>

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
                    <li><a href="advertiser_list.php" class="dropdown-item text-light">Nhà quảng cáo</a></li>
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

    <div id="song-description" class="container min-vh-100">
        <div class="card bg-dark text-white shadow-lg">
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">NHÀ QUẢNG CÁO</h2>
            </div>

            <div>
                <?php
                $img = array('https://www.brandinginasia.com/wp-content/uploads/2023/07/Vinamilk-New-Logo.jpg', 'https://th.bing.com/th/id/R.b000fe938f1a1043ec4c83f0ff38523d?rik=haqlalLbHipNgg&riu=http%3a%2f%2fvanphongphamdongnai.net.vn%2fsystem%2fhtml%2fbot-giat-aba-e7dde1ee.jpg&ehk=5kiyFEnTmeDas1AeEzn6aJj448Jjo%2b7LejFneEDGvSQ%3d&risl=&pid=ImgRaw&r=0', 'https://inkythuatso.com/uploads/images/2021/12/logo-fpt-polytechnic-inkythuatso-09-12-57-46.jpg', 'https://th.bing.com/th/id/OIP.jsNn-cz17xZ4GW8u0MKEwwHaBj?rs=1&pid=ImgDetMain');
                $img_i = rand(0, count($img) - 1);
                echo '<div class="col-md-12 text-center mt-4">
                    <img src="'. $img[$img_i] .'" class="img-fluid rounded shadow-sm" alt="Image">
                </div>';
                ?>
                <?php
                    $idAds = $_GET['idAds'];

                    include "connect.php";
                    $statement = $db->prepare("CALL selectAdvertiser($idAds)");
                   
                    $statement->execute();
                    $result = $statement->fetch();

                    $nameAdvertiser = $result['Ten_don_vi_quang_cao'];
                    $description = $result['Mo_ta'];

                    echo "
                    <div class='container'>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Nhà quảng cáo:</div>
                            <div class='col'>$nameAdvertiser</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Mô tả:</div>
                            <div class='col'>$description</div>
                        </div>
                    </div>

                    <div class='mt-3 d-flex justify-content-center'>
                        <button class='btn btn-success' onclick='modify($idAds)'>Sửa</button>
                    </div>

                    <div class='mt-3 d-flex justify-content-center'>
                        <a href='advertiser_list.php'>
                        <button class='btn btn-light'>Quay lại</button>
                        </a>
                    </div>
                    ";
                ?>
            </div>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>