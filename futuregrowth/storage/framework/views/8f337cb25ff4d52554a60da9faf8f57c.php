<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(setting('seo_meta_title', setting('site_name', config('app.name', 'FutureGrowth.tech')))); ?></title>
    <meta name="description" content="<?php echo e(setting('seo_meta_description', 'Intelligent USDT Automated ROI Platform')); ?>">
    <?php if(setting('site_og_image')): ?>
        <meta property="og:image" content="<?php echo e(Storage::url(setting('site_og_image'))); ?>">
    <?php endif; ?>
    <!-- Favicon -->
    <?php if(setting('site_favicon')): ?>
        <link rel="icon" href="<?php echo e(Storage::url(setting('site_favicon'))); ?>">
    <?php endif; ?>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #10b981; /* Emerald Green Primary */
            --primary-glow: rgba(16, 185, 129, 0.45);
            --accent-orange: #f97316; /* Warm Orange Accent */
            --accent-orange-glow: rgba(249, 115, 22, 0.45);
            --bg-dark: #070b14; /* Deep rich dashboard background */
            --card-bg: rgba(15, 23, 42, 0.78); /* Sleek slate glassmorphism */
            --text-muted: #cbd5e1;
            --glass-border: rgba(255, 255, 255, 0.12);
            --neon-green: #10b981;
            --neon-purple: #8b5cf6;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 15% 30%, rgba(16, 185, 129, 0.08), transparent 30%),
                radial-gradient(circle at 85% 20%, rgba(249, 115, 22, 0.06), transparent 25%);
            background-attachment: fixed;
            color: #f8fafc;
            overflow-x: hidden;
            padding-bottom: 70px; /* Space for mobile nav */
        }
        
        /* Premium Glassmorphism */
        .glass-card {
            background-color: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.03), transparent);
            transform: skewX(-20deg);
            transition: 0.5s;
        }
        .glass-card:hover::before {
            left: 150%;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255,255,255,0.15);
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.4), 0 0 15px rgba(59, 130, 246, 0.1);
        }

        /* Neon Glows */
        .neon-glow-primary { box-shadow: 0 0 15px var(--primary-glow); }
        .neon-glow-success { box-shadow: 0 0 15px rgba(16, 185, 129, 0.4); }
        .neon-border-primary { border: 1px solid var(--primary-color) !important; }

        /* Animated Buttons */
        .btn-premium {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.3s ease;
        }
        .btn-premium::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            z-index: -1;
            transition: opacity 0.3s ease;
            opacity: 0;
        }
        .btn-premium:hover::after { opacity: 1; }
        .btn-premium:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
            color: #fff;
        }
        .btn-pulse { animation: pulse 2s infinite; }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        /* Gradients */
        .text-gradient {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Tech Background Animations */
        .tech-bg-container { position: relative; overflow: hidden; z-index: 1; }
        .tech-grid-overlay {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 20px 20px; z-index: -1; opacity: 0.3; animation: grid-move 20s linear infinite;
        }
        .tech-data-stream {
            position: absolute; top: -100%; left: 50%; width: 2px; height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(16, 185, 129, 0.8), transparent);
            animation: data-drop 3s linear infinite; z-index: -1;
        }
        .tech-data-stream-2 { left: 20%; animation-delay: 1s; animation-duration: 4s; }
        .tech-data-stream-3 { left: 80%; animation-delay: 2s; animation-duration: 2.5s; }
        @keyframes grid-move { 0% { transform: translateY(0); } 100% { transform: translateY(20px); } }
        @keyframes data-drop { 0% { top: -100px; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: 100%; opacity: 0; } }
        
        
        /* Navbar */
        .navbar-premium {
            background: rgba(9, 9, 11, 0.8) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
        }

        /* Mobile Nav */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: rgba(24, 24, 27, 0.9);
            backdrop-filter: blur(15px);
            border-top: 1px solid var(--glass-border);
            z-index: 1030;
            padding: 0.5rem 0;
        }
        .mobile-nav-item {
            text-align: center;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.75rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.2s;
        }
        .mobile-nav-item i { font-size: 1.25rem; margin-bottom: 2px; }
        .mobile-nav-item.active { color: var(--primary-color); }
        @media (max-width: 991px) {
            .mobile-bottom-nav { display: flex; justify-content: space-around; }
            .navbar-desktop-links { display: none !important; }
            body { padding-bottom: 80px; }
        }

        /* Help FAB Widget */
        .support-fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.5);
            cursor: pointer;
            z-index: 1040;
            transition: transform 0.3s;
        }
        .support-fab:hover { transform: scale(1.1) rotate(10deg); }
        @media (max-width: 991px) { .support-fab { bottom: 80px; right: 15px; } }

        /* WhatsApp Button */
        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
            color: white;
        }
        .whatsapp-glow {
            animation: whatsapp-pulse 2s infinite;
        }
        @keyframes whatsapp-pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        /* Toast positioning */
        .toast-container { z-index: 1050; }
    </style>
</head>
<body>
    <?php if(setting('announcement_bar')): ?>
        <div class="bg-warning text-dark py-2 fw-bold small" style="letter-spacing: 0.5px; z-index: 1040; position: relative; overflow: hidden; height: 38px;">
            <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();" style="vertical-align: middle;">
                <i class="bi bi-megaphone-fill me-2"></i> <?php echo e(setting('announcement_bar')); ?>

            </marquee>
        </div>
    <?php endif; ?>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-premium sticky-top">
        <div class="container">
            <a class="navbar-brand fs-4" href="<?php echo e(request()->routeIs('admin.*') ? route('admin.dashboard') : route('dashboard')); ?>">
                <?php if(request()->routeIs('admin.*')): ?>
                    <i class="bi bi-shield-check text-warning"></i> <span class="fw-bold text-warning">ADMIN</span><span class="fw-light text-muted">PANEL</span>
                <?php elseif(setting('site_logo')): ?>
                    <img src="<?php echo e(Storage::url(setting('site_logo'))); ?>" alt="<?php echo e(setting('site_name', 'Logo')); ?>" style="height: 35px;">
                <?php else: ?>
                    <i class="bi bi-layers-fill text-primary"></i> <span class="fw-bold">CRYPTO</span><span class="fw-light">INVEST</span>
                <?php endif; ?>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto navbar-desktop-links">
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(request()->routeIs('admin.*')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.users*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.users')); ?>"><i class="bi bi-people me-1"></i> Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.referrals*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.referrals')); ?>"><i class="bi bi-diagram-3 me-1"></i> Referrals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.salary*') ? 'active text-success fw-bold' : ''); ?>" href="<?php echo e(route('admin.salary')); ?>"><i class="bi bi-award me-1"></i> Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.deposits*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.deposits')); ?>"><i class="bi bi-arrow-down-circle me-1"></i> Deposits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.withdrawals*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.withdrawals')); ?>"><i class="bi bi-arrow-up-circle me-1"></i> Withdrawals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.plans*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.plans')); ?>"><i class="bi bi-box me-1"></i> Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.tickets*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.tickets')); ?>"><i class="bi bi-headset me-1"></i> Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.settings*') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('admin.settings')); ?>"><i class="bi bi-gear me-1"></i> Settings</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.profile') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.profile')); ?>">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.investments') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.investments')); ?>">Investments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.deposits') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.deposits')); ?>">Deposit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.withdrawals') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.withdrawals')); ?>">Withdraw</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.history') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.history')); ?>">Earnings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.team') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.team')); ?>">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.salary') ? 'active text-warning fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.salary')); ?>">
                                <i class="bi bi-award-fill text-warning me-1"></i> Salary
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#helpCenterModal">Support</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard.settings') ? 'active text-primary fw-bold' : ''); ?>" href="<?php echo e(route('dashboard.settings')); ?>">Settings</a>
                        </li>
                        <?php if(auth()->user()->is_admin): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-shield-lock me-1"></i> Admin Panel</a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item"><a href="<?php echo e(route('login')); ?>" class="nav-link fw-bold">Login</a></li>
                        <li class="nav-item"><a href="<?php echo e(route('register')); ?>" class="btn btn-premium ms-3">Get Started</a></li>
                    <?php else: ?>
                        <?php if(!request()->routeIs('admin.*')): ?>
                            <li class="nav-item me-2 d-none d-lg-block">
                                <a class="btn btn-outline-primary rounded-pill btn-sm px-3 fw-bold btn-pulse" href="#" onclick="copyToClipboard('<?php echo e(url('/register?ref='.auth()->user()->referral_code)); ?>', this)">
                                    <i class="bi bi-person-plus-fill"></i> Invite Friends
                                </a>
                            </li>
                            <?php if(setting('whatsapp_button_enabled', '1') && setting('whatsapp_community_link')): ?>
                                <li class="nav-item me-3 d-none d-lg-block">
                                    <a class="btn btn-whatsapp rounded-pill btn-sm px-3 fw-bold whatsapp-glow" href="<?php echo e(setting('whatsapp_community_link')); ?>" target="_blank">
                                        <i class="bi bi-whatsapp"></i> Community
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 rounded-pill neon-glow-primary bg-dark border border-secondary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" style="transition: 0.3s;">
                                <?php if(auth()->user()->avatar): ?>
                                    <img src="<?php echo e(Storage::url(auth()->user()->avatar)); ?>" class="rounded-circle shadow-sm" style="width: 32px; height: 32px; object-fit: cover;" alt="Avatar">
                                <?php else: ?>
                                    <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 32px; height: 32px; color: white; background: linear-gradient(135deg, #3b82f6, #8b5cf6);">
                                        <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                                    </div>
                                <?php endif; ?>
                                <span class="fw-bold text-white small"><?php echo e(auth()->user()->username ?? auth()->user()->name); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end glass-card border-primary border-opacity-50 shadow-lg rounded-4 mt-3 p-2" style="min-width: 260px; animation: slideDown 0.3s ease;">
                                <!-- User Status & Balance Preview -->
                                <?php if(request()->routeIs('admin.*')): ?>
                                    <li class="px-3 py-3 text-center border-bottom border-secondary border-opacity-25 mb-2 position-relative overflow-hidden rounded-3 bg-dark">
                                        <div class="tech-grid-overlay" style="opacity: 0.1;"></div>
                                        <div class="mb-2">
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3"><i class="bi bi-shield-check me-1"></i> Administrator</span>
                                        </div>
                                        <?php
                                            $headerPlatformTotal = \App\Models\Wallet::sum(\DB::raw('deposit_balance + roi_balance + referral_balance + bonus_balance'));
                                        ?>
                                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Platform Wallet Balance</small>
                                        <h4 class="text-warning fw-bold mb-0 mt-1">$<span class="text-gradient"><?php echo e(number_format($headerPlatformTotal, 2)); ?></span></h4>
                                    </li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('admin.dashboard')); ?>"><div class="bg-warning bg-opacity-10 p-2 rounded me-3"><i class="bi bi-speedometer2 text-warning"></i></div> <span class="fw-bold small">Admin Dashboard</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('admin.transactions')); ?>"><div class="bg-primary bg-opacity-10 p-2 rounded me-3"><i class="bi bi-journal-text text-primary"></i></div> <span class="fw-bold small">Global Ledger</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('admin.roi-history')); ?>"><div class="bg-info bg-opacity-10 p-2 rounded me-3"><i class="bi bi-graph-up text-info"></i></div> <span class="fw-bold small">ROI Distribution</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('admin.settings')); ?>"><div class="bg-secondary bg-opacity-10 p-2 rounded me-3"><i class="bi bi-gear text-light"></i></div> <span class="fw-bold small">Platform Settings</span></a></li>
                                <?php else: ?>
                                    <li class="px-3 py-3 text-center border-bottom border-secondary border-opacity-25 mb-2 position-relative overflow-hidden rounded-3 bg-dark">
                                        <div class="tech-grid-overlay" style="opacity: 0.1;"></div>
                                        <div class="mb-2">
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3"><i class="bi bi-shield-check me-1"></i> Active Account</span>
                                        </div>
                                        <?php
                                            $headerWallet = \App\Models\Wallet::where('user_id', auth()->id())->first();
                                            $headerTotal = $headerWallet ? ($headerWallet->deposit_balance + $headerWallet->roi_balance + $headerWallet->referral_balance + $headerWallet->bonus_balance + ($headerWallet->salary_balance ?? 0)) : 0;
                                        ?>
                                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Total Portfolio Value</small>
                                        <h4 class="text-white fw-bold mb-0 mt-1">$<span class="text-gradient"><?php echo e(number_format($headerTotal, 2)); ?></span></h4>
                                    </li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('dashboard.profile')); ?>"><div class="bg-primary bg-opacity-10 p-2 rounded me-3"><i class="bi bi-person-circle text-primary"></i></div> <span class="fw-bold small">My Profile</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('dashboard.settings')); ?>"><div class="bg-success bg-opacity-10 p-2 rounded me-3"><i class="bi bi-shield-lock text-success"></i></div> <span class="fw-bold small">Security Settings</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="<?php echo e(route('dashboard.team')); ?>"><div class="bg-info bg-opacity-10 p-2 rounded me-3"><i class="bi bi-people text-info"></i></div> <span class="fw-bold small">Referral Center</span></a></li>
                                    <li><a class="dropdown-item text-white rounded-3 py-2 custom-hover d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#helpCenterModal"><div class="bg-warning bg-opacity-10 p-2 rounded me-3"><i class="bi bi-headset text-warning"></i></div> <span class="fw-bold small">Support Center</span></a></li>
                                <?php endif; ?>
                                
                                <li><hr class="dropdown-divider border-secondary border-opacity-25 my-2"></li>
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger fw-bold rounded-3 py-2 custom-hover d-flex align-items-center"><div class="bg-danger bg-opacity-10 p-2 rounded me-3"><i class="bi bi-power text-danger"></i></div> <span class="small">Secure Logout</span></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Navigation (Auth Only) -->
    <?php if(auth()->guard()->check()): ?>
    <div class="mobile-bottom-nav">
        <a href="<?php echo e(route('dashboard')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-house-door-fill"></i>
            <span>Home</span>
        </a>
        <a href="<?php echo e(route('dashboard.investments')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard.investments') ? 'active' : ''); ?>">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Invest</span>
        </a>
        <a href="<?php echo e(route('dashboard.salary')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard.salary') ? 'active text-warning' : ''); ?>">
            <i class="bi bi-award-fill"></i>
            <span>Salary</span>
        </a>
        <a href="<?php echo e(route('dashboard.team')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard.team') ? 'active' : ''); ?>">
            <i class="bi bi-people-fill"></i>
            <span>Team</span>
        </a>
        <a href="<?php echo e(route('dashboard.history')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard.history') ? 'active' : ''); ?>">
            <i class="bi bi-cash-stack"></i>
            <span>Earnings</span>
        </a>
        <?php if(setting('whatsapp_button_enabled', '1') && setting('whatsapp_community_link')): ?>
        <a href="<?php echo e(setting('whatsapp_community_link')); ?>" target="_blank" class="mobile-nav-item text-success">
            <i class="bi bi-whatsapp"></i>
            <span>Community</span>
        </a>
        <?php endif; ?>
        <a href="<?php echo e(route('dashboard.profile')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('dashboard.profile') ? 'active' : ''); ?>">
            <i class="bi bi-person-circle"></i>
            <span>Profile</span>
        </a>
    </div>

    <!-- Removed Mobile Profile Modal in favor of direct routing to Profile Page -->
    <?php endif; ?>

    <main class="container py-4">
        <!-- Dynamic WhatsApp Community Banner -->
        <?php if(auth()->guard()->check()): ?>
            <?php if(setting('enable_whatsapp_banner', 1) == 1 && setting('whatsapp_community_link')): ?>
                <div class="whatsapp-sticky-banner py-3 px-4 mb-4 glass-card border-success border-opacity-25" style="background: rgba(37, 211, 102, 0.04); position: relative; overflow: hidden; border-radius: 1rem; border-color: rgba(37, 211, 102, 0.25) !important;">
                    <div class="tech-grid-overlay" style="opacity: 0.05;"></div>
                    <div class="row align-items-center g-3">
                        <div class="col-md-9 d-flex align-items-start gap-3">
                            <div class="bg-success bg-opacity-15 p-3 rounded-circle text-success shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; flex-shrink: 0; animation: whatsapp-pulse 2s infinite;">
                                <i class="bi bi-whatsapp fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-success d-flex align-items-center gap-2">
                                    💬 <?php echo e(setting('whatsapp_banner_title', 'Join our Official WhatsApp Community')); ?>

                                </h6>
                                <p class="text-muted small mb-0">
                                    <?php echo e(setting('whatsapp_banner_text', 'Stay updated with announcements, deposit confirmations, promotions, support, investment news.')); ?>

                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 text-md-end">
                            <a href="<?php echo e(setting('whatsapp_community_link')); ?>" target="_blank" class="btn btn-whatsapp rounded-pill px-4 fw-bold shadow-lg whatsapp-glow">
                                <i class="bi bi-whatsapp me-2"></i> <?php echo e(setting('whatsapp_button_text', 'Join WhatsApp Community')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Global Toasts for Success/Errors -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <?php if(session('success')): ?>
                <div class="toast show align-items-center text-white bg-success border-0" role="alert" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="toast show align-items-center text-white bg-danger border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Error: <?php echo e($errors->first()); ?>

                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="mt-auto py-4 bg-dark border-top border-secondary border-opacity-25 mt-5">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0 text-center text-md-start">
                    <?php if(setting('footer_logo')): ?>
                        <img src="<?php echo e(Storage::url(setting('footer_logo'))); ?>" alt="<?php echo e(setting('site_name', 'Logo')); ?>" style="max-height: 30px;" class="mb-2 d-block mx-auto mx-md-0">
                    <?php endif; ?>
                    <span class="text-muted small d-block">&copy; <?php echo e(date('Y')); ?> <?php echo e(setting('copyright_text', 'FutureGrowth.tech. All rights reserved.')); ?></span>
                    <?php if(setting('footer_text')): ?>
                        <p class="text-muted small mb-0 mt-1" style="max-width: 450px;"><?php echo e(setting('footer_text')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?php echo e(route('about')); ?>" class="text-muted small text-decoration-none me-3 hover-white">About Us</a>
                    <a href="<?php echo e(route('terms')); ?>" class="text-muted small text-decoration-none me-3 hover-white">Terms</a>
                    <a href="<?php echo e(route('privacy')); ?>" class="text-muted small text-decoration-none me-3 hover-white">Privacy</a>
                    <a href="<?php echo e(route('risk')); ?>" class="text-muted small text-decoration-none hover-white">Risk Disclosure</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Support FAB & Modal -->
    <div class="support-fab" data-bs-toggle="modal" data-bs-target="#helpCenterModal">
        <i class="bi bi-headset"></i>
    </div>

    <!-- Help Center Modal -->
    <div class="modal fade" id="helpCenterModal" tabindex="-1" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-card border-0">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-robot text-primary me-2"></i> Help Center</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <ul class="nav nav-pills mb-4 nav-fill" id="helpTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active bg-transparent border border-secondary text-white fw-bold custom-hover" id="faq-tab" data-bs-toggle="pill" data-bs-target="#faq" type="button" role="tab"><i class="bi bi-question-circle text-info me-2"></i> FAQ</button>
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link bg-transparent border border-secondary text-white fw-bold custom-hover" id="ticket-tab" data-bs-toggle="pill" data-bs-target="#ticket" type="button" role="tab"><i class="bi bi-envelope text-warning me-2"></i> Open Ticket</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bg-transparent border border-secondary text-white fw-bold custom-hover" id="guide-tab" data-bs-toggle="pill" data-bs-target="#guide" type="button" role="tab"><i class="bi bi-book text-success me-2"></i> Guide</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="helpTabContent">
                        <!-- FAQ Tab -->
                        <div class="tab-pane fade show active" id="faq" role="tabpanel">
                            <div class="accordion accordion-flush bg-transparent" id="faqAccordion">
                                <div class="accordion-item bg-transparent border-secondary border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                            How does the 3X Return work?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-muted small">Your active investments earn daily ROI up to a maximum of 300% (3X) of your initial deposit. Once it reaches 3X, the plan is marked as completed.</div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-transparent border-secondary border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                            How do team referrals work?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-muted small">You earn a percentage of deposits made by users you invite, spanning up to 10 levels deep based on the current platform rewards.</div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-transparent border-secondary">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                            When can I withdraw?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-muted small">Withdrawals can be requested anytime your ROI or Commission balance exceeds the minimum withdrawal amount of $<?php echo e(setting('min_withdrawal', 10)); ?>.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Tab -->
                        <div class="tab-pane fade" id="ticket" role="tabpanel">
                            <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('dashboard.tickets.store')); ?>" method="POST" enctype="multipart/form-data" class="mb-4">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Subject</label>
                                    <select name="subject" class="form-select bg-dark border-secondary text-white" required>
                                        <option value="Deposit Issue">Deposit Issue</option>
                                        <option value="Withdrawal Issue">Withdrawal Issue</option>
                                        <option value="Investment / ROI Issue">Investment / ROI Issue</option>
                                        <option value="Referral / Team Issue">Referral / Team Issue</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Message</label>
                                    <textarea name="message" rows="3" class="form-control bg-dark border-secondary text-white" required placeholder="Describe your issue..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase fw-bold">Screenshot Attachment (Optional)</label>
                                    <input type="file" name="screenshot" class="form-control bg-dark border-secondary text-white" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-premium w-100 fw-bold">Submit Ticket</button>
                            </form>
                            
                            <hr class="border-secondary my-4">
                            <h6 class="fw-bold text-white mb-3"><i class="bi bi-clock-history text-info me-2"></i> My Previous Tickets</h6>
                            
                            <?php
                                $myTickets = \App\Models\SupportTicket::where('user_id', auth()->id())->latest()->take(5)->get();
                            ?>
                            
                            <div class="list-group list-group-flush rounded bg-transparent">
                                <?php $__empty_1 = true; $__currentLoopData = $myTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="list-group-item bg-dark border-secondary text-white mb-2 rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-info small"><?php echo e($t->subject); ?></span>
                                            <?php if($t->status === 'open'): ?>
                                                <span class="badge bg-warning text-dark">Open</span>
                                            <?php elseif($t->status === 'answered'): ?>
                                                <span class="badge bg-success">Answered</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Closed</span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="small text-muted mb-2"><strong>You:</strong> <?php echo e($t->message); ?></p>
                                        <?php if($t->screenshot_path): ?>
                                            <div class="mb-2">
                                                <a href="<?php echo e(Storage::url($t->screenshot_path)); ?>" target="_blank" class="small text-info text-decoration-none">
                                                    <i class="bi bi-image me-1"></i> View Screenshot
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($t->reply): ?>
                                            <div class="p-2 bg-success bg-opacity-10 border border-success border-opacity-25 rounded small text-white">
                                                <strong class="text-success">Support:</strong> <?php echo e($t->reply); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-center text-muted small py-3">No support tickets found.</div>
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                            <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning">
                                Please <a href="<?php echo e(route('login')); ?>" class="alert-link text-warning fw-bold">login</a> to submit a support ticket.
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Guide Tab -->
                        <div class="tab-pane fade" id="guide" role="tabpanel">
                            <div class="p-3 bg-dark border border-secondary rounded">
                                <h6 class="fw-bold text-white mb-2"><i class="bi bi-1-circle text-primary me-2"></i> Step 1: Deposit</h6>
                                <p class="text-muted small mb-3">Navigate to the Deposits page and transfer funds to the provided crypto address. Submit your TXID for admin approval.</p>
                                
                                <h6 class="fw-bold text-white mb-2"><i class="bi bi-2-circle text-success me-2"></i> Step 2: Invest</h6>
                                <p class="text-muted small mb-3">Go to the Investments page and choose a plan. Your deposit balance will be used to activate the plan.</p>
                                
                                <h6 class="fw-bold text-white mb-2"><i class="bi bi-3-circle text-warning me-2"></i> Step 3: Earn & Withdraw</h6>
                                <p class="text-muted small mb-0">ROI is distributed daily automatically. Request a withdrawal anytime from your available balance.</p>
                            </div>
                        </div>
                    </div>

                    <?php if(setting('whatsapp_button_enabled', '1') && setting('whatsapp_community_link')): ?>
                    <div class="mt-4 pt-4 border-top border-secondary text-center">
                        <p class="small text-muted mb-2">Need immediate live help?</p>
                        <a href="<?php echo e(setting('whatsapp_community_link')); ?>" target="_blank" class="btn btn-whatsapp rounded-pill px-4 fw-bold whatsapp-glow w-100">
                            <i class="bi bi-whatsapp"></i> Chat with Support on WhatsApp
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-hover:hover { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.2); transform: translateX(5px); }
        .custom-hover { transition: all 0.2s; }
    </style>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- CountUp JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.0/countUp.min.js"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Initialize AOS Animations
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Smart Copy function with Native Toast
        function copyToClipboard(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                // Show tiny success animation on button
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check2-all"></i> Copied!';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-premium', 'btn-outline-primary');
                
                // Native Toast Generation for UX
                const toastHtml = `
                    <div class="toast show align-items-center text-white bg-success border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body fw-bold"><i class="bi bi-link-45deg me-2"></i> Referral Link Copied Successfully!</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>`;
                document.querySelector('.toast-container').insertAdjacentHTML('beforeend', toastHtml);
                
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-premium');
                    // Remove toast after 3s
                    const toasts = document.querySelectorAll('.toast');
                    if(toasts.length > 0) toasts[toasts.length - 1].remove();
                }, 3000);
            });
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /app/applet/futuregrowth/resources/views/layouts/app.blade.php ENDPATH**/ ?>