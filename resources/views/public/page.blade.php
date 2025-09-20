<!DOCTYPE html>
<html lang="{{ isRTL() ? 'ar' : 'en' }}" dir="{{ isRTL() ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $link->slug }} - Links</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: {{ $link->button_color ?? '#3b82f6' }};
            --background-color: {{ $link->background_color ?? '#ffffff' }};
            --text-color: {{ $link->text_color ?? '#333333' }};
            --container-bg: {{ $link->container_background ?? '#ffffff' }};
            --container-border: {{ $link->container_border_color ?? '#e5e7eb' }};
            --container-border-width: {{ $link->container_border_width ?? 1 }}px;
            --container-radius: {{ $link->container_border_radius ?? 20 }}px;
            --container-opacity: {{ ($link->container_opacity ?? 95) / 100 }};
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ isRTL() ? "'Noto Sans Arabic', 'Arial'" : "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" }}, sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            position: relative;
            direction: {{ isRTL() ? 'rtl' : 'ltr' }};
            text-align: {{ isRTL() ? 'right' : 'center' }};
        }

        /* Language Switcher for Public Page */
        .language-switcher {
            position: fixed;
            top: 20px;
            {{ isRTL() ? 'left' : 'right' }}: 20px;
            z-index: 1000;
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .language-btn {
            padding: 0.4rem 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            min-width: 40px;
            text-align: center;
        }

        .language-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(255, 255, 255, 0.3);
            text-decoration: none;
        }

        .language-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        @if($link->background_filename && $link->use_background_image)
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ route('serve-upload', $link->background_filename) }}') center no-repeat;
            @if($link->background_style == 'cover')
            background-size: cover;
            @elseif($link->background_style == 'contain')
            background-size: contain;
            @elseif($link->background_style == 'repeat')
            background-repeat: repeat;
            background-size: auto;
            @else
            background-size: auto;
            background-position: center;
            @endif
            opacity: 1;
            z-index: -1;
        }
        @endif

        .container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 10;
            
            @if($link->use_container_styling && $link->background_filename && $link->use_background_image)
            background: rgba(
                {{ hexdec(substr($link->container_background ?? '#ffffff', 1, 2)) }}, 
                {{ hexdec(substr($link->container_background ?? '#ffffff', 3, 2)) }}, 
                {{ hexdec(substr($link->container_background ?? '#ffffff', 5, 2)) }}, 
                {{ ($link->container_opacity ?? 95) / 100 }}
            );
            border: var(--container-border-width) solid var(--container-border);
            border-radius: var(--container-radius);
            padding: 30px;
            margin-top: 20px;
            @if($link->container_shadow)
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            @endif
            @if($link->container_blur)
            backdrop-filter: blur(10px);
            @endif
            @endif
        }

        .profile {
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease-out;
        }

        .logo {
            @if($link->logo_size == 'small')
            width: 80px;
            height: 80px;
            @elseif($link->logo_size == 'large')
            width: 160px;
            height: 160px;
            @else
            width: 120px;
            height: 120px;
            @endif
            
            @if($link->logo_shape == 'square')
            border-radius: 8px;
            @elseif($link->logo_shape == 'rounded')
            border-radius: 20px;
            @else
            border-radius: 50%;
            @endif
            
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .profile-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary-color), #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-subtitle {
            font-size: 1.1rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
        }

        .btn-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 24px;
            background: linear-gradient(135deg, var(--primary-color), #667eea);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: visible;
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
            text-align: center;
            direction: {{ isRTL() ? 'rtl' : 'ltr' }};
        }

        /* Button Styles */
        @if($link->button_style == 'pill')
        .btn-link { border-radius: 50px; }
        @elseif($link->button_style == 'square')
        .btn-link { border-radius: 4px; }
        @else
        .btn-link { border-radius: 12px; }
        @endif

        /* PROMOTION BUTTON STYLES */
        .btn-link.promotion {
            opacity: 1 !important;
            animation: fadeInUp 0.6s ease-out forwards, promotionPulse 2s ease-in-out infinite !important;
            background: linear-gradient(135deg, #ff1744, #d50000) !important;
            border: 3px solid #ffeb3b !important;
            box-shadow: 0 0 20px rgba(255, 23, 68, 0.6), 0 4px 15px rgba(0, 0, 0, 0.3) !important;
            transform: scale(1.05) !important;
        }

        @keyframes promotionPulse {
            0% {
                box-shadow: 0 0 20px rgba(255, 23, 68, 0.6), 0 4px 15px rgba(0, 0, 0, 0.3);
                transform: scale(1.05);
            }
            50% {
                box-shadow: 0 0 30px rgba(255, 23, 68, 0.9), 0 6px 25px rgba(0, 0, 0, 0.4);
                transform: scale(1.08);
            }
            100% {
                box-shadow: 0 0 20px rgba(255, 23, 68, 0.6), 0 4px 15px rgba(0, 0, 0, 0.3);
                transform: scale(1.05);
            }
        }

        .btn-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            color: white;
        }

        .btn-link.promotion:hover {
            transform: scale(1.1) !important;
            box-shadow: 0 0 40px rgba(255, 23, 68, 1), 0 8px 30px rgba(0, 0, 0, 0.5) !important;
        }

        .discount-badge {
            position: absolute;
            top: -15px;
            {{ isRTL() ? 'left' : 'right' }}: -15px;
            background: linear-gradient(135deg, #ffeb3b, #ffc107);
            color: #d84315;
            font-size: 0.8rem;
            font-weight: 900;
            padding: 8px 12px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 100;
            animation: discountBounce 1.5s ease-in-out infinite;
            border: 2px solid white;
            min-width: 60px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        @keyframes discountBounce {
            0%, 100% {
                transform: translateY(0) rotate(-5deg);
            }
            50% {
                transform: translateY(-8px) rotate(5deg);
            }
        }

        .btn-link i {
            margin-{{ isRTL() ? 'left' : 'right' }}: 12px;
            font-size: 1.2rem;
            min-width: 20px;
        }

        .btn-link span {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button Animation Delays */
        .btn-link:nth-child(1) { animation-delay: 0.1s; }
        .btn-link:nth-child(2) { animation-delay: 0.2s; }
        .btn-link:nth-child(3) { animation-delay: 0.3s; }
        .btn-link:nth-child(4) { animation-delay: 0.4s; }
        .btn-link:nth-child(5) { animation-delay: 0.5s; }
        .btn-link:nth-child(6) { animation-delay: 0.6s; }
        .btn-link:nth-child(7) { animation-delay: 0.7s; }
        .btn-link:nth-child(8) { animation-delay: 0.8s; }
        .btn-link:nth-child(9) { animation-delay: 0.9s; }
        .btn-link:nth-child(n+10) { animation-delay: 1s; }

        .footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            opacity: 0.6;
            font-size: 0.875rem;
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        /* Mobile Optimizations */
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .language-switcher {
                top: 10px;
                {{ isRTL() ? 'left' : 'right' }}: 10px;
                padding: 0.4rem;
            }

            .language-btn {
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
                min-width: 35px;
            }

            .container {
                max-width: 100%;
                @if($link->use_container_styling && $link->background_filename && $link->use_background_image)
                padding: 20px;
                margin-top: 10px;
                @endif
            }

            .profile {
                margin-bottom: 30px;
            }

            .logo {
                @if($link->logo_size == 'small')
                width: 60px;
                height: 60px;
                @elseif($link->logo_size == 'large')
                width: 120px;
                height: 120px;
                @else
                width: 80px;
                height: 80px;
                @endif
            }

            .profile-title {
                font-size: 1.75rem;
            }

            .profile-subtitle {
                font-size: 1rem;
            }

            .btn-link {
                padding: 16px 20px;
                font-size: 0.95rem;
            }

            .btn-link i {
                margin-{{ isRTL() ? 'left' : 'right' }}: 10px;
                font-size: 1.1rem;
            }

            .buttons-container {
                gap: 14px;
            }

            .discount-badge {
                top: -12px;
                {{ isRTL() ? 'left' : 'right' }}: -12px;
                font-size: 0.7rem;
                padding: 6px 10px;
                min-width: 50px;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 10px;
            }

            .btn-link {
                padding: 14px 16px;
                font-size: 0.9rem;
            }

            .buttons-container {
                gap: 12px;
            }
        }

        .btn-link:focus {
            outline: 3px solid rgba(66, 153, 225, 0.6);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* RTL specific adjustments */
        .rtl .btn-link {
            direction: rtl;
            text-align: center;
        }

        .rtl .btn-link i {
            margin-left: 12px;
            margin-right: 0;
        }

        /* Enhanced Arabic typography */
        .rtl {
            font-family: 'Noto Sans Arabic', 'Arial', sans-serif;
            line-height: 1.8;
        }

        .rtl .profile-title {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .rtl .btn-link {
            font-weight: 500;
            letter-spacing: 0.3px;
        }
    </style>
</head>

<body class="{{ isRTL() ? 'rtl' : '' }}">
    <!-- Language Switcher -->
    <div class="language-switcher">
        <a href="{{ route('language.switch', 'en') }}?redirect={{ urlencode(request()->fullUrl()) }}" 
           class="language-btn {{ !isRTL() ? 'active' : '' }}">
            EN
        </a>
        <a href="{{ route('language.switch', 'ar') }}?redirect={{ urlencode(request()->fullUrl()) }}" 
           class="language-btn {{ isRTL() ? 'active' : '' }}">
            عربي
        </a>
    </div>

    <div class="container">
        <!-- Profile Section -->
        <div class="profile">
            @if($link->logo_filename)
                <img src="{{ route('serve-upload', $link->logo_filename) }}" 
                     alt="{{ $link->slug }} Logo" 
                     class="logo">
            @endif
            
            <h1 class="profile-title">{{ $link->slug }}</h1>
            <p class="profile-subtitle">{{ t('welcome_to_links') }}</p>
        </div>

        <!-- Buttons Section -->
        <div class="buttons-container">
    @foreach($buttons as $btn)
        <a href="{{ route('track-click', $btn->id) }}" 
           class="btn-link{{ $btn->is_promotion ? ' promotion' : '' }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="{{ $btn->label }}">
            @if($btn->is_promotion && $btn->discount_label)
                <div class="discount-badge">{{ $btn->discount_label }}</div>
            @endif
            @if($btn->icon_class)
                <i class="{{ $btn->icon_class }}" aria-hidden="true"></i>
            @endif
            <span>
                @if($btn->is_promotion)
                    🔥 {{ $btn->label }} 🔥
                @else
                    {{-- Use current page language to translate preset button labels --}}
                    @if(in_array(strtolower($btn->label), ['instagram', 'facebook', 'twitter', 'youtube', 'tiktok', 'whatsapp', 'menu', 'location', 'website', 'phone', 'email', 'promotion']))
                        {{ t(strtolower($btn->label)) }}
                    @else
                        {{ $btn->label }}
                    @endif
                @endif
            </span>
        </a>
    @endforeach
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>{{ t('powered_by') }} <a href="#" target="_blank">NotifySmartLink</a></p>
        </div>
    </div>

    <script>
        // Add click feedback
        document.querySelectorAll('.btn-link').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255,255,255,0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Language switcher functionality
        document.querySelectorAll('.language-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Add loading state
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';
            });
        });

        // Add touch-friendly interactions for mobile
        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');
        }
    </script>
</body>
</html>