<?php

// 1. Updated TranslationService.php
namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class TranslationService
{
    private static $translations = [
        'en' => [
            'welcome_back' => 'Welcome Back',
            'sign_in_to_app' => 'Sign in to NotifySmartLink',
            'enter_email' => 'Enter your email',
            'enter_password' => 'Enter your password',



            // Navigation and Auth
            'welcome' => 'Welcome',
            'home' => 'Home',
            'dashboard' => 'Dashboard',
            'admin_dashboard' => 'Admin Dashboard',
            'login' => 'Login',
            'logout' => 'Logout',
            'register' => 'Register',
            'email' => 'Email',
            'password' => 'Password',
            'sign_in' => 'Sign In',
            'remember_me' => 'Remember Me',
            'forgot_password' => 'Forgot Password?',
            
            // Admin Dashboard
            'total_users' => 'Total Users',
            'active_links' => 'Active Links',
            'total_visits' => 'Total Visits',
            'total_buttons' => 'Total Buttons',
            'create_new_link' => 'Create New Link',
            'select_user' => 'Select User',
            'page_slug' => 'Page Slug',
            'create_link' => 'Create Link',
            'users_management' => 'Users Management',
            'add_user' => 'Add User',
            'role' => 'Role',
            'link_assigned' => 'Link Assigned',
            'created' => 'Created',
            'actions' => 'Actions',
            'admin' => 'ADMIN',
            'user' => 'USER',
            'no_link' => 'No link',
            'delete' => 'Delete',
            'links_management' => 'Links Management',
            'slug' => 'Slug',
            'owner' => 'Owner',
            'visits' => 'Visits',
            'buttons' => 'Buttons',
            
            // User Registration
            'register_user' => 'Register New User',
            'create_new_account' => 'Create a new user account',
            'email_address' => 'Email Address',
            'administrator_privileges' => 'Administrator privileges',
            'back_to_dashboard' => 'Back to Dashboard',
            'create_user' => 'Create User',
            
            // User Dashboard
            'analytics' => 'Analytics',
            'active_buttons' => 'Active Buttons',
            'total_clicks' => 'Total Clicks',
            'view_page' => 'View Page',
            'customize_page' => 'Customize Your Page',
            'profile_logo' => 'Profile & Logo',
            'choose_logo' => 'Choose Logo Image',
            'logo_shape' => 'Logo Shape',
            'logo_size' => 'Logo Size',
            'circle' => 'Circle',
            'rounded' => 'Rounded',
            'square' => 'Square',
            'small' => 'Small',
            'medium' => 'Medium',
            'large' => 'Large',
            'button_styling' => 'Button Styling',
            'button_style' => 'Button Style',
            'pill' => 'Pill',
            'button_color' => 'Button Color',
            'background_colors' => 'Background & Colors',
            'background_image' => 'Background Image',
            'choose_background' => 'Choose Background',
            'background_color' => 'Background Color',
            'text_color' => 'Text Color',
            'use_background_image' => 'Use background image instead of color',
            'container_settings' => 'Container Settings',
            'enable_container_styling' => 'Enable container styling (recommended for background images)',
            'container_background' => 'Container Background',
            'border_color' => 'Border Color',
            'border_width' => 'Border Width',
            'border_radius' => 'Border Radius',
            'opacity' => 'Opacity',
            'effects' => 'Effects',
            'drop_shadow' => 'Drop shadow',
            'backdrop_blur' => 'Backdrop blur',
            'update_settings' => 'Update Settings',
            'manage_buttons' => 'Manage Buttons',
            'add_new_button' => 'Add New Button',
            'button_label' => 'Button Label',
            'url_link' => 'URL or Link',
            'upload_file' => 'Upload File (Optional)',
            'order' => 'Order',
            'promotion_settings' => 'Promotion Settings',
            'promotion_color' => 'Promotion Color',
            'discount_label' => 'Discount Label',
            'make_promotion' => 'Make this a PROMOTION button',
            'add_button' => 'Add Button',
            'drag_reorder' => 'Drag and drop buttons to reorder them',
            'hide' => 'Hide',
            'show' => 'Show',
            'clicks' => 'clicks',
            'no_buttons' => 'No buttons created yet. Add your first button above!',
            'edit_button' => 'Edit Button',
            'icon_class' => 'Icon Class',
            'upload_new_file' => 'Upload New File (Optional)',
            'update_button' => 'Update Button',
            'contact_admin' => 'Contact your administrator to assign you a page slug to get started.',
            'edit' => 'Edit',
            'cancel' => 'Cancel',
            'save' => 'Save',
            
            // Public page
            'welcome_to_links' => 'Welcome to my links',
            'powered_by' => 'Powered by',
            'special_offer' => 'Special Offer',
            
            // Social media presets
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
            'whatsapp' => 'WhatsApp',
            'menu' => 'Menu',
            'location' => 'Location',
            'website' => 'Website',
            'phone' => 'Phone',
            'promotion' => 'Promotion',
            
            // Messages
            'settings_updated' => 'Settings updated successfully',
            'updating_order' => 'Updating button order...',
            'order_updated' => 'Button order updated successfully!',
            'order_error' => 'Error updating button order',
            'button_added' => 'Button added successfully!',
            'button_updated' => 'Button updated successfully!',
            'button_deleted' => 'Button deleted successfully!',
            'are_you_sure' => 'Are you sure?',
        ],
        
        'ar' => [


            'welcome_back' => 'مرحباً بعودتك',
            'sign_in_to_app' => 'سجل الدخول إلى NotifySmartLink',
            'enter_email' => 'أدخل بريدك الإلكتروني',
            'enter_password' => 'أدخل كلمة المرور',
            'sign_in' =>  'تسجيل الدخول',


            // Navigation and Auth
            'welcome' => 'مرحباً',
            'home' => 'الرئيسية',
            'dashboard' => 'لوحة التحكم',
            'admin_dashboard' => 'لوحة تحكم المدير',
            'login' => 'تسجيل الدخول',
            'logout' => 'تسجيل الخروج',
            'register' => 'التسجيل',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'sign in' => 'تسجيل الدخول',
            'remember_me' => 'تذكرني',
            'forgot_password' => 'نسيت كلمة المرور؟',
            
            // Admin Dashboard
            'total_users' => 'إجمالي المستخدمين',
            'active_links' => 'الروابط النشطة',
            'total_visits' => 'إجمالي الزيارات',
            'total_buttons' => 'إجمالي الأزرار',
            'create_new_link' => 'إنشاء رابط جديد',
            'select_user' => 'اختر المستخدم',
            'page_slug' => 'معرف الصفحة',
            'create_link' => 'إنشاء الرابط',
            'users_management' => 'إدارة المستخدمين',
            'add_user' => 'إضافة مستخدم',
            'role' => 'الدور',
            'link_assigned' => 'الرابط المخصص',
            'created' => 'تاريخ الإنشاء',
            'actions' => 'الإجراءات',
            'admin' => 'مدير',
            'user' => 'مستخدم',
            'no_link' => 'لا يوجد رابط',
            'delete' => 'حذف',
            'links_management' => 'إدارة الروابط',
            'slug' => 'المعرف',
            'owner' => 'المالك',
            'visits' => 'الزيارات',
            'buttons' => 'الأزرار',
            
            // User Registration
            'register_user' => 'تسجيل مستخدم جديد',
            'create_new_account' => 'إنشاء حساب مستخدم جديد',
            'email_address' => 'عنوان البريد الإلكتروني',
            'administrator_privileges' => 'صلاحيات المدير',
            'back_to_dashboard' => 'العودة للوحة التحكم',
            'create_user' => 'إنشاء المستخدم',

            // User Dashboard
            'analytics' => 'الإحصائيات',
            'active_buttons' => 'الأزرار النشطة',
            'total_clicks' => 'إجمالي النقرات',
            'view_page' => 'عرض الصفحة',
            'customize_page' => 'تخصيص صفحتك',
            'profile_logo' => 'الملف الشخصي والشعار',
            'choose_logo' => 'اختر صورة الشعار',
            'logo_shape' => 'شكل الشعار',
            'logo_size' => 'حجم الشعار',
            'circle' => 'دائري',
            'rounded' => 'مدور',
            'square' => 'مربع',
            'small' => 'صغير',
            'medium' => 'متوسط',
            'large' => 'كبير',
            'button_styling' => 'تصميم الأزرار',
            'button_style' => 'نمط الزر',
            'pill' => 'حبة دواء',
            'button_color' => 'لون الأزرار',
            'background_colors' => 'الخلفية والألوان',
            'background_image' => 'صورة الخلفية',
            'choose_background' => 'اختر الخلفية',
            'background_color' => 'لون الخلفية',
            'text_color' => 'لون النص',
            'use_background_image' => 'استخدم صورة الخلفية بدلاً من اللون',
            'container_settings' => 'إعدادات الحاوية',
            'enable_container_styling' => 'تفعيل تصميم الحاوية (يُنصح به لصور الخلفية)',
            'container_background' => 'خلفية الحاوية',
            'border_color' => 'لون الحد',
            'border_width' => 'عرض الحد',
            'border_radius' => 'انحناء الحد',
            'opacity' => 'الشفافية',
            'effects' => 'التأثيرات',
            'drop_shadow' => 'ظل منسدل',
            'backdrop_blur' => 'ضبابية الخلفية',
            'update_settings' => 'تحديث الإعدادات',
            'manage_buttons' => 'إدارة الأزرار',
            'add_new_button' => 'إضافة زر جديد',
            'button_label' => 'عنوان الزر',
            'url_link' => 'الرابط أو URL',
            'upload_file' => 'رفع ملف (اختياري)',
            'order' => 'الترتيب',
            'promotion_settings' => 'إعدادات العروض الترويجية',
            'promotion_color' => 'لون العرض الترويجي',
            'discount_label' => 'تسمية الخصم',
            'make_promotion' => 'اجعل هذا زر عرض ترويجي',
            'add_button' => 'إضافة زر',
            'drag_reorder' => 'اسحب وأفلت الأزرار لإعادة ترتيبها',
            'hide' => 'إخفاء',
            'show' => 'إظهار',
            'clicks' => 'نقرة',
            'no_buttons' => 'لم يتم إنشاء أزرار بعد. أضف أول زر لك أعلاه!',
            'edit_button' => 'تعديل الزر',
            'icon_class' => 'فئة الأيقونة',
            'upload_new_file' => 'رفع ملف جديد (اختياري)',
            'update_button' => 'تحديث الزر',
            'contact_admin' => 'اتصل بالمسؤول لتخصيص رابط الصفحة للبدء.',
            'edit' => 'تعديل',
            'cancel' => 'إلغاء',
            'save' => 'حفظ',
            
            // Public page
            'welcome_to_links' => 'مرحباً بك في روابطي',
            'powered_by' => 'مدعوم من',
            'special_offer' => 'عرض خاص',
            
            // Social media presets
            'instagram' => 'إنستغرام',
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر',
            'youtube' => 'يوتيوب',
            'tiktok' => 'تيك توك',
            'whatsapp' => 'واتساب',
            'menu' => 'قائمة الطعام',
            'location' => 'الموقع',
            'website' => 'الموقع الإلكتروني',
            'phone' => 'الهاتف',
            'promotion' => 'عرض ترويجي',
            
            // Messages
            'settings_updated' => 'تم تحديث الإعدادات بنجاح',
            'updating_order' => 'جاري تحديث ترتيب الأزرار...',
            'order_updated' => 'تم تحديث ترتيب الأزرار بنجاح!',
            'order_error' => 'خطأ في تحديث ترتيب الأزرار',
            'button_added' => 'تم إضافة الزر بنجاح!',
            'button_updated' => 'تم تحديث الزر بنجاح!',
            'button_deleted' => 'تم حذف الزر بنجاح!',
            'are_you_sure' => 'هل أنت متأكد؟',
        ]
    ];

    public static function setLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
            // Also set a cookie for public pages
            Cookie::queue('locale', $locale, 60 * 24 * 365); // 1 year
            app()->setLocale($locale);
        }
    }

    public static function getCurrentLocale()
    {
        // First check session (for authenticated users)
        $sessionLocale = Session::get('locale');
        if ($sessionLocale && in_array($sessionLocale, ['en', 'ar'])) {
            return $sessionLocale;
        }
        
        // Then check cookie (for public pages)
        $cookieLocale = request()->cookie('locale');
        if ($cookieLocale && in_array($cookieLocale, ['en', 'ar'])) {
            return $cookieLocale;
        }
        
        // Finally fall back to config default
        return config('app.locale', 'en');
    }

    public static function get($key, $locale = null)
    {
        $locale = $locale ?: self::getCurrentLocale();
        
        return self::$translations[$locale][$key] ?? $key;
    }

    public static function isRTL($locale = null)
    {
        $locale = $locale ?: self::getCurrentLocale();
        return $locale === 'ar';
    }
}