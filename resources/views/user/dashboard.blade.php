@extends('layouts.app')

@section('title', t('dashboard'))

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
        direction: {{ isRTL() ? 'rtl' : 'ltr' }};
    }

    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #f1f5f9;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8fafc;
    }

    .card-header h4 {
        margin: 0;
        color: #1e293b;
        font-weight: 700;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
    }

    .card-header i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem;
        color: #3b82f6;
        font-size: 1.25rem;
    }

    .analytics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .form-group label i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 0.5rem;
        color: #3b82f6;
    }

    .form-control {
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        background: white;
    }

    .color-input {
        width: 100%;
        height: 60px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
    }

    .range-input {
        width: 100%;
        margin: 0.5rem 0;
    }

    .range-value {
        display: inline-block;
        background: #3b82f6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-{{ isRTL() ? 'right' : 'left' }}: 0.5rem;
    }

    .file-input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 100px;
    }

    .file-input-label:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .file-input-label i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem;
        color: #3b82f6;
        font-size: 1.5rem;
    }

    .preview-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #e5e7eb;
        margin-top: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .style-selector {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .style-option {
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .style-option:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .style-option.active {
        border-color: #3b82f6;
        background: #3b82f6;
        color: white;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0.5rem 0;
    }

    .checkbox-group input[type="checkbox"] {
        transform: scale(1.2);
    }

    .checkbox-group label {
        margin: 0;
        font-weight: normal;
    }

    .container-section {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        padding: 2rem;
        border-radius: 16px;
        margin: 2rem 0;
        border: 2px solid #bae6fd;
    }

    .container-section h5 {
        color: #0c4a6e;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        font-size: 1.25rem;
    }

    .container-section h5 i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem;
        color: #0ea5e9;
    }

    .container-preview {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        padding: 2rem;
        border-radius: 16px;
        margin: 1.5rem 0;
        position: relative;
        overflow: hidden;
    }

    .container-preview::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23ddd"/></svg>');
        background-size: 20px 20px;
        opacity: 0.3;
    }

    .preview-container {
        position: relative;
        z-index: 2;
        max-width: 300px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }

    .button-form {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 2px solid #e2e8f0;
    }

    .button-form h5 {
        margin-bottom: 1.5rem;
        color: #1e293b;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .button-presets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .preset-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.25rem 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        min-height: 100px;
        justify-content: center;
    }

    .preset-button:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .preset-button.active {
        border-color: #3b82f6;
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
    }

    .preset-button i {
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .preset-button span {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .button-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .promotion-settings {
        display: none;
        margin: 1.5rem 0;
        padding: 1.5rem;
        background: #fee2e2;
        border: 2px solid #ef4444;
        border-radius: 12px;
    }

    .promotion-settings.show {
        display: block;
    }

    .promotion-settings h6 {
        color: #dc2626;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .buttons-list {
        display: grid;
        gap: 1rem;
        min-height: 100px;
        user-select: none;
    }

    .button-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        background: white;
        transition: all 0.3s ease;
        position: relative;
        user-select: none;
        cursor: grab;
        touch-action: none;
    }

    .button-item:hover {
        border-color: #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-1px);
    }

    .button-item.inactive {
        opacity: 0.6;
        background: #f8fafc;
    }

    .button-item.promotion-item {
        border: 3px solid #ff1744 !important;
        background: linear-gradient(135deg, #ffebee, #ffcdd2) !important;
        animation: promotionGlow 3s ease-in-out infinite;
    }

    .button-item.promotion-item::before {
        content: '🔥 {{ t('promotion') }} 🔥';
        position: absolute;
        top: -10px;
        {{ isRTL() ? 'right' : 'left' }}: 10px;
        background: linear-gradient(135deg, #ff1744, #d50000);
        color: white;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 12px;
        border-radius: 15px;
        z-index: 10;
    }

    .promotion-badge {
        background: linear-gradient(135deg, #ff1744, #d50000);
        color: white;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 10px;
        border-radius: 12px;
        margin-{{ isRTL() ? 'right' : 'left' }}: 0.5rem;
    }

    .discount-badge-small {
        background: linear-gradient(135deg, #ffeb3b, #ffc107);
        color: #d84315;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 10px;
        border-radius: 12px;
        margin-{{ isRTL() ? 'right' : 'left' }}: 0.5rem;
    }

    .drag-handle {
        color: #9ca3af;
        font-size: 1.25rem;
        margin-{{ isRTL() ? 'left' : 'right' }}: 1rem;
        cursor: grab;
        touch-action: none;
        transition: all 0.2s ease;
        padding: 0.5rem;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        position: relative;
    }

    .drag-handle:hover {
        color: #3b82f6;
        background: rgba(59, 130, 246, 0.1);
        transform: scale(1.1);
    }
    
    .drag-handle:active {
        cursor: grabbing;
    }

    .button-info {
        display: flex;
        align-items: center;
        flex: 1;
        pointer-events: none;
    }

    .button-info i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 1rem;
        font-size: 1.5rem;
        color: #3b82f6;
        min-width: 30px;
    }

    .button-details {
        flex: 1;
    }

    .button-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .button-url {
        color: #64748b;
        font-size: 0.875rem;
        word-break: break-all;
    }

    .button-stats {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .button-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-shrink: 0;
        pointer-events: auto;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-info {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .btn-info:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        text-decoration: none;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-toggle {
        background: #64748b;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }

    .btn-toggle:hover {
        background: #475569;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }

    .btn-edit:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .alert {
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid transparent;
        display: flex;
        align-items: center;
    }

    .alert i {
        margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem;
        font-size: 1.25rem;
    }

    .alert-info {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1e40af;
        border-color: #bfdbfe;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 2rem;
        border-radius: 16px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .modal-header h3 {
        margin: 0;
        color: #1e293b;
        font-weight: 700;
    }

    .close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #64748b;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .close:hover {
        background: #f1f5f9;
        color: #ef4444;
    }

    /* Sortable styles */
    .sortable-ghost {
        opacity: 0.3 !important;
        background: #f1f5f9 !important;
        border: 2px dashed #3b82f6 !important;
        transform: scale(0.95);
    }
    
    .sortable-chosen {
        cursor: grabbing !important;
        transform: scale(1.02);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
        z-index: 1000;
    }
    
    .sortable-drag {
        opacity: 0.8;
        transform: rotate(3deg) scale(1.02);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2) !important;
        z-index: 1001;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 0.75rem;
        }

        .card {
            padding: 1.5rem;
            border-radius: 12px;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-grid, .button-form-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .button-presets {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }

        .analytics-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .button-item {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
            padding: 1.25rem;
        }

        .drag-handle {
            position: absolute;
            top: 8px;
            {{ isRTL() ? 'left' : 'right' }}: 8px;
            margin: 0;
            min-width: 32px;
            height: 32px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 8px;
            color: #3b82f6;
        }

        .button-info {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .button-actions {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
            flex: 1;
            min-width: 80px;
            justify-content: center;
        }
    }

    /* RTL specific adjustments */
    .rtl .card-header i {
        margin-left: 0.75rem;
        margin-right: 0;
    }

    .rtl .form-group label i {
        margin-left: 0.5rem;
        margin-right: 0;
    }

    .rtl .file-input-label i {
        margin-left: 0.75rem;
        margin-right: 0;
    }

    .rtl .drag-handle {
        margin-left: 1rem;
        margin-right: 0;
    }

    .rtl .button-info i {
        margin-left: 1rem;
        margin-right: 0;
    }

    .rtl .alert i {
        margin-left: 0.75rem;
        margin-right: 0;
    }

    .rtl .promotion-badge,
    .rtl .discount-badge-small {
        margin-left: 0;
        margin-right: 0.5rem;
    }

    .rtl .range-value {
        margin-left: 0;
        margin-right: 0.5rem;
    }

    @keyframes promotionGlow {
        0%, 100% { box-shadow: 0 0 5px rgba(255, 23, 68, 0.5); }
        50% { box-shadow: 0 0 20px rgba(255, 23, 68, 0.8); }
    }
</style>

<div class="dashboard-container">
    @if(!$link)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <span>{{ t('contact_admin') }}</span>
        </div>
    @else
        <!-- Analytics Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-chart-line"></i>{{ t('analytics') }}</h4>
                <a href="{{ route('public.page', $link->slug) }}" class="btn btn-info" target="_blank">
                    <i class="fas fa-external-link-alt"></i>{{ t('view_page') }}
                </a>
            </div>
            
            <div class="analytics-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $link->visit_count ?? 0 }}</div>
                    <div class="stat-label">{{ t('total_visits') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $link->buttons->count() }}</div>
                    <div class="stat-label">{{ t('active_buttons') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $link->buttons->sum('click_count') ?? 0 }}</div>
                    <div class="stat-label">{{ t('total_clicks') }}</div>
                </div>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-cog"></i>{{ t('customize_page') }}</h4>
            </div>
            
            <form method="POST" action="{{ route('user.update-settings') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Profile & Logo Section -->
                <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #e2e8f0;">
                    <h5 style="color: #1e293b; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-user-circle" style="margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem; color: #3b82f6;"></i>{{ t('profile_logo') }}
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i>{{ t('choose_logo') }}</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="logo" class="file-input" accept="image/*">
                                <div class="file-input-label">
                                    <i class="fas fa-upload"></i>
                                    <span>{{ t('choose_logo') }}</span>
                                </div>
                            </div>
                            @if($link->logo_filename)
                                <img src="{{ route('serve-upload', $link->logo_filename) }}" class="preview-image" alt="{{ t('choose_logo') }}">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-shapes"></i>{{ t('logo_shape') }}</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'circle' ? 'active' : '' }}" data-logo-shape="circle">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('circle') }}</small>
                                </div>
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'rounded' ? 'active' : '' }}" data-logo-shape="rounded">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 12px; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('rounded') }}</small>
                                </div>
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'square' ? 'active' : '' }}" data-logo-shape="square">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 4px; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('square') }}</small>
                                </div>
                            </div>
                            <input type="hidden" name="logo_shape" id="logo_shape" value="{{ $link->logo_shape ?? 'circle' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-expand-arrows-alt"></i>{{ t('logo_size') }}</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'small' ? 'active' : '' }}" data-logo-size="small">
                                    <div style="width: 20px; height: 20px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('small') }}</small>
                                </div>
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'medium' ? 'active' : '' }}" data-logo-size="medium">
                                    <div style="width: 30px; height: 30px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('medium') }}</small>
                                </div>
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'large' ? 'active' : '' }}" data-logo-size="large">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('large') }}</small>
                                </div>
                            </div>
                            <input type="hidden" name="logo_size" id="logo_size" value="{{ $link->logo_size ?? 'medium' }}">
                        </div>
                    </div>
                </div>

                <!-- Button Styling Section -->
                <div style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #fbbf24;">
                    <h5 style="color: #92400e; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-mouse-pointer" style="margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem; color: #d97706;"></i>{{ t('button_styling') }}
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-shapes"></i>{{ t('button_style') }}</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'rounded' ? 'active' : '' }}" data-style="rounded">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 8px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('rounded') }}</small>
                                </div>
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'pill' ? 'active' : '' }}" data-style="pill">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 20px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('pill') }}</small>
                                </div>
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'square' ? 'active' : '' }}" data-style="square">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 2px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">{{ t('square') }}</small>
                                </div>
                            </div>
                            <input type="hidden" name="button_style" id="button_style" value="{{ $link->button_style ?? 'rounded' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-palette"></i>{{ t('button_color') }}</label>
                            <input type="color" name="button_color" class="color-input" value="{{ $link->button_color ?? '#3b82f6' }}">
                        </div>
                    </div>
                </div>

                <!-- Background & Colors Section -->
                <div style="background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #a5b4fc;">
                    <h5 style="color: #3730a3; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-paint-brush" style="margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem; color: #6366f1;"></i>{{ t('background_colors') }}
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i>{{ t('background_image') }}</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="background" class="file-input" accept="image/*">
                                <div class="file-input-label">
                                    <i class="fas fa-upload"></i>
                                    <span>{{ t('choose_background') }}</span>
                                </div>
                            </div>
                            @if($link->background_filename)
                                <img src="{{ route('serve-upload', $link->background_filename) }}" class="preview-image" alt="{{ t('background_image') }}">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-fill-drip"></i>{{ t('background_color') }}</label>
                            <input type="color" name="background_color" class="color-input" value="{{ $link->background_color ?? '#ffffff' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-font"></i>{{ t('text_color') }}</label>
                            <input type="color" name="text_color" class="color-input" value="{{ $link->text_color ?? '#333333' }}">
                        </div>
                        
                        <div class="form-group">
                            <label style="display: flex; align-items: center; font-weight: 600;">
                                <input type="checkbox" name="use_background_image" {{ $link->use_background_image ? 'checked' : '' }} style="margin-{{ isRTL() ? 'left' : 'right' }}: 0.5rem; transform: scale(1.3);">
                                {{ t('use_background_image') }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Container Settings Section -->
                <div class="container-section">
                    <h5><i class="fas fa-square"></i>{{ t('container_settings') }}</h5>
                    <p style="margin-bottom: 1.5rem; color: #64748b;">{{ t('enable_container_styling') }}</p>
                    
                    <div class="checkbox-group" style="margin-bottom: 2rem;">
                        <input type="checkbox" name="use_container_styling" id="use_container_styling" {{ $link->use_container_styling ? 'checked' : '' }}>
                        <label for="use_container_styling"><strong>{{ t('enable_container_styling') }}</strong></label>
                    </div>

                    <div class="form-grid" id="container-settings">
                        <div class="form-group">
                            <label><i class="fas fa-fill"></i>{{ t('container_background') }}</label>
                            <input type="color" name="container_background" class="color-input" value="{{ $link->container_background ?? '#ffffff' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-border-style"></i>{{ t('border_color') }}</label>
                            <input type="color" name="container_border_color" class="color-input" value="{{ $link->container_border_color ?? '#e5e7eb' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-border-style"></i>{{ t('border_width') }}</label>
                            <input type="range" name="container_border_width" class="range-input" min="0" max="5" value="{{ $link->container_border_width ?? 1 }}" id="borderWidth">
                            <span class="range-value" id="borderWidthValue">{{ $link->container_border_width ?? 1 }}px</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-square"></i>{{ t('border_radius') }}</label>
                            <input type="range" name="container_border_radius" class="range-input" min="0" max="50" value="{{ $link->container_border_radius ?? 20 }}" id="borderRadius">
                            <span class="range-value" id="borderRadiusValue">{{ $link->container_border_radius ?? 20 }}px</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-adjust"></i>{{ t('opacity') }}</label>
                            <input type="range" name="container_opacity" class="range-input" min="0" max="100" value="{{ $link->container_opacity ?? 95 }}" id="opacity">
                            <span class="range-value" id="opacityValue">{{ $link->container_opacity ?? 95 }}%</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-magic"></i>{{ t('effects') }}</label>
                            <div class="checkbox-group">
                                <input type="checkbox" name="container_shadow" id="container_shadow" {{ $link->container_shadow ? 'checked' : '' }}>
                                <label for="container_shadow">{{ t('drop_shadow') }}</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" name="container_blur" id="container_blur" {{ $link->container_blur ? 'checked' : '' }}>
                                <label for="container_blur">{{ t('backdrop_blur') }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- Live Preview -->
                    <div class="container-preview">
                        <div class="preview-container" id="previewContainer">
                            <div style="width: 60px; height: 60px; background: #3b82f6; border-radius: 50%; margin: 0 auto 1rem; border: 3px solid rgba(255,255,255,0.8);"></div>
                            <h3 style="margin: 0 0 0.5rem; font-size: 1.25rem;">{{ $link->slug }}</h3>
                            <p style="margin: 0 0 1.5rem; opacity: 0.8; font-size: 0.9rem;">{{ t('welcome_to_links') }}</p>
                            <div style="background: #3b82f6; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 10px; font-size: 0.9rem;">
                                <i class="fas fa-link" style="margin-{{ isRTL() ? 'left' : 'right' }}: 8px;"></i>{{ t('button_label') }}
                            </div>
                            <div style="background: #3b82f6; color: white; padding: 12px 20px; border-radius: 8px; font-size: 0.9rem;">
                                <i class="fas fa-star" style="margin-{{ isRTL() ? 'left' : 'right' }}: 8px;"></i>{{ t('button_label') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>{{ t('update_settings') }}
                </button>
            </form>
        </div>

        <!-- Buttons Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-link"></i>{{ t('manage_buttons') }}</h4>
            </div>
            
            <div class="button-form">
                <h5><i class="fas fa-plus"></i>{{ t('add_new_button') }}</h5>
                
                <div class="button-presets">
                    <div class="preset-button" data-label="{{ t('instagram') }}" data-icon="fab fa-instagram" data-url="https://instagram.com/">
                        <i class="fab fa-instagram"></i>
                        <span>{{ t('instagram') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('facebook') }}" data-icon="fab fa-facebook-f" data-url="https://facebook.com/">
                        <i class="fab fa-facebook-f"></i>
                        <span>{{ t('facebook') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('twitter') }}" data-icon="fab fa-twitter" data-url="https://twitter.com/">
                        <i class="fab fa-twitter"></i>
                        <span>{{ t('twitter') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('youtube') }}" data-icon="fab fa-youtube" data-url="https://youtube.com/">
                        <i class="fab fa-youtube"></i>
                        <span>{{ t('youtube') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('tiktok') }}" data-icon="fab fa-tiktok" data-url="https://tiktok.com/">
                        <i class="fab fa-tiktok"></i>
                        <span>{{ t('tiktok') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('whatsapp') }}" data-icon="fab fa-whatsapp" data-url="https://wa.me/">
                        <i class="fab fa-whatsapp"></i>
                        <span>{{ t('whatsapp') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('menu') }}" data-icon="fas fa-utensils" data-url="">
                        <i class="fas fa-utensils"></i>
                        <span>{{ t('menu') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('location') }}" data-icon="fas fa-map-marker-alt" data-url="https://maps.google.com/">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ t('location') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('website') }}" data-icon="fas fa-globe" data-url="https://">
                        <i class="fas fa-globe"></i>
                        <span>{{ t('website') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('phone') }}" data-icon="fas fa-phone" data-url="tel:">
                        <i class="fas fa-phone"></i>
                        <span>{{ t('phone') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('email') }}" data-icon="fas fa-envelope" data-url="mailto:">
                        <i class="fas fa-envelope"></i>
                        <span>{{ t('email') }}</span>
                    </div>
                    <div class="preset-button" data-label="{{ t('promotion') }}" data-icon="fas fa-percent" data-url="" data-promotion="true">
                        <i class="fas fa-percent"></i>
                        <span>{{ t('promotion') }}</span>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('user.add-button') }}" enctype="multipart/form-data" id="buttonForm">
                    @csrf
                    <div class="button-form-grid">
                        <div class="form-group">
                            <label>{{ t('button_label') }}</label>
                            <input type="text" name="label" class="form-control" id="labelInput" placeholder="{{ t('button_label') }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ t('url_link') }}</label>
                            <input type="url" name="url" class="form-control" id="urlInput" placeholder="https://example.com">
                        </div>
                        <div class="form-group">
                            <label>{{ t('upload_file') }}</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.gif">
                        </div>
                        <div class="form-group">
                            <label>{{ t('order') }}</label>
                            <input type="number" name="order" class="form-control" placeholder="0" value="0" min="0">
                        </div>
                    </div>
                    
                    <div class="promotion-settings" id="promotionSettings">
                        <h6><i class="fas fa-star"></i>{{ t('promotion_settings') }}</h6>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div class="form-group">
                                <label>{{ t('promotion_color') }}</label>
                                <input type="color" name="promotion_color" class="color-input" value="#ef4444" style="height: 50px;">
                            </div>
                            <div class="form-group">
                                <label>{{ t('discount_label') }}</label>
                                <input type="text" name="discount_label" class="form-control" placeholder="50% OFF" maxlength="15">
                            </div>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="is_promotion" id="isPromotionCheck" value="1" style="transform: scale(1.2);">
                            <label for="isPromotionCheck"><strong>{{ t('make_promotion') }}</strong></label>
                        </div>
                    </div>
                    
                    <input type="hidden" name="icon_class" id="iconInput">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>{{ t('add_button') }}
                    </button>
                </form>
            </div>
            
            @if($link->buttons->count() > 0)
                <div style="margin-bottom: 1rem;">
                    <p style="color: #64748b; font-size: 0.875rem;"><i class="fas fa-info-circle"></i> {{ t('drag_reorder') }}</p>
                </div>
                
                <div class="buttons-list" id="buttonsList">
                    @foreach($link->buttons as $button)
                        <div class="button-item {{ !$button->is_active ? 'inactive' : '' }}{{ $button->is_promotion ? ' promotion-item' : '' }}" 
                             data-button-id="{{ $button->id }}" tabindex="0">
                            <div class="drag-handle" title="{{ t('drag_reorder') }}">
                                <i class="fas fa-grip-vertical"></i>
                            </div>
                            <div class="button-info">
                                <i class="{{ $button->icon_class ?: 'fas fa-link' }}"></i>
                                <div class="button-details">
                                    <div class="button-label">
                                        {{ $button->label }}
                                        @if($button->is_promotion)
                                            <span class="promotion-badge">{{ t('promotion') }}</span>
                                        @endif
                                        @if($button->discount_label)
                                            <span class="discount-badge-small">{{ $button->discount_label }}</span>
                                        @endif
                                    </div>
                                    <div class="button-url">{{ $button->url ?: $button->file_filename }}</div>
                                    <div class="button-stats">{{ $button->click_count ?: 0 }} {{ t('clicks') }}</div>
                                </div>
                            </div>
                            <div class="button-actions">
                                <button class="btn btn-edit" onclick="editButton({{ $button->id }})">
                                    <i class="fas fa-edit"></i>{{ t('edit') }}
                                </button>
                                <form method="POST" action="{{ route('user.toggle-button', $button->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-toggle">
                                        @if($button->is_active)
                                            <i class="fas fa-eye-slash"></i>{{ t('hide') }}
                                        @else
                                            <i class="fas fa-eye"></i>{{ t('show') }}
                                        @endif
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('user.delete-button', $button->id) }}" style="display: inline;" onsubmit="return confirm('{{ t('order_error') }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>{{ t('delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span>{{ t('no_buttons') }}</span>
                </div>
            @endif
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i>{{ t('edit_button') }}</h3>
            <button class="close" onclick="closeEditModal()">&times;</button>
        </div>
        <form method="POST" id="editButtonForm" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>{{ t('button_label') }}</label>
                    <input type="text" name="label" class="form-control" id="editLabelInput" required>
                </div>
                <div class="form-group">
                    <label>{{ t('url_link') }}</label>
                    <input type="url" name="url" class="form-control" id="editUrlInput">
                </div>
                <div class="form-group">
                    <label>{{ t('icon_class') }}</label>
                    <input type="text" name="icon_class" class="form-control" id="editIconInput" placeholder="fas fa-link">
                </div>
                <div class="form-group">
                    <label>{{ t('order') }}</label>
                    <input type="number" name="order" class="form-control" id="editOrderInput" min="0">
                </div>
            </div>
            
            <div class="form-group">
                <label>{{ t('upload_new_file') }}</label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.gif">
            </div>
            
            <div class="promotion-settings" style="display: block; margin-top: 1.5rem;">
                <h6><i class="fas fa-star"></i>{{ t('promotion_settings') }}</h6>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>{{ t('promotion_color') }}</label>
                        <input type="color" name="promotion_color" id="editPromotionColorInput" class="color-input" value="#ef4444" style="height: 50px;">
                    </div>
                    <div class="form-group">
                        <label>{{ t('discount_label') }}</label>
                        <input type="text" name="discount_label" class="form-control" id="editDiscountLabelInput" placeholder="50% OFF" maxlength="15">
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="is_promotion" id="editIsPromotionCheck" style="transform: scale(1.2);">
                    <label for="editIsPromotionCheck"><strong>{{ t('make_promotion') }}</strong></label>
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                <button type="button" class="btn btn-toggle" onclick="closeEditModal()">{{ t('cancel') }}</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>{{ t('update_button') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preset buttons functionality
    const presetButtons = document.querySelectorAll('.preset-button');
    const labelInput = document.getElementById('labelInput');
    const iconInput = document.getElementById('iconInput');
    const urlInput = document.getElementById('urlInput');
    const promotionSettings = document.getElementById('promotionSettings');
    const isPromotionCheck = document.getElementById('isPromotionCheck');
    
    presetButtons.forEach(button => {
        button.addEventListener('click', function() {
            presetButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            labelInput.value = this.dataset.label;
            iconInput.value = this.dataset.icon;
            urlInput.value = this.dataset.url;
            
            if (this.dataset.promotion === 'true') {
                promotionSettings.classList.add('show');
                isPromotionCheck.checked = true;
                labelInput.value = '{{ t('special_offer') }}';
                document.querySelector('input[name="discount_label"]').value = '50% OFF';
            } else {
                promotionSettings.classList.remove('show');
                isPromotionCheck.checked = false;
            }
        });
    });
    
    // Promotion settings toggle
    if (isPromotionCheck) {
        isPromotionCheck.addEventListener('change', function() {
            if (this.checked) {
                promotionSettings.classList.add('show');
            } else {
                promotionSettings.classList.remove('show');
            }
        });
    }
    
    // Style selector functionality
    const styleOptions = document.querySelectorAll('.style-option');
    styleOptions.forEach(option => {
        option.addEventListener('click', function() {
            const parent = this.parentElement;
            parent.querySelectorAll('.style-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            if (this.dataset.style) {
                document.getElementById('button_style').value = this.dataset.style;
            }
            if (this.dataset.logoShape) {
                document.getElementById('logo_shape').value = this.dataset.logoShape;
            }
            if (this.dataset.logoSize) {
                document.getElementById('logo_size').value = this.dataset.logoSize;
            }
        });
    });
    
    // File input functionality
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(input => {
        const label = input.parentElement.querySelector('.file-input-label span');
        const originalText = label.textContent;
        
        input.addEventListener('change', function() {
            if (this.files.length > 0) {
                label.textContent = this.files[0].name;
            } else {
                label.textContent = originalText;
            }
        });
    });

    // Range input handlers
    const borderWidth = document.getElementById('borderWidth');
    const borderRadius = document.getElementById('borderRadius');
    const opacity = document.getElementById('opacity');

    if (borderWidth) {
        borderWidth.addEventListener('input', function() {
            document.getElementById('borderWidthValue').textContent = this.value + 'px';
        });
    }

    if (borderRadius) {
        borderRadius.addEventListener('input', function() {
            document.getElementById('borderRadiusValue').textContent = this.value + 'px';
        });
    }

    if (opacity) {
        opacity.addEventListener('input', function() {
            document.getElementById('opacityValue').textContent = this.value + '%';
        });
    }
    
    // Drag and drop functionality
    const buttonsList = document.getElementById('buttonsList');
    if (buttonsList && typeof Sortable !== 'undefined') {
        new Sortable(buttonsList, {
            animation: 300,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            forceFallback: false,
            fallbackTolerance: 3,
            scroll: true,
            scrollSensitivity: 30,
            scrollSpeed: 10,
            bubbleScroll: true,
            delay: 100,
            delayOnTouchStart: true,
            touchStartThreshold: 3,
            
            filter: '.btn, .button-actions, .button-actions *, form, input, button',
            
            onEnd: function(evt) {
                if (evt.oldIndex === evt.newIndex) return;
                
                const buttonIds = Array.from(buttonsList.children)
                    .map(item => item.dataset.buttonId)
                    .filter(id => id);
                
                updateButtonOrder(buttonIds);
            }
        });
    }
    
    // Edit button functionality
    window.editButton = function(buttonId) {
        const editModal = document.getElementById('editModal');
        editModal.style.display = 'block';
        
        fetch(`{{ url('user/edit-button') }}/${buttonId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editLabelInput').value = data.label || '';
            document.getElementById('editUrlInput').value = data.url || '';
            document.getElementById('editIconInput').value = data.icon_class || '';
            document.getElementById('editOrderInput').value = data.order || 0;
            document.getElementById('editPromotionColorInput').value = data.promotion_color || '#ef4444';
            document.getElementById('editDiscountLabelInput').value = data.discount_label || '';
            document.getElementById('editIsPromotionCheck').checked = data.is_promotion || false;
            
            document.getElementById('editButtonForm').action = `{{ url('user/edit-button') }}/${buttonId}`;
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('{{ t('order_error') }}', 'error');
        });
    };
    
    // Close modal functionality
    window.closeEditModal = function() {
        document.getElementById('editModal').style.display = 'none';
    };
    
    // Update button order
    function updateButtonOrder(buttonIds) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            showNotification('{{ t('order_error') }}', 'error');
            return;
        }
        
        showNotification('{{ t('updating_order') }}', 'info');
        
        fetch('/user/reorder-buttons', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ 
                button_ids: buttonIds 
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('{{ t('order_updated') }}', 'success');
            } else {
                throw new Error(data.message || '{{ t('order_error') }}');
            }
        })
        .catch(error => {
            console.error('Reorder error:', error);
            showNotification('{{ t('order_error') }}', 'error');
        });
    }
    
    // Notification system
    function showNotification(message, type = 'info') {
        const existing = document.querySelectorAll('.notification');
        existing.forEach(notif => notif.remove());
        
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            {{ isRTL() ? 'left' : 'right' }}: 20px;
            z-index: 9999;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: ${type === 'success' ? 'linear-gradient(135deg, #10b981, #059669)' : 
                        type === 'error' ? 'linear-gradient(135deg, #ef4444, #dc2626)' :
                        'linear-gradient(135deg, #3b82f6, #1d4ed8)'};
            transform: translateX({{ isRTL() ? '-' : '' }}100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 350px;
            word-wrap: break-word;
        `;
        
        notification.innerHTML = `
            <div style="display: flex; align-items: center;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                 type === 'error' ? 'exclamation-triangle' : 
                                 'info-circle'}" style="margin-{{ isRTL() ? 'left' : 'right' }}: 0.75rem; font-size: 1.25rem;"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            if (document.body.contains(notification)) {
                notification.style.transform = 'translateX({{ isRTL() ? '-' : '' }}100%)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }
        }, 4000);
        
        notification.addEventListener('click', () => {
            notification.style.transform = 'translateX({{ isRTL() ? '-' : '' }}100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        });
    }
    
    window.showNotification = showNotification;
    
    // Click outside modal to close
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});
</script>
@endsection