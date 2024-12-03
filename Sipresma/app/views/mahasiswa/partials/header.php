<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SIPRESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="././../assets/css/style.css">
    <link rel="stylesheet" href="././../assets/css/header.css">
    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <!-- Logo -->
            <img class="logo-sipresma" src="././../assets/img/Logo 4x.png" alt="SIPRESMA-LOGO" href="#"
                style="z-index: 120;">

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'home') ? 'active' : ''; ?>" href="././../public/index.php?page=home" >
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'prestasi') ? 'active' : ''; ?>" href="././../public/index.php?page=prestasi">
                            Prestasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">IPK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peringkatakademik.html">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bantuan</a>
                    </li>
                </ul>
            </div>

            <!-- User Info and Image -->
            <div class="user-info">
                <div class="d-flex flex-column text-end">
                    <p class="info-text-nav" style="font-weight:600; font-size: 15px;">
                        <?php echo isset($_SESSION['user']['nama_mahasiswa']) ? $_SESSION['user']['nama_mahasiswa'] : 'Mahasiswa'; ?>
                    </p>
                    <p class="info-text-nav" style="color:#AEAEB2; font-size: 13px;">
                        <?php echo isset($_SESSION['user']['NIM']) ? $_SESSION['user']['NIM'] : 'NIM'; ?></p>
                </div>
                <img src="././../assets/img/animoji.png" alt="">
            </div>

            <!-- Navbar Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>