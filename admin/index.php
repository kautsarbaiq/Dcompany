<?php
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /auth/login.php');
} elseif ($_SESSION['role_name'] !== 'superadmin') {
    header("Location: index.php?page=dashboard");
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php');


include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/navbar.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/header.php');

$reports = query("SELECT reports.*, users.name as user_name FROM reports 
                    JOIN users ON reports.user_id = users.id ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is SuperAdmin</title>
</head>

<body>
    <?php
    if (isset($_GET['page']) && $_GET['page'] === 'dashboard') {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/dashboard.php');
    }


    if (!isset($_GET['page']) || $_GET['page'] === '') {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['role_name'] !== 'masyarakat') {
                include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/dashboard.php');
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Unauthorized',
                        text: 'You don't have access to this page',
                        icon: 'error'
                        }).then((result) => {
                            window.history.back();
                        });
                    </script>";
            }
        }
    }

    if (isset($_GET['page']) && $_GET['page'] === 'create_report') {
        if ($_SESSION['role_name'] === "superadmin") {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/create-report.php');
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Unauthorized',
                            text: 'You don't have access to this page',
                            icon: 'error'
                            }).then((result) => {
                                window.history.back();
                            });
                        </script>";
        }
    }

    if (isset($_GET['page']) && $_GET['page'] === 'reports') {
        if ($_SESSION['role_name'] === "superadmin") {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/reports.php');
        } else {
            echo "<script>
                        Swal.fire({
                            title: 'Unauthorized',
                            text: 'You don't have access to this page',
                            icon: 'error'
                            }).then((result) => {
                                window.history.back();
                            });
                        </script>";
        }
    }

    if($_GET['page'] === 'detail' && isset($_GET['id'])) {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/detail.php');
    }

    if($_GET['page'] === 'users') {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/users.php');
    }
    if ($_GET['page'] == "users_delete") {
        if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            if (hapus('id', 'users', $user_id) > 0) {
                echo "<script>
                Swal.fire({
                    title: 'Good job!',
                    text: 'Data berhasil dihapus',
                    icon: 'success'
                    }).then((result) => {
                        window.location.href = 'index.php?page=users';
                    });
                </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Failed!',
                    text: 'Data gagal dihapus',
                    icon: 'error'
                    }).then((result) => {
                        window.location.href = 'index.php?page=users';
                    });
                </script>";
            }
        } else {
            header("Location: /index.php?page=users");
            exit();
        }
    }

    if ($_GET['page'] == "reports_delete") {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            if (hapus('id', 'reports', $id) > 0) {
                echo "<script>
                Swal.fire({
                    title: 'Good job!',
                    text: 'Data berhasil dihapus',
                    icon: 'success'
                    }).then((result) => {
                        window.location.href = 'index.php?page=list';
                    });
                </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Failed!',
                    text: 'Data gagal dihapus',
                    icon: 'error'
                    }).then((result) => {
                        window.location.href = 'index.php?page=list';
                    });
                </script>";
            }
        } else {
            header("Location: /index.php?page=list");
            exit();
        }
    }

    if ($_GET['page'] == "reports_approve") {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            approve('reports', $id);
            echo "<script>
                Swal.fire({
                    title: 'Good job!',
                    text: 'Report has been approved successfully',
                    icon: 'success'
                    }).then((result) => {
                        window.location.href = 'index.php?page=list';
                    });
                </script>";
        } else {
            header("Location: /index.php?page=list");
            exit();
        }
    }

    if ($_GET['page'] == "logout") {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/auth.php");
        logout();
    }
    // include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/create-report.php');
    // include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/reports.php');
    ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php");
?>
</body>

</html>