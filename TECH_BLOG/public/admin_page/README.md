# Admin Page Assets

Thư mục này chứa các file CSS và JavaScript tùy chỉnh cho trang admin.

## Cấu trúc thư mục

```
admin_page/
├── css/
│   ├── sb-admin-2.css          # Bootstrap Admin Theme CSS
│   ├── sb-admin-2.min.css      # Bootstrap Admin Theme CSS (minified)
│   └── profile-admin.css       # Custom CSS cho trang Profile Admin
├── js/
│   ├── sb-admin-2.js           # Bootstrap Admin Theme JavaScript
│   ├── sb-admin-2.min.js       # Bootstrap Admin Theme JavaScript (minified)
│   └── profile-admin.js        # Custom JavaScript cho trang Profile Admin
├── img/                        # Hình ảnh cho admin theme
└── vendor/                     # Third-party libraries
```

## File Profile Admin

### CSS (`profile-admin.css`)

File CSS tùy chỉnh cho trang Profile Admin với các tính năng:

-   **Avatar Upload**: Styling cho phần upload ảnh đại diện
-   **Profile Info Grid**: Layout grid cho thông tin profile
-   **Password Section**: Styling cho phần đổi mật khẩu
-   **Form Actions**: Styling cho các nút hành động
-   **Responsive Design**: Tối ưu cho mobile và tablet
-   **Animations**: Hiệu ứng chuyển động mượt mà
-   **Loading States**: Styling cho trạng thái loading
-   **Accessibility**: Cải thiện khả năng truy cập

### JavaScript (`profile-admin.js`)

File JavaScript hiện đại với ES6+ features:

-   **Class-based Architecture**: Sử dụng ES6 Classes
-   **Form Validation**: Validation real-time cho form
-   **Password Strength**: Kiểm tra độ mạnh mật khẩu
-   **File Upload**: Validation và preview ảnh
-   **AJAX Submission**: Submit form không reload trang
-   **Error Handling**: Xử lý lỗi tốt hơn
-   **Notifications**: Hệ thống thông báo
-   **Accessibility**: Hỗ trợ keyboard navigation

## Cách sử dụng

### Trong Blade Template

```php
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_page/css/profile-admin.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin_page/js/profile-admin.js') }}"></script>
@endpush
```

### Trong Layout

```php
<!DOCTYPE html>
<html>
<head>
    <!-- Other styles -->
    @stack('styles')
</head>
<body>
    <!-- Content -->

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
```

## Tính năng chính

### UI/UX Improvements

1. **Modern Design**: Giao diện hiện đại với gradient và shadows
2. **Responsive**: Tối ưu cho mọi thiết bị
3. **Animations**: Hiệu ứng chuyển động mượt mà
4. **Loading States**: Feedback trực quan khi submit
5. **Real-time Validation**: Validation ngay khi nhập liệu

### Code Optimization

1. **Modular Structure**: Code được tổ chức theo module
2. **ES6+ Features**: Sử dụng modern JavaScript
3. **Error Handling**: Xử lý lỗi tốt hơn
4. **Performance**: Tối ưu performance
5. **Maintainability**: Code dễ bảo trì và mở rộng

### Security Features

1. **File Validation**: Kiểm tra file upload
2. **Password Strength**: Đánh giá độ mạnh mật khẩu
3. **CSRF Protection**: Bảo vệ CSRF
4. **Input Sanitization**: Làm sạch input

## Browser Support

-   Chrome 60+
-   Firefox 55+
-   Safari 12+
-   Edge 79+

## Dependencies

-   Bootstrap 4.6+
-   Font Awesome 5+
-   jQuery 3.6+ (cho một số tính năng)

## Development

### Thêm tính năng mới

1. Thêm CSS vào `profile-admin.css`
2. Thêm JavaScript vào `profile-admin.js`
3. Cập nhật HTML trong Blade template
4. Test trên các thiết bị khác nhau

### Best Practices

1. **CSS**: Sử dụng BEM methodology
2. **JavaScript**: Sử dụng ES6+ features
3. **Performance**: Minimize DOM queries
4. **Accessibility**: Hỗ trợ screen readers
5. **Mobile-first**: Responsive design

## Troubleshooting

### CSS không load

-   Kiểm tra đường dẫn file
-   Clear browser cache
-   Kiểm tra file permissions

### JavaScript không hoạt động

-   Kiểm tra console errors
-   Đảm bảo jQuery đã load
-   Kiểm tra element IDs

### Responsive issues

-   Test trên nhiều thiết bị
-   Kiểm tra media queries
-   Sử dụng browser dev tools
