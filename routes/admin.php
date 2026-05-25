<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Custom Routes
|--------------------------------------------------------------------------
| Lưu ý: FilamentPHP v5 đã tự động lo liệu Route Login, Reset Password 
| và các CRUD ở đường dẫn /admin.
| 
| File này dùng để định nghĩa các custom route yêu cầu quyền admin.
| Các route ở đây đã tự động có middleware 'web', 'auth' và prefix 'admin-custom'.
*/

Route::get('/custom-dashboard', function () {
    return "This is a custom admin route outside Filament.";
})->name('custom.dashboard');

// Thêm các route export, import, xử lý queue cho admin tại đây...
