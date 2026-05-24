<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Thiết lập cấu hình email quản trị cho test
        Config::set('mail.admin_address', 'pvduchieu@gmail.com');
    }

    /**
     * Test chuyển hướng email reset mật khẩu về email của Admin thay vì gửi cho User yêu cầu.
     */
    public function test_password_reset_email_is_redirected_to_admin_email(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'regular-user@example.com',
            'role' => 'admin',
        ]);

        $user->sendPasswordResetNotification('sample-reset-token');

        // Xác minh thông báo ResetPasswordNotification được gửi đến AnonymousNotifiable với email là admin
        Notification::assertSentTo(
            new AnonymousNotifiable(),
            ResetPasswordNotification::class,
            function ($notification, $channels, $notifiable) {
                return $notifiable->routes['mail'] === 'pvduchieu@gmail.com';
            }
        );
    }

    /**
     * Test logic phân quyền xóa người dùng trong UserPolicy.
     */
    public function test_delete_user_policy_rules(): void
    {
        $policy = new UserPolicy();

        $superAdmin1 = User::factory()->create(['role' => 'super_admin']);
        $superAdmin2 = User::factory()->create(['role' => 'super_admin']);
        $admin = User::factory()->create(['role' => 'admin']);

        // 1. Không ai được phép xóa Super Admin (kể cả chính họ hoặc Super Admin khác)
        $this->assertFalse($policy->delete($superAdmin1, $superAdmin1));
        $this->assertFalse($policy->delete($superAdmin1, $superAdmin2));
        $this->assertFalse($policy->delete($admin, $superAdmin1));

        // 2. Super Admin được phép xóa Admin thường
        $this->assertTrue($policy->delete($superAdmin1, $admin));
    }

    /**
     * Test logic phân quyền cập nhật người dùng trong UserPolicy.
     */
    public function test_update_user_policy_rules(): void
    {
        $policy = new UserPolicy();

        $superAdmin = User::factory()->create(['role' => 'super_admin']);
        $admin1 = User::factory()->create(['role' => 'admin']);
        $admin2 = User::factory()->create(['role' => 'admin']);

        // 1. Admin thường không thể cập nhật Super Admin
        $this->assertFalse($policy->update($admin1, $superAdmin));

        // 2. Super Admin có thể cập nhật Admin thường
        $this->assertTrue($policy->update($superAdmin, $admin1));

        // 3. Admin thường có thể tự cập nhật chính mình
        $this->assertTrue($policy->update($admin1, $admin1));

        // 4. Admin thường có thể cập nhật Admin thường khác (tùy thuộc vào thiết kế hệ thống có cho phép quản lý lẫn nhau không)
        $this->assertTrue($policy->update($admin1, $admin2));
    }
}
