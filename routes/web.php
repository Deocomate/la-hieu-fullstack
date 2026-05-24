<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CUSTOM ROUTES (Độ ưu tiên cao nhất)
|--------------------------------------------------------------------------
| Setup các đường dẫn cụ thể theo ý muốn của bạn ở đây.
*/

// Trang chủ mặc định
Route::get('/', function () {
    return view('client.home.index');
});

// Custom routes can be placed here


/*
|--------------------------------------------------------------------------
| DYNAMIC FRONTEND ROUTES (Catch-all)
|--------------------------------------------------------------------------
| Tự động tìm kiếm file blade dựa theo URL.
| Thích hợp cho giai đoạn phát triển Frontend/Cắt giao diện.
*/

Route::get('/{any}', function ($any) {
    // Chuyển URL (dấu /) thành chuẩn cấu trúc thư mục view của Laravel (dấu .)
    // VD: admin/dashboard -> admin.dashboard
    $viewPath = str_replace('/', '.', $any);

    // Danh sách các trường hợp view có thể xảy ra (Sắp xếp theo thứ tự ưu tiên)
    $possibleViews = [
        $viewPath,                         // 1. Trùng khớp hoàn toàn (VD: admin.users.edit)
        $viewPath . '.index',              // 2. Tự thêm thư mục index (VD: admin.dashboard -> admin.dashboard.index)
        'client.' . $viewPath,             // 3. Tự động tìm trong thư mục client (VD: home -> client.home)
        'client.' . $viewPath . '.index'   // 4. Tự động tìm thư mục index trong client (VD: home -> client.home.index)
    ];

    // Duyệt qua danh sách, file blade nào tồn tại đầu tiên thì render ngay lập tức
    foreach ($possibleViews as $view) {
        if (view()->exists($view)) {
            return view($view);
        }
    }

    // Nếu đã quét hết mà không thấy file blade nào, trả về lỗi 404
    abort(404, "Không tìm thấy file blade cho đường dẫn: /{$any}");

})->where('any', '.*'); // Regex '.*' cho phép nhận mọi đường dẫn (kể cả có nhiều dấu /)