<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'BNGRC - Suivi des Dons' ?></title>
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5282;
            --secondary-color: #4a7c59;
            --accent-color: #c53030;
            --light-bg: #f7fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a365d 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 3px;
        }
        
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .nav-link.active {
            background-color: rgba(255,255,255,0.2) !important;
        }
        
        .sidebar {
            background: white;
            min-height: calc(100vh - 76px);
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }
        
        .sidebar .nav-link {
            color: #4a5568;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            margin: 2px 0;
            border-radius: 0;
        }
        
        .sidebar .nav-link:hover {
            background-color: #edf2f7;
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .sidebar .nav-link.active {
            background-color: #e2e8f0;
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        
        .main-content {
            padding: 25px;
        }
        
        .page-header {
            background: white;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
        }
        
        .page-header h2 {
            color: var(--primary-color);
            margin: 0;
            font-weight: 600;
        }
        
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a365d 100%);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary-custom {
            background: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background: #1a365d;
            transform: translateY(-1px);
        }
        
        .btn-success-custom {
            background: var(--secondary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-success-custom:hover {
            background: #3d6348;
            transform: translateY(-1px);
        }
        
        .btn-danger-custom {
            background: var(--accent-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-danger-custom:hover {
            background: #9b2c2c;
            transform: translateY(-1px);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            text-align: center;
        }
        
        .stat-card .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-card .stat-label {
            color: #718096;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table-custom {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .table-custom thead {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a365d 100%);
            color: white;
        }
        
        .table-custom th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .table-custom td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .badge-besoin {
            background: #ed8936;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .badge-don {
            background: var(--secondary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .badge-dispatch {
            background: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .progress-custom {
            height: 10px;
            border-radius: 5px;
            background: #e2e8f0;
        }
        
        .progress-custom .progress-bar {
            border-radius: 5px;
        }
        
        .form-control-custom {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control-custom:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.1);
        }
        
        .alert-custom {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }
        
        .footer-custom {
            background: #1a202c;
            color: #a0aec0;
            padding: 20px 0;
            margin-top: auto;
        }
        
        .ville-card {
            border-left: 4px solid var(--primary-color);
        }
        
        .region-badge {
            background: #edf2f7;
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/Header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse py-3">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                </svg>
                                Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'regions' ? 'active' : '' ?>" href="/regions">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                Régions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'villes' ? 'active' : '' ?>" href="/villes">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
                                    <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/>
                                </svg>
                                Villes
                            </a>
                        </li>
                        <hr class="my-2">
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'besoins' ? 'active' : '' ?>" href="/besoins">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                </svg>
                                Saisir Besoins
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'dons' ? 'active' : '' ?>" href="/dons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>
                                </svg>
                                Saisir Dons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPage ?? '') === 'dispatch' ? 'active' : '' ?>" href="/dispatch">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16" style="margin-right: 10px;">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
                                </svg>
                                Dispatch Dons
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <?php 
                // Charger le contenu de la page
                if (isset($pageContent) && file_exists($pageContent)) {
                    include $pageContent;
                } elseif (isset($content)) {
                    echo $content;
                }
                ?>
            </main>
        </div>
    </div>
    
    <?php include __DIR__ . '/Footer.php'; ?>
</body>
</html>
