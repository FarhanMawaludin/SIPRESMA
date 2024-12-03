<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct($conn)
    {
        $this->userModel = new UserModel($conn);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil input dan bersihkan dari spasi
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Validasi input
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Username atau password tidak boleh kosong!";
                header("Location: ./views/login.php");
                exit();
            }

            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                // Jika login berhasil, simpan informasi session
                $_SESSION['user'] = $user;
                $_SESSION['loggedin_time'] = time();

                // Cek apakah mahasiswa atau dosen
                if (isset($user['role_dosen'])) {
                    // Jika dosen
                    if ($user['role_dosen'] == 'dosen') {
                        $_SESSION['role'] = 'dosen';
                        header("Location: dashboard_dosen.php");
                    } elseif ($user['role_dosen'] == 'kajur') {
                        $_SESSION['role'] = 'kajur';
                        header("Location: dashboard_kajur.php");
                    }
                } else {
                    // Jika mahasiswa
                    $_SESSION['role'] = 'mahasiswa';
                    header("Location: index.php?page=home");
                }
                exit();
            } else {
                // Jika login gagal
                $_SESSION['error'] = "Username atau password salah!";
                header("Location: index.php?page=login");
                exit();
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../public/login.php?message=logged_out");
        exit();
    }

    public function isSessionActive()
    {
        // Cek apakah sesi aktif
        if (isset($_SESSION['loggedin_time']) && (time() - $_SESSION['loggedin_time'] > 3600)) {
            session_destroy();
            header("Location: ../public/login.php?message=session_expired");
            exit();
        }
        return true; // Sesi masih aktif
    }
}
?>
