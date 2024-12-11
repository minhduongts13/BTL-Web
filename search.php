<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Main Page</title>
    <?php include("auth.php") ?>
    <style> .dropdown-item:hover, .dropdown-item:focus { background-color: #343a40 !important; /* Màu nền khi hover */ color: #ffffff !important; /* Màu chữ khi hover */ } </style> 

</head>
<body class="bg-black text-light">
    <!-- Header -->
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 mb-5 shadow-lg mb-5">
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

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <!-- Danh sách bài hát -->
        <section id="song-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách kết quả tìm kiếm bài hát</h2>
            <div class="row">
            <?php
                include 'connect.php'; // Kết nối cơ sở dữ liệu

                // Lấy và kiểm tra đầu vào từ người dùng
                $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
                if (!$query) {
                    die("Tìm kiếm không hợp lệ");
                }

                try {
                    // Chuẩn bị và thực thi truy vấn an toàn
                    $stmt = $db->prepare("CALL `assignment2`.`SearchSongsByName`(:query)");
                    $stmt->bindValue(':query', $query, PDO::PARAM_STR);
                    $stmt->execute();

                    // Lấy kết quả
                    $songs = $stmt->fetchAll();
                    

                    
                } catch (PDOException $e) {
                    // Ghi log lỗi thay vì hiển thị chi tiết
                    error_log($e->getMessage());
                    die("An error occurred. Please try again later.");
                }

                $img = array('https://media.pitchfork.com/photos/6614092742a7de97785c7a48/master/w_1280%2Cc_limit/Billie-Eilish-Hit-Me-Hard-and-Soft.jpg', 'https://miro.medium.com/max/6000/1*O6soMKjf8PPr9lb6ong_Fw.jpeg', 'https://i.scdn.co/image/ab67616d0000b27371dea61e1ce07e18c746d775', 'https://th.bing.com/th/id/OIP.ihrb6OsCLaaNNeUX9zfp0wHaHa?rs=1&pid=ImgDetMain', 'https://images.genius.com/bcaf43cefdd93a9be1da5d17d4a061f9.1000x1000x1.jpg', 'https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/61/3d/86/613d86b4-e539-108e-84f7-46ce1962f778/190296036132.jpg/1200x1200bf-60.jpg', 'https://th.bing.com/th/id/OIP.UgvF6caKdQipEANwQGcC4wHaHa?rs=1&pid=ImgDetMain', 'https://e.snmc.io/i/600/s/b8168764a6812ba7ee521cd32406b9ad/12621308/rose-and-bruno-mars-apt-cover-art.jpg', 'https://th.bing.com/th/id/OIP.64Ec-8p__cNSfhVuhf14rwHaHa?rs=1&pid=ImgDetMain', 'https://upload.wikimedia.org/wikipedia/en/3/38/When_We_All_Fall_Asleep%2C_Where_Do_We_Go%3F.png', 'https://th.bing.com/th/id/OIP.wljmAULxSw3-tgVzTPp_SAHaHa?rs=1&pid=ImgDetMain');

                // Loop through songs and create cards
                foreach ($songs as $song) {
                    $img_i = rand(0, count($img) - 1);

                    echo '<div class="col-md-3 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                    <h5 class="card-title text-truncate">' . htmlspecialchars($song['Ten_Bai_Hat']) . '</h5>
                                    <p class="card-text"><small>Ngày phát hành: ' . htmlspecialchars($song['Ngay_Phat_Hanh']) . '</small></p>
                                    <a href="song_page.php?id=' . htmlspecialchars($song['ID_Bai_Hat']) . '" class="btn btn-success btn-sm">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách nghệ sĩ -->
        <section id="artist-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách kết quả tìm kiếm nghệ sĩ</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                $query = $_GET['query'];
                $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
                if (!$query) {
                    die("Tìm kiếm không hợp lệ");
                }
                $stmt = $db->prepare("CALL SearchArtistsByName(:query)");
                $stmt->execute(['query' => $query]);
                $artists = $stmt->fetchAll();
                $img = array('https://yt3.googleusercontent.com/oN0p3-PD3HUzn2KbMm4fVhvRrKtJhodGlwocI184BBSpybcQIphSeh3Z0i7WBgTq7e12yKxb=s900-c-k-c0x00ffffff-no-rj', 'https://th.bing.com/th/id/OIP.byu4wb3Ag5IKYqZcJT_eXwHaHa?w=683&h=683&rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.6007a8c23db45c36488bfa7a0035d090?rik=y7ZfdfdUUiPaaw&pid=ImgRaw&r=0', 'https://cdnphoto.dantri.com.vn/ecdPkKw4WCg-NR0Zi2shwRYyUlo=/thumb_w/1020/2022/11/10/micheal-jackson-1668044313441.jpg', 'https://media.vov.vn/sites/default/files/styles/large/public/2021-08/image_7.jpeg.jpg', 'https://yt3.googleusercontent.com/gam065jhT3tmDHVFglA846lO0oNHImdty7Vw2ATuWOzcamMWmsNYzVqrmtlWX1egn6BKYq__Mw=s900-c-k-c0x00ffffff-no-rj');
                foreach ($artists as $artist) {
                    $img_i = rand(0, count($img) - 1);
                    echo '<div class="col-md-3 mb-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body text-center">
                                    <a class="text-decoration-none text-white" href="artist_page.php?id='. $artist['ID_Nghe_Si'] .'">
                                        <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                        <h5 class="card-title">' . htmlspecialchars($artist['Nghe_Danh']) . '</h5>
                                    </a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách nhà phát hành -->
        <section id="publisher-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Kết quả tìm kiếm album</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                $query = $_GET['query'];
                $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
                if (!$query) {
                    die("Tìm kiếm không hợp lệ");
                }
                $stmt = $db->prepare("CALL SearchAlbumsByName(:query);");
                $stmt->execute(['query' => $query]);
                $albums = $stmt->fetchAll();
                $img = array('https://media.pitchfork.com/photos/6614092742a7de97785c7a48/master/w_1280%2Cc_limit/Billie-Eilish-Hit-Me-Hard-and-Soft.jpg', 'https://miro.medium.com/max/6000/1*O6soMKjf8PPr9lb6ong_Fw.jpeg', 'https://i.scdn.co/image/ab67616d0000b27371dea61e1ce07e18c746d775', 'https://th.bing.com/th/id/OIP.ihrb6OsCLaaNNeUX9zfp0wHaHa?rs=1&pid=ImgDetMain', 'https://images.genius.com/bcaf43cefdd93a9be1da5d17d4a061f9.1000x1000x1.jpg', 'https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/61/3d/86/613d86b4-e539-108e-84f7-46ce1962f778/190296036132.jpg/1200x1200bf-60.jpg', 'https://th.bing.com/th/id/OIP.UgvF6caKdQipEANwQGcC4wHaHa?rs=1&pid=ImgDetMain', 'https://e.snmc.io/i/600/s/b8168764a6812ba7ee521cd32406b9ad/12621308/rose-and-bruno-mars-apt-cover-art.jpg', 'https://th.bing.com/th/id/OIP.64Ec-8p__cNSfhVuhf14rwHaHa?rs=1&pid=ImgDetMain', 'https://upload.wikimedia.org/wikipedia/en/3/38/When_We_All_Fall_Asleep%2C_Where_Do_We_Go%3F.png', 'https://th.bing.com/th/id/OIP.wljmAULxSw3-tgVzTPp_SAHaHa?rs=1&pid=ImgDetMain');
                foreach ($albums as $album) {
                    $img_i = rand(0, count($img) - 1);
                    echo '
                    <div class="col-md-3 mb-3">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                <a class="text-decoration-none text-white" href="albuminfor.php?id='. $album['ID_Album'] .'">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                    <h5 class="card-title">' . htmlspecialchars($album['Ten_Album']) . '</h5>
                                    <p class="card-text"><small>Ngày phát hành: ' . htmlspecialchars($album['Ngay_Phat_Hanh']) . '</small></p>
                                </a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
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
