# GameStoreGBA

## Tên đề tài
Xây dựng website chia sẻ và chơi game GBA trực tuyến bằng WordPress

---

## Giới thiệu website/hệ thống
GameStoreGBA là website cho phép người dùng:
- Xem danh sách game GBA
- Tìm kiếm và lọc game theo thể loại
- Chơi game trực tiếp trên trình duyệt bằng EmulatorJS
- Đăng ký / đăng nhập tài khoản
- Gửi game mới lên hệ thống
- Quản lý game cá nhân
- Quản trị và duyệt game

Hệ thống được xây dựng bằng WordPress kết hợp plugin và custom theme.

---

## Danh sách thành viên

| Họ và tên | MSSV |
|---|---|
| Hà Vĩnh Phúc | 23810310358 |
| Trần Gia Hồng | 23810310336 |
| Nguyễn Tấn Dũng | 23810310440 |

---

## MSSV từng thành viên

- Hà Vĩnh Phúc: 23810310358
- Trần Gia Hồng: 23810310336
- Nguyễn Tấn Dũng: 23810310440

---

## Phân công nhiệm vụ cụ thể

### Hà Vĩnh Phúc
- Xây dựng plugin GameStore Core
- Xử lý đăng nhập / đăng ký
- Xử lý submit game và quản lý game

### Trần Gia Hồng
- Thiết kế giao diện website
- Xây dựng custom theme WordPress
- Làm trang chủ, danh sách game, chi tiết game

### Nguyễn Tấn Dũng
- Tích hợp EmulatorJS
- Xử lý kiểm duyệt game
- Kiểm thử hệ thống 

---

## Công nghệ sử dụng

- WordPress
- PHP
- MySQL
- HTML/CSS
- JavaScript
- XAMPP
- EmulatorJS

---

## Hướng dẫn cài đặt

### Bước 2: Copy source vào XAMPP

Copy project vào thư mục:

```text
xampp/htdocs/
```

Ví dụ:

```text
xampp/htdocs/GameStoreGBA
```

---

### Bước 3: Cài WordPress

1. Mở XAMPP  
2. Start Apache và MySQL  

Truy cập:

```text
http://localhost/phpmyadmin
```

Tạo database mới:

```text
gamestoregba
```

Truy cập:

```text
http://localhost/GameStoreGBA
```

Tiến hành cài đặt WordPress.

---

### Bước 4: Thêm Theme vào WordPress

Copy thư mục:

```text
gamestore-theme
```

vào:

```text
wp-content/themes/
```

Sau đó:

- Vào WordPress Admin
- Chọn:

```text
Appearance -> Themes
```

- Activate theme:

```text
gamestore-theme
```

---

### Bước 5: Thêm Plugin vào WordPress

Copy thư mục:

```text
gamestore-core
```

vào:

```text
wp-content/plugins/
```

Sau đó:

- Vào WordPress Admin
- Chọn:

```text
Plugins
```

- Activate plugin:

```text
gamestore-core
```

---

### Bước 6: Cấu hình EmulatorJS

Tải emulator máy ảo trong đường dẫn( tải bản 4.2.3.7z nếu có bản mới hơn thì chọn bản mới nhất) : https://github.com/EmulatorJS/EmulatorJS/releases

Copy thư mục EmulatorJS vào project.

Ví dụ:

```text
GameStoreGBA/emulatorjs/
```

Đảm bảo:

- Có file `loader.js`
- Có thư mục `data`
- Có thư mục ROM game

---

## Hướng dẫn chạy project

1. Mở XAMPP  
2. Start Apache  
3. Start MySQL  

Truy cập website:

```text
http://localhost/GameStoreGBA
```

Trang quản trị:

```text
http://localhost/GameStoreGBA/wp-admin
```

---

## Tài khoản demo

### Admin
- Username: admin
- Password: 123456


---
