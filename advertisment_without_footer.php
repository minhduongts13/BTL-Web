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
    <title>Quảng cáo</title>
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

    <div id="song-description" class="container">
        <div class="card bg-dark text-white shadow-lg">
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">HỢP ĐỒNG QUẢNG CÁO</h2>
            </div>

            <div>
            <?php
                $img = array('https://www.brandinginasia.com/wp-content/uploads/2023/07/Vinamilk-New-Logo.jpg', 'https://th.bing.com/th/id/R.b000fe938f1a1043ec4c83f0ff38523d?rik=haqlalLbHipNgg&riu=http%3a%2f%2fvanphongphamdongnai.net.vn%2fsystem%2fhtml%2fbot-giat-aba-e7dde1ee.jpg&ehk=5kiyFEnTmeDas1AeEzn6aJj448Jjo%2b7LejFneEDGvSQ%3d&risl=&pid=ImgRaw&r=0', 'https://inkythuatso.com/uploads/images/2021/12/logo-fpt-polytechnic-inkythuatso-09-12-57-46.jpg');
                $img_i = rand(0, count($img) - 1);
                echo '<div class="col-md-12 text-center mt-4">
                    <img src="'. $img[$img_i] .'" class="style="height: 200px" md:img-fluid rounded shadow-sm"  alt="Image">
                </div>';
                ?>


                <?php
                    $idContract = $_GET['idCon'];

                    include "connect.php";
                    $statement = $db->prepare("CALL selectAdvertisement($idContract)");
                   
                    $statement->execute();
                    $result = $statement->fetch();

                    $nameAdvertiser = $result['Ten_don_vi_quang_cao'];
                    $description = $result['Mo_ta'];
                    $dateStart = date_format(date_create($result['Thoi_gian_hieu_luc_hop_dong']), 'd-M-Y');
                    $dateEnd = date_format(date_create($result['Ngay_bat_dau_quang_cao']), 'd-M-Y');

                    echo "
                    <div class='container'>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Nhà quảng cáo:</div>
                            <div class='col'>$nameAdvertiser</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Mô tả quảng cáo:</div>
                            <div class='col'>$description</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Ngày bắt đầu:</div>
                            <div class='col'>$dateStart</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Ngày kết thúc:</div>
                            <div class='col'>$dateEnd</div>
                        </div>
                    </div>
                    ";

                    $statement = $db->prepare("SELECT getAdsType($idContract)");
                    $statement->execute();
                    
                    $result = $statement->fetch();
                    echo "
                        <div class='container'>
                            <div class='row mt-3'>
                                <div class='col text-uppercase'>Loại:</div>
                                <div class='col'>$result[0]</div>
                            </div>";
                    if ($result[0] == 'Premium') {
                        echo "
                            <div class='mt-5 d-flex justify-content-center fs-4'>
                                DANH SÁCH NGHỆ SĨ ĐƯỢC CHỌN
                            </div>
                            <table class='table table-bordered table-hover table-responsive-lg mt-3'>
                            <thead class='table-success'>
                                <tr>
                                    <th scope='col' class='center width10'>STT</th>
                                    <th scope='col' class='center width50'>NGHỆ DANH NGHỆ SĨ</th>
                                    <th scope='col' class='center width20'>NGÀY BẮT ĐẦU</th>
                                    <th scope='col' class='center width20'>NGÀY HẾT HẠN</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        $statement = $db->prepare("CALL getArtistsForAdsType1($idContract)");
                        $statement->execute();
                        $res = $statement->fetchAll();
                        for ($i = 0; $i < count($res); $i++) {
                            $name = $res[$i]['Nghe_danh'];
                            $startDate = $res[$i]['Ngay_bat_dau'];
                            $endDate = $res[$i]['Ngay_ket_thuc'];
                            echo "
                                <tr>
                                    <th scope='row' class='center width10'>$i</th>
                                    <th scope='col' class='center width50'>$name</th>
                                    <th scope='col' class='center width20'>$startDate</th>
                                    <th scope='col' class='center width20'>$endDate</th>
                                </tr>
                            ";
                        }
                        echo "
                            </tbody>
                        </table>

                            <div class='mt-5 d-flex justify-content-center fs-4'>
                            <a href='add_hot_artist.php?idAd=$idContract'>
                                <button class='btn btn-success'>Thêm nghệ sĩ</button>
                            </a>
                        </div>
                        
                        ";
                    }
                ?>

                <div class="mt-3 d-flex justify-content-center">
                    <a href="advertisement_list.php">
                        <button class="btn btn-light">Quay lại</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>