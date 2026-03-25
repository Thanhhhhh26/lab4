<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo danh mục
        $categories = [
            ['name' => 'Thời Sự', 'slug' => 'thoi-su', 'description' => 'Tin tức thời sự trong nước và quốc tế'],
            ['name' => 'Thế Giới', 'slug' => 'the-gioi', 'description' => 'Tin tức thế giới'],
            ['name' => 'Kinh Tế', 'slug' => 'kinh-te', 'description' => 'Tin tức kinh tế, tài chính'],
            ['name' => 'Công Nghệ', 'slug' => 'cong-nghe', 'description' => 'Tin tức công nghệ, khoa học'],
            ['name' => 'Thể Thao', 'slug' => 'the-thao', 'description' => 'Tin tức thể thao'],
            ['name' => 'Giải Trí', 'slug' => 'giai-tri', 'description' => 'Tin tức giải trí, văn hóa'],
            ['name' => 'Sức Khỏe', 'slug' => 'suc-khoe', 'description' => 'Tin tức sức khỏe, y tế'],
            ['name' => 'Giáo Dục', 'slug' => 'giao-duc', 'description' => 'Tin tức giáo dục'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert(array_merge($cat, [
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Tạo user mẫu
        $userId = DB::table('users')->insertGetId([
            'name' => 'Quản Trị Viên',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_active' => 1,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo tin tức mẫu
        $newsData = [
            [
                'category_id' => 1,
                'title' => 'Hội nghị Trung ương bàn về phát triển kinh tế xã hội',
                'summary' => 'Hội nghị lần này tập trung thảo luận các giải pháp thúc đẩy tăng trưởng kinh tế trong bối cảnh mới.',
                'content' => '<p>Hội nghị Trung ương lần này đã tập trung thảo luận nhiều vấn đề quan trọng về phát triển kinh tế xã hội của đất nước trong giai đoạn tới.</p><p>Các đại biểu đã đề xuất nhiều giải pháp thiết thực nhằm thúc đẩy tăng trưởng kinh tế, cải thiện đời sống nhân dân và nâng cao vị thế của Việt Nam trên trường quốc tế.</p>',
                'featured' => 1,
                'views' => 1250,
            ],
            [
                'category_id' => 4,
                'title' => 'Việt Nam ra mắt nền tảng AI mới phục vụ giáo dục',
                'summary' => 'Nền tảng trí tuệ nhân tạo mới được phát triển bởi các kỹ sư Việt Nam, hỗ trợ học sinh học tập hiệu quả hơn.',
                'content' => '<p>Một nhóm kỹ sư trẻ Việt Nam vừa ra mắt nền tảng AI tiên tiến phục vụ cho lĩnh vực giáo dục, hứa hẹn mang lại cuộc cách mạng trong cách học tập của học sinh sinh viên.</p><p>Nền tảng này sử dụng công nghệ học máy để cá nhân hóa lộ trình học tập cho từng học sinh.</p>',
                'featured' => 1,
                'views' => 980,
            ],
            [
                'category_id' => 5,
                'title' => 'Đội tuyển Việt Nam giành chiến thắng ấn tượng',
                'summary' => 'Đội tuyển bóng đá Việt Nam đã có trận đấu xuất sắc, giành chiến thắng 3-0 trước đối thủ mạnh.',
                'content' => '<p>Trong trận đấu diễn ra tối qua, đội tuyển bóng đá Việt Nam đã thể hiện phong độ ấn tượng với chiến thắng 3-0 trước đối thủ.</p><p>Các cầu thủ đã thi đấu với tinh thần quyết tâm cao, mang về niềm vui cho hàng triệu người hâm mộ cả nước.</p>',
                'featured' => 0,
                'views' => 2100,
            ],
            [
                'category_id' => 3,
                'title' => 'Thị trường chứng khoán tăng mạnh phiên cuối tuần',
                'summary' => 'VN-Index tăng hơn 15 điểm trong phiên giao dịch cuối tuần, thanh khoản đạt mức cao.',
                'content' => '<p>Thị trường chứng khoán Việt Nam kết thúc tuần giao dịch với sắc xanh chiếm ưu thế. VN-Index tăng 15,3 điểm, đạt mức 1.285 điểm.</p><p>Thanh khoản toàn thị trường đạt hơn 18.000 tỷ đồng, tăng mạnh so với phiên trước.</p>',
                'featured' => 0,
                'views' => 756,
            ],
            [
                'category_id' => 7,
                'title' => 'Bộ Y tế khuyến cáo phòng chống dịch bệnh mùa hè',
                'summary' => 'Bộ Y tế đưa ra các khuyến cáo quan trọng về phòng chống các dịch bệnh thường gặp trong mùa hè.',
                'content' => '<p>Bộ Y tế vừa ban hành công văn khuyến cáo người dân chủ động phòng chống các dịch bệnh thường gặp trong mùa hè như sốt xuất huyết, tay chân miệng và tiêu chảy.</p><p>Người dân cần thực hiện các biện pháp vệ sinh cá nhân, ăn chín uống sôi và diệt muỗi thường xuyên.</p>',
                'featured' => 0,
                'views' => 543,
            ],
            [
                'category_id' => 2,
                'title' => 'Hội nghị G7 thảo luận về biến đổi khí hậu',
                'summary' => 'Các nhà lãnh đạo G7 nhóm họp để thảo luận về các biện pháp ứng phó với biến đổi khí hậu toàn cầu.',
                'content' => '<p>Hội nghị thượng đỉnh G7 năm nay đặt trọng tâm vào vấn đề biến đổi khí hậu và các cam kết giảm phát thải carbon.</p><p>Các nhà lãnh đạo đã đồng thuận về lộ trình chuyển đổi năng lượng sạch và hỗ trợ các nước đang phát triển.</p>',
                'featured' => 1,
                'views' => 890,
            ],
        ];

        foreach ($newsData as $news) {
            $title = $news['title'];
            DB::table('news')->insert(array_merge($news, [
                'user_id' => $userId,
                'slug' => Str::slug($title) . '-' . Str::random(5),
                'status' => 1,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]));
        }
    }
}
