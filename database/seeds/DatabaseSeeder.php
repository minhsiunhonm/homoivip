<?php

use Illuminate\Database\Seeder;
use App\city;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city')->insert([
            "name" => "An Giang",
            "slug" => "an-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh An Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Kon Tum",
            "slug" => "kon-tum",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Kon Tum"
        ]); 
        DB::table('city')->insert([
            "name" => "Đắk Nông",
            "slug" => "dak-nong",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Đắk Nông"
        ]); 
        DB::table('city')->insert([
            "name" => "Sóc Trăng",
            "slug" => "soc-trang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Sóc Trăng"
        ]); 
        DB::table('city')->insert([
            "name" => "Bình Phước",
            "slug" => "binh-phuoc",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bình Phước"
        ]); 
        DB::table('city')->insert([
            "name" => "Hưng Yên",
            "slug" => "hung-yen",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hưng Yên"
        ]); 
        DB::table('city')->insert([
            "name" => "Thanh Hóa",
            "slug" => "thanh-hoa",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Thanh Hóa"
        ]); 
        DB::table('city')->insert([
            "name" => "Quảng Trị",
            "slug" => "quang-tri",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Quảng Trị"
        ]); 
        DB::table('city')->insert([
            "name" => "Tuyên Quang",
            "slug" => "tuyen-quang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Tuyên Quang"
        ]); 
        DB::table('city')->insert([
            "name" => "Quảng Ngãi",
            "slug" => "quang-ngai",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Quảng Ngãi"
        ]); 
        DB::table('city')->insert([
            "name" => "Hà Nội",
            "slug" => "ha-noi",
            "type" => "thanh-pho",
            "name_with_type" => "Thành phố Hà Nội"
        ]); 
        DB::table('city')->insert([
            "name" => "Lào Cai",
            "slug" => "lao-cai",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Lào Cai"
        ]); 
        DB::table('city')->insert([
            "name" => "Vĩnh Long",
            "slug" => "vinh-long",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Vĩnh Long"
        ]); 
        DB::table('city')->insert([
            "name" => "Lâm Đồng",
            "slug" => "lam-dong",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Lâm Đồng"
        ]); 
        DB::table('city')->insert([
            "name" => "Bình Định",
            "slug" => "binh-dinh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bình Định"
        ]); 
        DB::table('city')->insert([
            "name" => "Nghệ An",
            "slug" => "nghe-an",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Nghệ An"
        ]); 
        DB::table('city')->insert([
            "name" => "Kiên Giang",
            "slug" => "kien-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Kiên Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Hà Giang",
            "slug" => "ha-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hà Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Phú Yên",
            "slug" => "phu-yen",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Phú Yên"
        ]); 
        DB::table('city')->insert([
            "name" => "Lạng Sơn",
            "slug" => "lang-son",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Lạng Sơn"
        ]); 
        DB::table('city')->insert([
            "name" => "Đà Nẵng",
            "slug" => "da-nang",
            "type" => "thanh-pho",
            "name_with_type" => "Thành phố Đà Nẵng"
        ]); 
        DB::table('city')->insert([
            "name" => "Sơn La",
            "slug" => "son-la",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Sơn La"
        ]); 
        DB::table('city')->insert([
            "name" => "Tây Ninh",
            "slug" => "tay-ninh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Tây Ninh"
        ]); 
        DB::table('city')->insert([
            "name" => "Nam Định",
            "slug" => "nam-dinh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Nam Định"
        ]); 
        DB::table('city')->insert([
            "name" => "Lai Châu",
            "slug" => "lai-chau",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Lai Châu"
        ]); 
        DB::table('city')->insert([
            "name" => "Bến Tre",
            "slug" => "ben-tre",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bến Tre"
        ]); 
        DB::table('city')->insert([
            "name" => "Khánh Hòa",
            "slug" => "khanh-hoa",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Khánh Hòa"
        ]); 
        DB::table('city')->insert([
            "name" => "Bình Thuận",
            "slug" => "binh-thuan",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bình Thuận"
        ]); 
        DB::table('city')->insert([
            "name" => "Cao Bằng",
            "slug" => "cao-bang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Cao Bằng"
        ]); 
        DB::table('city')->insert([
            "name" => "Hải Phòng",
            "slug" => "hai-phong",
            "type" => "thanh-pho",
            "name_with_type" => "Thành phố Hải Phòng"
        ]); 
        DB::table('city')->insert([
            "name" => "Ninh Bình",
            "slug" => "ninh-binh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Ninh Bình"
        ]); 
        DB::table('city')->insert([
            "name" => "Yên Bái",
            "slug" => "yen-bai",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Yên Bái"
        ]); 
        DB::table('city')->insert([
            "name" => "Gia Lai",
            "slug" => "gia-lai",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Gia Lai"
        ]); 
        DB::table('city')->insert([
            "name" => "Hoà Bình",
            "slug" => "hoa-binh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hoà Bình"
        ]); 
        DB::table('city')->insert([
            "name" => "Bà Rịa - Vũng Tàu",
            "slug" => "ba-ria-vung-tau",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bà Rịa - Vũng Tàu"
        ]); 
        DB::table('city')->insert([
            "name" => "Cà Mau",
            "slug" => "ca-mau",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Cà Mau"
        ]); 
        DB::table('city')->insert([
            "name" => "Bình Dương",
            "slug" => "binh-duong",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bình Dương"
        ]); 
        DB::table('city')->insert([
            "name" => "Cần Thơ",
            "slug" => "can-tho",
            "type" => "thanh-pho",
            "name_with_type" => "Thành phố Cần Thơ"
        ]); 
        DB::table('city')->insert([
            "name" => "Thừa Thiên Huế",
            "slug" => "thua-thien-hue",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Thừa Thiên Huế"
        ]); 
        DB::table('city')->insert([
            "name" => "Đồng Nai",
            "slug" => "dong-nai",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Đồng Nai"
        ]); 
        DB::table('city')->insert([
            "name" => "Tiền Giang",
            "slug" => "tien-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Tiền Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Điện Biên",
            "slug" => "dien-bien",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Điện Biên"
        ]); 
        DB::table('city')->insert([
            "name" => "Vĩnh Phúc",
            "slug" => "vinh-phuc",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Vĩnh Phúc"
        ]); 
        DB::table('city')->insert([
            "name" => "Quảng Nam",
            "slug" => "quang-nam",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Quảng Nam"
        ]); 
        DB::table('city')->insert([
            "name" => "Đắk Lắk",
            "slug" => "dak-lak",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Đắk Lắk"
        ]); 
        DB::table('city')->insert([
            "name" => "Thái Nguyên",
            "slug" => "thai-nguyen",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Thái Nguyên"
        ]); 
        DB::table('city')->insert([
            "name" => "Hải Dương",
            "slug" => "hai-duong",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hải Dương"
        ]); 
        DB::table('city')->insert([
            "name" => "Bạc Liêu",
            "slug" => "bac-lieu",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bạc Liêu"
        ]); 
        DB::table('city')->insert([
            "name" => "Trà Vinh",
            "slug" => "tra-vinh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Trà Vinh"
        ]); 
        DB::table('city')->insert([
            "name" => "Thái Bình",
            "slug" => "thai-binh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Thái Bình"
        ]); 
        DB::table('city')->insert([
            "name" => "Hà Tĩnh",
            "slug" => "ha-tinh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hà Tĩnh"
        ]); 
        DB::table('city')->insert([
            "name" => "Ninh Thuận",
            "slug" => "ninh-thuan",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Ninh Thuận"
        ]); 
        DB::table('city')->insert([
            "name" => "Đồng Tháp",
            "slug" => "dong-thap",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Đồng Tháp"
        ]); 
        DB::table('city')->insert([
            "name" => "Long An",
            "slug" => "long-an",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Long An"
        ]); 
        DB::table('city')->insert([
            "name" => "Hậu Giang",
            "slug" => "hau-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hậu Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Quảng Ninh",
            "slug" => "quang-ninh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Quảng Ninh"
        ]); 
        DB::table('city')->insert([
            "name" => "Phú Thọ",
            "slug" => "phu-tho",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Phú Thọ"
        ]); 
        DB::table('city')->insert([
            "name" => "Quảng Bình",
            "slug" => "quang-binh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Quảng Bình"
        ]); 
        DB::table('city')->insert([
            "name" => "Hồ Chí Minh",
            "slug" => "ho-chi-minh",
            "type" => "thanh-pho",
            "name_with_type" => "Thành phố Hồ Chí Minh"
        ]); 
        DB::table('city')->insert([
            "name" => "Hà Nam",
            "slug" => "ha-nam",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Hà Nam"
        ]); 
        DB::table('city')->insert([
            "name" => "Bắc Ninh",
            "slug" => "bac-ninh",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bắc Ninh"
        ]); 
        DB::table('city')->insert([
            "name" => "Bắc Giang",
            "slug" => "bac-giang",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bắc Giang"
        ]); 
        DB::table('city')->insert([
            "name" => "Bắc Kạn",
            "slug" => "bac-kan",
            "type" => "tinh",
            "name_with_type" => "Tỉnh Bắc Kạn"
        ]); 
    }
}