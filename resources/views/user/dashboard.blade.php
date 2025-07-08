@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
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
        margin-right: 0.75rem;
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
        margin-right: 0.5rem;
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
        margin-left: 0.5rem;
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
        margin-right: 0.75rem;
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
        margin-right: 0.75rem;
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
        content: '🔥 PROMOTION 🔥';
        position: absolute;
        top: -10px;
        left: 10px;
        background: linear-gradient(135deg, #ff1744, #d50000);
        color: white;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 12px;
        border-radius: 15px;
        z-index: 10;
    }

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
    
    body.dragging {
        cursor: grabbing !important;
    }
    
    body.dragging * {
        cursor: grabbing !important;
    }

    .promotion-badge {
        background: linear-gradient(135deg, #ff1744, #d50000);
        color: white;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 10px;
        border-radius: 12px;
        margin-left: 0.5rem;
    }

    .discount-badge-small {
        background: linear-gradient(135deg, #ffeb3b, #ffc107);
        color: #d84315;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 4px 10px;
        border-radius: 12px;
        margin-left: 0.5rem;
    }

    .drag-handle {
        color: #9ca3af;
        font-size: 1.25rem;
        margin-right: 1rem;
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
    
    .sortable-fallback {
        opacity: 0.8;
        background: white !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
        border: 2px solid #3b82f6 !important;
        transform: rotate(5deg);
        z-index: 1000;
    }

    .button-info {
        display: flex;
        align-items: center;
        flex: 1;
        pointer-events: none;
    }

    .button-info i {
        margin-right: 1rem;
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
        margin-right: 0.75rem;
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

    /* Enhanced Mobile Responsive Styles */
    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }
        
        .button-form-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }
        
        .button-presets {
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        }
    }

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

        .card-header h4 {
            font-size: 1.25rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .button-form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .style-selector {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }

        .style-option {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }

        .button-presets {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }

        .preset-button {
            padding: 1rem 0.5rem;
            min-height: 80px;
        }

        .preset-button i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .preset-button span {
            font-size: 0.75rem;
        }

        .analytics-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .stat-number {
            font-size: 1.75rem;
        }

        .button-item {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
            padding: 1.25rem;
            cursor: grab;
        }

        .button-item:active {
            cursor: grabbing;
        }

        .drag-handle {
            position: absolute;
            top: 8px;
            right: 8px;
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
            pointer-events: none;
        }

        .button-actions {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 0.5rem;
            pointer-events: auto;
        }

        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
            flex: 1;
            min-width: 80px;
            justify-content: center;
        }

        .form-control {
            padding: 0.875rem;
            font-size: 16px; /* Prevents zoom on iOS */
        }

        .color-input {
            height: 50px;
        }

        .file-input-label {
            padding: 1rem;
            min-height: 80px;
        }

        .preview-image {
            width: 100px;
            height: 100px;
        }

        .container-section, .button-form {
            padding: 1.5rem;
        }

        .modal-content {
            margin: 2% auto;
            padding: 1.5rem;
            width: 95%;
            max-height: 95vh;
            overflow-y: auto;
        }

        .promotion-settings {
            padding: 1rem;
        }

        /* Touch-friendly drag indicators */
        .button-item::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 8px;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: repeating-linear-gradient(
                to bottom,
                #d1d5db 0px,
                #d1d5db 2px,
                transparent 2px,
                transparent 4px
            );
            border-radius: 2px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 0.5rem;
        }

        .card {
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-header h4 {
            font-size: 1.125rem;
        }

        .card-header i {
            font-size: 1rem;
            margin-right: 0.5rem;
        }

        .analytics-grid {
            gap: 0.75rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .stat-label {
            font-size: 0.8rem;
        }

        .button-presets {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .preset-button {
            padding: 0.75rem 0.25rem;
            min-height: 70px;
        }

        .preset-button i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .preset-button span {
            font-size: 0.7rem;
        }

        .button-item {
            padding: 1rem;
        }

        .button-label {
            font-size: 1rem;
        }

        .button-url {
            font-size: 0.8rem;
        }

        .btn {
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
            min-width: 70px;
        }

        .drag-handle {
            min-width: 28px;
            height: 28px;
            top: 6px;
            right: 6px;
        }

        .form-control {
            padding: 0.75rem;
        }

        .style-option {
            padding: 0.5rem 0.25rem;
        }

        .container-section, .button-form {
            padding: 1rem;
        }

        .promotion-settings {
            padding: 0.75rem;
        }

        .modal-content {
            padding: 1rem;
            width: 98%;
        }

        /* Smaller touch targets adjustment */
        .checkbox-group input[type="checkbox"] {
            transform: scale(1.5);
            margin-right: 0.5rem;
        }

        .range-input {
            height: 40px;
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .button-item {
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
        }

        .button-item:active {
            cursor: grabbing;
        }

        .drag-handle {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .preset-button:hover,
        .style-option:hover,
        .btn:hover {
            transform: none;
        }

        .preset-button:active,
        .style-option:active {
            transform: scale(0.95);
        }

        .btn:active {
            transform: scale(0.95);
        }
    }

    /* High DPI displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .preview-image {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }
    }

    /* Landscape mobile optimizations */
    @media (max-width: 768px) and (orientation: landscape) {
        .analytics-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .button-presets {
            grid-template-columns: repeat(6, 1fr);
        }

        .style-selector {
            grid-template-columns: repeat(3, 1fr);
        }

        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }
    }

    /* Animation keyframes */
    @keyframes promotionGlow {
        0%, 100% { box-shadow: 0 0 5px rgba(255, 23, 68, 0.5); }
        50% { box-shadow: 0 0 20px rgba(255, 23, 68, 0.8); }
    }

    /* Sortable specific enhancements */
    .sortable-ghost {
        opacity: 0.4;
        background: #f1f5f9 !important;
        transform: rotate(2deg) scale(0.95);
        border: 2px dashed #3b82f6 !important;
    }
    
    .sortable-chosen {
        cursor: grabbing !important;
        z-index: 1000;
        transform: scale(1.02);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
    }
    
    .sortable-drag {
        opacity: 0.9;
        transform: rotate(5deg) scale(1.05);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3) !important;
        z-index: 1001;
    }

    /* Focus states for accessibility */
    .button-item:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    .btn:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    /* Loading states */
    .loading {
        opacity: 0.6;
        pointer-events: none;
        position: relative;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid #3b82f6;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="dashboard-container">
    @if(!$link)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <span>Contact your administrator to assign you a page slug to get started.</span>
        </div>
    @else
        <!-- Analytics Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-chart-line"></i>Analytics</h4>
                <a href="{{ route('public.page', $link->slug) }}" class="btn btn-info" target="_blank">
                    <i class="fas fa-external-link-alt"></i>View Page
                </a>
            </div>
            
            <div class="analytics-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $link->visit_count ?? 0 }}</div>
                    <div class="stat-label">Total Visits</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $link->buttons->count() }}</div>
                    <div class="stat-label">Active Buttons</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $link->total_clicks ?? 0 }}</div>
                    <div class="stat-label">Total Clicks</div>
                </div>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-cog"></i>Customize Your Page</h4>
            </div>
            
            <form method="POST" action="{{ route('user.update-settings') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Profile & Logo Section -->
                <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #e2e8f0;">
                    <h5 style="color: #1e293b; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-user-circle" style="margin-right: 0.75rem; color: #3b82f6;"></i>Profile & Logo
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i>Profile Logo</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="logo" class="file-input" accept="image/*">
                                <div class="file-input-label">
                                    <i class="fas fa-upload"></i>
                                    <span>Choose Logo Image</span>
                                </div>
                            </div>
                            @if($link->logo_filename)
                                <img src="{{ route('serve-upload', $link->logo_filename) }}" class="preview-image" alt="Current Logo">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-shapes"></i>Logo Shape</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'circle' ? 'active' : '' }}" data-logo-shape="circle">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Circle</small>
                                </div>
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'rounded' ? 'active' : '' }}" data-logo-shape="rounded">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 12px; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Rounded</small>
                                </div>
                                <div class="style-option {{ ($link->logo_shape ?? 'circle') == 'square' ? 'active' : '' }}" data-logo-shape="square">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 4px; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Square</small>
                                </div>
                            </div>
                            <input type="hidden" name="logo_shape" id="logo_shape" value="{{ $link->logo_shape ?? 'circle' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-expand-arrows-alt"></i>Logo Size</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'small' ? 'active' : '' }}" data-logo-size="small">
                                    <div style="width: 20px; height: 20px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Small</small>
                                </div>
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'medium' ? 'active' : '' }}" data-logo-size="medium">
                                    <div style="width: 30px; height: 30px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Medium</small>
                                </div>
                                <div class="style-option {{ ($link->logo_size ?? 'medium') == 'large' ? 'active' : '' }}" data-logo-size="large">
                                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; margin: 0 auto;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Large</small>
                                </div>
                            </div>
                            <input type="hidden" name="logo_size" id="logo_size" value="{{ $link->logo_size ?? 'medium' }}">
                        </div>
                    </div>
                </div>

                <!-- Button Styling Section -->
                <div style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #fbbf24;">
                    <h5 style="color: #92400e; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-mouse-pointer" style="margin-right: 0.75rem; color: #d97706;"></i>Button Styling
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-shapes"></i>Button Style</label>
                            <div class="style-selector">
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'rounded' ? 'active' : '' }}" data-style="rounded">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 8px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Rounded</small>
                                </div>
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'pill' ? 'active' : '' }}" data-style="pill">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 20px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Pill</small>
                                </div>
                                <div class="style-option {{ ($link->button_style ?? 'rounded') == 'square' ? 'active' : '' }}" data-style="square">
                                    <div style="width: 100%; height: 20px; background: #3b82f6; border-radius: 2px;"></div>
                                    <small style="margin-top: 0.5rem; display: block;">Square</small>
                                </div>
                            </div>
                            <input type="hidden" name="button_style" id="button_style" value="{{ $link->button_style ?? 'rounded' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-palette"></i>Button Color</label>
                            <input type="color" name="button_color" class="color-input" value="{{ $link->button_color ?? '#3b82f6' }}">
                        </div>
                    </div>
                </div>

                <!-- Background & Colors Section -->
                <div style="background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 2px solid #a5b4fc;">
                    <h5 style="color: #3730a3; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; font-size: 1.25rem;">
                        <i class="fas fa-paint-brush" style="margin-right: 0.75rem; color: #6366f1;"></i>Background & Colors
                    </h5>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i>Background Image</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="background" class="file-input" accept="image/*">
                                <div class="file-input-label">
                                    <i class="fas fa-upload"></i>
                                    <span>Choose Background</span>
                                </div>
                            </div>
                            @if($link->background_filename)
                                <img src="{{ route('serve-upload', $link->background_filename) }}" class="preview-image" alt="Current Background">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-fill-drip"></i>Background Color</label>
                            <input type="color" name="background_color" class="color-input" value="{{ $link->background_color ?? '#ffffff' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-font"></i>Text Color</label>
                            <input type="color" name="text_color" class="color-input" value="{{ $link->text_color ?? '#333333' }}">
                        </div>
                        
                        <div class="form-group">
                            <label style="display: flex; align-items: center; font-weight: 600;">
                                <input type="checkbox" name="use_background_image" {{ $link->use_background_image ? 'checked' : '' }} style="margin-right: 0.5rem; transform: scale(1.3);">
                                Use background image instead of color
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Container Settings Section -->
                <div class="container-section">
                    <h5><i class="fas fa-square"></i>Container Settings</h5>
                    <p style="margin-bottom: 1.5rem; color: #64748b;">Configure how the button container appears when using background images</p>
                    
                    <div class="checkbox-group" style="margin-bottom: 2rem;">
                        <input type="checkbox" name="use_container_styling" id="use_container_styling" {{ $link->use_container_styling ? 'checked' : '' }}>
                        <label for="use_container_styling"><strong>Enable container styling (recommended for background images)</strong></label>
                    </div>

                    <div class="form-grid" id="container-settings">
                        <div class="form-group">
                            <label><i class="fas fa-fill"></i>Container Background</label>
                            <input type="color" name="container_background" class="color-input" value="{{ $link->container_background ?? '#ffffff' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-border-style"></i>Border Color</label>
                            <input type="color" name="container_border_color" class="color-input" value="{{ $link->container_border_color ?? '#e5e7eb' }}">
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-border-style"></i>Border Width</label>
                            <input type="range" name="container_border_width" class="range-input" min="0" max="5" value="{{ $link->container_border_width ?? 1 }}" id="borderWidth">
                            <span class="range-value" id="borderWidthValue">{{ $link->container_border_width ?? 1 }}px</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-square"></i>Border Radius</label>
                            <input type="range" name="container_border_radius" class="range-input" min="0" max="50" value="{{ $link->container_border_radius ?? 20 }}" id="borderRadius">
                            <span class="range-value" id="borderRadiusValue">{{ $link->container_border_radius ?? 20 }}px</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-adjust"></i>Opacity</label>
                            <input type="range" name="container_opacity" class="range-input" min="0" max="100" value="{{ $link->container_opacity ?? 95 }}" id="opacity">
                            <span class="range-value" id="opacityValue">{{ $link->container_opacity ?? 95 }}%</span>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-magic"></i>Effects</label>
                            <div class="checkbox-group">
                                <input type="checkbox" name="container_shadow" id="container_shadow" {{ $link->container_shadow ? 'checked' : '' }}>
                                <label for="container_shadow">Drop shadow</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" name="container_blur" id="container_blur" {{ $link->container_blur ? 'checked' : '' }}>
                                <label for="container_blur">Backdrop blur</label>
                            </div>
                        </div>
                    </div>

                    <!-- Live Preview -->
                    <div class="container-preview">
                        <div class="preview-container" id="previewContainer">
                            <div style="width: 60px; height: 60px; background: #3b82f6; border-radius: 50%; margin: 0 auto 1rem; border: 3px solid rgba(255,255,255,0.8);"></div>
                            <h3 style="margin: 0 0 0.5rem; font-size: 1.25rem;">{{ $link->slug }}</h3>
                            <p style="margin: 0 0 1.5rem; opacity: 0.8; font-size: 0.9rem;">Welcome to my links</p>
                            <div style="background: #3b82f6; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 10px; font-size: 0.9rem;">
                                <i class="fas fa-link" style="margin-right: 8px;"></i>Sample Button
                            </div>
                            <div style="background: #3b82f6; color: white; padding: 12px 20px; border-radius: 8px; font-size: 0.9rem;">
                                <i class="fas fa-star" style="margin-right: 8px;"></i>Another Button
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>Update Settings
                </button>
            </form>
        </div>

        <!-- Buttons Card -->
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-link"></i>Manage Buttons</h4>
            </div>
            
            <div class="button-form">
                <h5><i class="fas fa-plus"></i>Add New Button</h5>
                
                <div class="button-presets">
                    <div class="preset-button" data-label="Instagram" data-icon="fab fa-instagram" data-url="https://instagram.com/">
                        <i class="fab fa-instagram"></i>
                        <span>Instagram</span>
                    </div>
                    <div class="preset-button" data-label="Facebook" data-icon="fab fa-facebook-f" data-url="https://facebook.com/">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </div>
                    <div class="preset-button" data-label="Twitter" data-icon="fab fa-twitter" data-url="https://twitter.com/">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </div>
                    <div class="preset-button" data-label="YouTube" data-icon="fab fa-youtube" data-url="https://youtube.com/">
                        <i class="fab fa-youtube"></i>
                        <span>YouTube</span>
                    </div>
                    <div class="preset-button" data-label="TikTok" data-icon="fab fa-tiktok" data-url="https://tiktok.com/">
                        <i class="fab fa-tiktok"></i>
                        <span>TikTok</span>
                    </div>
                    <div class="preset-button" data-label="WhatsApp" data-icon="fab fa-whatsapp" data-url="https://wa.me/">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </div>
                    <div class="preset-button" data-label="Menu" data-icon="fas fa-utensils" data-url="">
                        <i class="fas fa-utensils"></i>
                        <span>Menu</span>
                    </div>
                    <div class="preset-button" data-label="Location" data-icon="fas fa-map-marker-alt" data-url="https://maps.google.com/">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Location</span>
                    </div>
                    <div class="preset-button" data-label="Website" data-icon="fas fa-globe" data-url="https://">
                        <i class="fas fa-globe"></i>
                        <span>Website</span>
                    </div>
                    <div class="preset-button" data-label="Phone" data-icon="fas fa-phone" data-url="tel:">
                        <i class="fas fa-phone"></i>
                        <span>Phone</span>
                    </div>
                    <div class="preset-button" data-label="Email" data-icon="fas fa-envelope" data-url="mailto:">
                        <i class="fas fa-envelope"></i>
                        <span>Email</span>
                    </div>
                    <div class="preset-button" data-label="Promotion" data-icon="fas fa-percent" data-url="" data-promotion="true">
                        <i class="fas fa-percent"></i>
                        <span>Promotion</span>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('user.add-button') }}" enctype="multipart/form-data" id="buttonForm">
                    @csrf
                    <div class="button-form-grid">
                        <div class="form-group">
                            <label>Button Label</label>
                            <input type="text" name="label" class="form-control" id="labelInput" placeholder="Enter button text" required>
                        </div>
                        <div class="form-group">
                            <label>URL or Link</label>
                            <input type="url" name="url" class="form-control" id="urlInput" placeholder="https://example.com">
                        </div>
                        <div class="form-group">
                            <label>Upload File (Optional)</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.gif">
                        </div>
                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" placeholder="0" value="0" min="0">
                        </div>
                    </div>
                    
                    <div class="promotion-settings" id="promotionSettings">
                        <h6><i class="fas fa-star"></i>Promotion Settings</h6>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div class="form-group">
                                <label>Promotion Color</label>
                                <input type="color" name="promotion_color" class="color-input" value="#ef4444" style="height: 50px;">
                            </div>
                            <div class="form-group">
                                <label>Discount Label</label>
                                <input type="text" name="discount_label" class="form-control" placeholder="50% OFF" maxlength="15">
                            </div>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="is_promotion" id="isPromotionCheck" value="1" style="transform: scale(1.2);">
                            <label for="isPromotionCheck"><strong>✨ Make this a PROMOTION button ✨</strong></label>
                        </div>
                    </div>
                    
                    <input type="hidden" name="icon_class" id="iconInput">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>Add Button
                    </button>
                </form>
            </div>
            
            @if($link->buttons->count() > 0)
                <div style="margin-bottom: 1rem;">
                    <p style="color: #64748b; font-size: 0.875rem;"><i class="fas fa-info-circle"></i> Drag and drop buttons to reorder them</p>
                </div>
                
                <div class="buttons-list" id="buttonsList">
                    @foreach($link->buttons as $button)
                        <div class="button-item {{ !$button->is_active ? 'inactive' : '' }}{{ $button->is_promotion ? ' promotion-item' : '' }}" 
                             data-button-id="{{ $button->id }}" tabindex="0">
                            <div class="drag-handle" title="Drag to reorder">
                                <i class="fas fa-grip-vertical"></i>
                            </div>
                            <div class="button-info">
                                <i class="{{ $button->icon_class ?: 'fas fa-link' }}"></i>
                                <div class="button-details">
                                    <div class="button-label">
                                        {{ $button->label }}
                                        @if($button->is_promotion)
                                            <span class="promotion-badge">PROMO</span>
                                        @endif
                                        @if($button->discount_label)
                                            <span class="discount-badge-small">{{ $button->discount_label }}</span>
                                        @endif
                                    </div>
                                    <div class="button-url">{{ $button->url ?: $button->file_filename }}</div>
                                    <div class="button-stats">{{ $button->click_count ?: 0 }} clicks</div>
                                </div>
                            </div>
                            <div class="button-actions">
                                <button class="btn btn-edit" onclick="editButton({{ $button->id }})">
                                    <i class="fas fa-edit"></i>Edit
                                </button>
                                <form method="POST" action="{{ route('user.toggle-button', $button->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-toggle">
                                        @if($button->is_active)
                                            <i class="fas fa-eye-slash"></i>Hide
                                        @else
                                            <i class="fas fa-eye"></i>Show
                                        @endif
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('user.delete-button', $button->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span>No buttons created yet. Add your first button above!</span>
                </div>
            @endif
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i>Edit Button</h3>
            <button class="close" onclick="closeEditModal()">&times;</button>
        </div>
        <form method="POST" id="editButtonForm" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Button Label</label>
                    <input type="text" name="label" class="form-control" id="editLabelInput" required>
                </div>
                <div class="form-group">
                    <label>URL or Link</label>
                    <input type="url" name="url" class="form-control" id="editUrlInput">
                </div>
                <div class="form-group">
                    <label>Icon Class</label>
                    <input type="text" name="icon_class" class="form-control" id="editIconInput" placeholder="fas fa-link">
                </div>
                <div class="form-group">
                    <label>Order</label>
                    <input type="number" name="order" class="form-control" id="editOrderInput" min="0">
                </div>
            </div>
            
            <div class="form-group">
                <label>Upload New File (Optional)</label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.gif">
            </div>
            
            <div class="promotion-settings" style="display: block; margin-top: 1.5rem;">
                <h6><i class="fas fa-star"></i>Promotion Settings</h6>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Promotion Color</label>
                        <input type="color" name="promotion_color" id="editPromotionColorInput" class="color-input" value="#ef4444" style="height: 50px;">
                    </div>
                    <div class="form-group">
                        <label>Discount Label</label>
                        <input type="text" name="discount_label" class="form-control" id="editDiscountLabelInput" placeholder="50% OFF" maxlength="15">
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="is_promotion" id="editIsPromotionCheck" style="transform: scale(1.2);">
                    <label for="editIsPromotionCheck"><strong>✨ Make this a PROMOTION button ✨</strong></label>
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                <button type="button" class="btn btn-toggle" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>Update Button
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
                labelInput.value = 'Special Offer';
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

    // Container settings functionality
    const borderWidth = document.getElementById('borderWidth');
    const borderRadius = document.getElementById('borderRadius');
    const opacity = document.getElementById('opacity');
    const borderWidthValue = document.getElementById('borderWidthValue');
    const borderRadiusValue = document.getElementById('borderRadiusValue');
    const opacityValue = document.getElementById('opacityValue');

    function updatePreview() {
        const container = document.getElementById('previewContainer');
        const useContainer = document.getElementById('use_container_styling').checked;
        const containerBg = document.querySelector('input[name="container_background"]').value;
        const borderColor = document.querySelector('input[name="container_border_color"]').value;
        const shadow = document.getElementById('container_shadow').checked;
        const blur = document.getElementById('container_blur').checked;

        if (useContainer) {
            const opacityHex = Math.round(parseInt(opacity.value) * 2.55).toString(16).padStart(2, '0');
            container.style.background = containerBg + opacityHex;
            container.style.border = `${borderWidth.value}px solid ${borderColor}`;
            container.style.borderRadius = `${borderRadius.value}px`;
            container.style.boxShadow = shadow ? '0 8px 32px rgba(0, 0, 0, 0.1)' : 'none';
            container.style.backdropFilter = blur ? 'blur(10px)' : 'none';
        } else {
            container.style.background = 'rgba(255, 255, 255, 0.95)';
            container.style.border = 'none';
            container.style.borderRadius = '20px';
            container.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.1)';
            container.style.backdropFilter = 'blur(10px)';
        }
    }

    // Range input handlers
    if (borderWidth) {
        borderWidth.addEventListener('input', function() {
            borderWidthValue.textContent = this.value + 'px';
            updatePreview();
        });
    }

    if (borderRadius) {
        borderRadius.addEventListener('input', function() {
            borderRadiusValue.textContent = this.value + 'px';
            updatePreview();
        });
    }

    if (opacity) {
        opacity.addEventListener('input', function() {
            opacityValue.textContent = this.value + '%';
            updatePreview();
        });
    }

    // Container styling toggle
    const containerToggle = document.getElementById('use_container_styling');
    const containerSettings = document.getElementById('container-settings');
    
    function toggleContainerSettings() {
        if (containerToggle && containerSettings) {
            if (containerToggle.checked) {
                containerSettings.style.opacity = '1';
                containerSettings.style.pointerEvents = 'auto';
            } else {
                containerSettings.style.opacity = '0.5';
                containerSettings.style.pointerEvents = 'none';
            }
            updatePreview();
        }
    }

    if (containerToggle) {
        containerToggle.addEventListener('change', toggleContainerSettings);
    }
    
    // Color input handlers
    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('change', updatePreview);
    });
    
    // Checkbox handlers
    document.querySelectorAll('input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', updatePreview);
    });

    // Initialize container settings
    toggleContainerSettings();
    updatePreview();
    
    // Enhanced drag and drop functionality
    function initializeDragAndDrop() {
        const buttonsList = document.getElementById('buttonsList');
        
        if (!buttonsList) {
            console.warn('buttonsList element not found');
            return;
        }
        
        // Check if Sortable library is loaded
        if (typeof Sortable === 'undefined') {
            console.error('Sortable library not loaded');
            showNotification('Drag and drop functionality unavailable', 'error');
            return;
        }
        
        console.log('Initializing Sortable with', buttonsList.children.length, 'items');
        
        // Destroy existing sortable instance if it exists
        if (buttonsList.sortable) {
            buttonsList.sortable.destroy();
        }
        
        const sortable = new Sortable(buttonsList, {
            animation: 300,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            // Allow dragging from entire button area
            forceFallback: false,
            fallbackTolerance: 3,
            scroll: true,
            scrollSensitivity: 30,
            scrollSpeed: 10,
            bubbleScroll: true,
            delay: 100,
            delayOnTouchStart: true,
            touchStartThreshold: 3,
            
            // Prevent dragging when clicking on interactive elements
            filter: '.btn, .button-actions, .button-actions *, form, input, button',
            
            onStart: function(evt) {
                console.log('Drag started:', evt.item.dataset.buttonId);
                evt.item.style.opacity = '0.7';
                document.body.classList.add('dragging');
                
                // Add visual feedback
                evt.item.style.transform = 'scale(1.02) rotate(2deg)';
                evt.item.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.2)';
            },
            
            onMove: function(evt, originalEvent) {
                // Allow move unless target is a button action
                const target = originalEvent.target;
                if (target.closest('.button-actions')) {
                    return false;
                }
                return true;
            },
            
            onEnd: function(evt) {
                console.log('Drag ended. Old index:', evt.oldIndex, 'New index:', evt.newIndex);
                evt.item.style.opacity = '';
                evt.item.style.transform = '';
                evt.item.style.boxShadow = '';
                document.body.classList.remove('dragging');
                
                // Only proceed if the item actually moved
                if (evt.oldIndex === evt.newIndex) {
                    console.log('Item did not move, skipping reorder');
                    return;
                }
                
                // Add loading state
                evt.item.classList.add('loading');
                
                // Get all button IDs in their new order
                const buttonIds = [];
                const items = buttonsList.querySelectorAll('[data-button-id]');
                
                items.forEach(item => {
                    const buttonId = item.dataset.buttonId;
                    if (buttonId) {
                        buttonIds.push(buttonId);
                    }
                });
                
                console.log('New order:', buttonIds);
                
                if (buttonIds.length === 0) {
                    console.warn('No button IDs found for reordering');
                    showNotification('No buttons to reorder', 'error');
                    evt.item.classList.remove('loading');
                    return;
                }
                
                // Send AJAX request to update order
                updateButtonOrder(buttonIds, evt.item);
            }
        });
        
        // Store the sortable instance
        buttonsList.sortable = sortable;
        console.log('Sortable initialized successfully');
        
        // Add keyboard support for accessibility
        addKeyboardSupport();
    }
    
    // Add keyboard support for drag and drop
    function addKeyboardSupport() {
        const buttonItems = document.querySelectorAll('.button-item');
        
        buttonItems.forEach((item, index) => {
            item.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                    e.preventDefault();
                    
                    const currentIndex = Array.from(this.parentNode.children).indexOf(this);
                    let targetIndex;
                    
                    if (e.key === 'ArrowUp' && currentIndex > 0) {
                        targetIndex = currentIndex - 1;
                    } else if (e.key === 'ArrowDown' && currentIndex < this.parentNode.children.length - 1) {
                        targetIndex = currentIndex + 1;
                    }
                    
                    if (targetIndex !== undefined) {
                        const targetElement = this.parentNode.children[targetIndex];
                        if (e.key === 'ArrowUp') {
                            this.parentNode.insertBefore(this, targetElement);
                        } else {
                            this.parentNode.insertBefore(this, targetElement.nextSibling);
                        }
                        
                        // Update order
                        const buttonIds = Array.from(this.parentNode.children)
                            .map(item => item.dataset.buttonId)
                            .filter(id => id);
                        
                        updateButtonOrder(buttonIds, this);
                        this.focus();
                    }
                }
            });
        });
    }
    
    // Function to update button order via AJAX
    function updateButtonOrder(buttonIds, itemElement = null) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            showNotification('Security token missing. Please refresh the page.', 'error');
            if (itemElement) itemElement.classList.remove('loading');
            return;
        }
        
        console.log('Sending reorder request with IDs:', buttonIds);
        
        // Show loading state
        showNotification('Updating button order...', 'info');
        
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
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            if (data.success) {
                showNotification('Button order updated successfully!', 'success');
                
                // Add success visual feedback
                if (itemElement) {
                    itemElement.style.borderColor = '#10b981';
                    setTimeout(() => {
                        if (itemElement.style) {
                            itemElement.style.borderColor = '';
                        }
                    }, 2000);
                }
            } else {
                throw new Error(data.message || 'Failed to update order');
            }
        })
        .catch(error => {
            console.error('Reorder error:', error);
            showNotification('Error updating button order: ' + error.message, 'error');
            
            // Add error visual feedback
            if (itemElement) {
                itemElement.style.borderColor = '#ef4444';
                setTimeout(() => {
                    if (itemElement.style) {
                        itemElement.style.borderColor = '';
                    }
                }, 3000);
            }
            
            // Optionally reload the page on error to reset the order
            setTimeout(() => {
                if (confirm('There was an error updating the order. Would you like to reload the page to reset?')) {
                    window.location.reload();
                }
            }, 3000);
        })
        .finally(() => {
            if (itemElement) {
                itemElement.classList.remove('loading');
            }
        });
    }
    
    // Call initialization when DOM is ready
    initializeDragAndDrop();
    
    // Re-initialize drag and drop when new buttons are added
    const buttonForm = document.getElementById('buttonForm');
    if (buttonForm) {
        buttonForm.addEventListener('submit', function() {
            setTimeout(() => {
                initializeDragAndDrop();
            }, 1000); // Wait for potential page reload/redirect
        });
    }
    
    // Edit button functionality
    window.editButton = function(buttonId) {
        const editModal = document.getElementById('editModal');
        editModal.style.display = 'block';
        
        // Add loading state to modal
        const modalContent = editModal.querySelector('.modal-content');
        modalContent.classList.add('loading');
        
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
            showNotification('Error loading button data', 'error');
        })
        .finally(() => {
            modalContent.classList.remove('loading');
        });
    };
    
    // Close modal functionality
    window.closeEditModal = function() {
        document.getElementById('editModal').style.display = 'none';
    };
    
    // Click outside modal to close
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
    
    // Enhanced notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelectorAll('.notification');
        existing.forEach(notif => notif.remove());
        
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: ${type === 'success' ? 'linear-gradient(135deg, #10b981, #059669)' : 
                        type === 'error' ? 'linear-gradient(135deg, #ef4444, #dc2626)' :
                        'linear-gradient(135deg, #3b82f6, #1d4ed8)'};
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 350px;
            word-wrap: break-word;
        `;
        
        notification.innerHTML = `
            <div style="display: flex; align-items: center;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                 type === 'error' ? 'exclamation-triangle' : 
                                 'info-circle'}" style="margin-right: 0.75rem; font-size: 1.25rem;"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto-dismiss after 4 seconds
        setTimeout(() => {
            if (document.body.contains(notification)) {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }
        }, 4000);
        
        // Click to dismiss
        notification.addEventListener('click', () => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        });
    }
    
    // Make notification function globally available
    window.showNotification = showNotification;
    
    // Add touch support enhancements
    if ('ontouchstart' in window) {
        // Add touch-specific enhancements
        document.body.classList.add('touch-device');
        
        // Improve touch scrolling
        document.addEventListener('touchstart', function() {}, {passive: true});
        document.addEventListener('touchmove', function() {}, {passive: true});
    }
    
    // Handle orientation changes
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            // Recalculate layouts after orientation change
            const event = new Event('resize');
            window.dispatchEvent(event);
        }, 100);
    });
    
    // Progressive Web App support
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('ServiceWorker registration successful');
            }).catch(function(err) {
                console.log('ServiceWorker registration failed');
            });
        });
    }
});
</script>
@endsection