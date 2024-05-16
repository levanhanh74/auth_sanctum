# Các bước kéo code về chạy trong vscode.
- b1. Clone source in github về máy bằng câu lệnh sau: 
    (trước khi clone bằng command máy của người dùng cần phải tải gitbash )
    git clone + (link của source).
- b2. Khi clone source về cái folder APP_API. Ta cd vào APP_API sau đó chạy câu lệnh composer install  để cho cài các gói package của laravel.
- b3. Sau khi cài xong thì vào xampp or laragon có tải ở trong máy để tạo cơ sở dữ liệu, và đặt tên cho cơ sở dữ liệu đó là app_api or là gì cũng được miễn là trong file .env giống với database được tạo.
Sau đó vào file .env kiếm tra DB_DATABASE=app_api
- b4. chạy lệnh " php artisan migrate " để push table_user lên trên csdl.
- b5. chạy lệnh " php artisan serve " để chạy projects.
- b6. Tải postman or extendsion trong vscode Thunder Client để test api.