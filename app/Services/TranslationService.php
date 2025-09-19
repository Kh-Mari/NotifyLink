<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class TranslationService
{
    private static $translations = [
        'en' => [
            // Basic translations
            'welcome_to_links' => 'Welcome to my links',
            'powered_by' => 'Powered by',
            'dashboard' => 'Dashboard',
            'admin_dashboard' => 'Admin Dashboard',
            'login' => 'Login',
            'logout' => 'Logout',
            'settings_updated' => 'Settings updated successfully',
            'customize_appearance' => 'Customize Appearance',
            'button_color' => 'Button Color',
            'background_color' => 'Background Color',
            'text_color' => 'Text Color',
            'save_settings' => 'Save Settings',
            'add_button' => 'Add Button',
            'button_label' => 'Button Label',
            'button_url' => 'Button URL',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'save' => 'Save',
            'cancel' => 'Cancel',
            
            // Dashboard translations
            'analytics' => 'Analytics',
            'total_visits' => 'Total Visits',
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
            'background_colors' => 'Background & Colors',
            'background_image' => 'Background Image',
            'choose_background' => 'Choose Background',
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
            'url_link' => 'URL or Link',
            'upload_file' => 'Upload File (Optional)',
            'order' => 'Order',
            'promotion_settings' => 'Promotion Settings',
            'promotion_color' => 'Promotion Color',
            'discount_label' => 'Discount Label',
            'make_promotion' => 'Make this a PROMOTION button',
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
            
            // Public page translations
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
            'email' => 'Email',
            'promotion' => 'Promotion',
            
            // Messages
            'updating_order' => 'Updating button order...',
            'order_updated' => 'Button order updated successfully!',
            'order_error' => 'Error updating button order',
            'button_added' => 'Button added successfully!',
            'button_updated' => 'Button updated successfully!',
            'button_deleted' => 'Button deleted successfully!',
        ],
        
        'ar' => [
            // Basic translations
            'welcome_to_links' => 'مرحباً بك في روابطي',
            'powered_by' => 'مدعوم من',
            'dashboard' => 'لوحة التحكم',
            'admin_dashboard' => 'لوحة تحكم المدير',
            'login' => 'تسجيل الدخول',
            'logout' => 'تسجيل الخروج',
            'settings_updated' => 'تم تحديث الإعدادات بنجاح',
            'customize_appearance' => 'تخصيص المظهر',
            'button_color' => 'لون الأزرار',
            'background_color' => 'لون الخلفية',
            'text_color' => 'لون النص',
            'save_settings' => 'حفظ الإعدادات',
            'add_button' => 'إضافة زر',
            'button_label' => 'عنوان الزر',
            'button_url' => 'رابط الزر',
            'edit' => 'تعديل',
            'delete' => 'حذف',
            'save' => 'حفظ',
            'cancel' => 'إلغاء',

            // Dashboard translations
            'analytics' => 'الإحصائيات',
            'total_visits' => 'إجمالي الزيارات',
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
            'background_colors' => 'الخلفية والألوان',
            'background_image' => 'صورة الخلفية',
            'choose_background' => 'اختر الخلفية',
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
            'url_link' => 'الرابط أو URL',
            'upload_file' => 'رفع ملف (اختياري)',
            'order' => 'الترتيب',
            'promotion_settings' => 'إعدادات العروض الترويجية',
            'promotion_color' => 'لون العرض الترويجي',
            'discount_label' => 'تسمية الخصم',
            'make_promotion' => 'اجعل هذا زر عرض ترويجي',
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
            
            // Public page translations
            'special_offer' => 'عرض خاص',
            
            // Social media presets
            'instagram' => 'إنستغرام',
            'facebook' => 'فيسبوك',
            'twitter' => 'تويتر',
            'youtube' => 'يوتيوب',
            'tiktok' => 'تيك توك',
            'whatsapp' => 'واتساب',
            'menu' => 'القائمة',
            'location' => 'الموقع',
            'website' => 'الموقع الإلكتروني',
            'phone' => 'الهاتف',
            'email' => 'البريد الإلكتروني',
            'promotion' => 'عرض ترويجي',
            
            // Messages
            'updating_order' => 'جاري تحديث ترتيب الأزرار...',
            'order_updated' => 'تم تحديث ترتيب الأزرار بنجاح!',
            'order_error' => 'خطأ في تحديث ترتيب الأزرار',
            'button_added' => 'تم إضافة الزر بنجاح!',
            'button_updated' => 'تم تحديث الزر بنجاح!',
            'button_deleted' => 'تم حذف الزر بنجاح!',
        ]
    ];

    public static function setLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
            app()->setLocale($locale);
        }
    }

    public static function getCurrentLocale()
    {
        return Session::get('locale', config('app.locale', 'en'));
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