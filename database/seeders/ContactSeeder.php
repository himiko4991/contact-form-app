<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = Contact::create([
            'category_id' => 1,
            'first_name' => '織田',
            'last_name' => '信長',
            'gender' => 1,
            'email' => 'nobunaga@example.com',
            'tel' => '09012345678',
            'address' => '愛知県清須市',
            'building' => '清洲城',
            'detail' => '商品のお届けについて確認したい。',
        ]);
        $contact->tags()->attach(1);

        $sakon = Contact::create([
            'category_id' => 2,
            'first_name' => '島',
            'last_name' => '左近',
            'gender' => 1,
            'email' => 'sakon@example.com',
            'tel' => '09023456789',
            'address' => '奈良県大和郡山市',
            'building' => '佐和山城',
            'detail' => '商品の不具合について。',
        ]);
        $sakon->tags()->attach([2,3]);

        $magoichi = Contact::create([
            'category_id' => 3,
            'first_name' => '鈴木',
            'last_name' => '孫一',
            'gender' => 1,
            'email' => 'magoichi@example.com',
            'tel' => '09034567890',
            'address' => '和歌山県和歌山市',
            'building' => '雑賀城',
            'detail' => '商品の交換について相談したい。',
        ]);
        $magoichi->tags()->attach([1, 3, 5]);
        
        $shikanosuke = Contact::create([
            'category_id' => 4,
            'first_name' => '山中',
            'last_name' => '鹿介',
            'gender' => 1,
            'email' => 'shikanosuke@example.com',
            'tel' => '09045678901',
            'address' => '島根県安来市',
            'building' => '月山富田城',
            'detail' => 'サービスの利用方法について確認したい。',
        ]);
        $shikanosuke->tags()->attach([2, 4]);

        $shoun = Contact::create([
            'category_id' => 5,
            'first_name' => '高橋',
            'last_name' => '紹運',
            'gender' => 1,
            'email' => 'shoun@example.com',
            'tel' => '09056789012',
            'address' => '福岡県太宰府市',
            'building' => '岩屋城',
            'detail' => 'サービス内容について詳しく確認したい。',
        ]);
        $shoun->tags()->attach([2, 4, 5]);

        $yoshiteru = Contact::create([
            'category_id' => 1,
            'first_name' => '足利',
            'last_name' => '義輝',
            'gender' => 1,
            'email' => 'yoshiteru@example.com',
            'tel' => '09067890123',
            'address' => '京都府京都市',
            'building' => '二条御所',
            'detail' => '商品の配送状況について確認したい。',
        ]);
        $yoshiteru->tags()->attach([1, 4]);

        $toyohisa = Contact::create([
            'category_id' => 2,
            'first_name' => '島津',
            'last_name' => '豊久',
            'gender' => 1,
            'email' => 'toyohisa@example.com',
            'tel' => '09078901234',
            'address' => '鹿児島県日置市',
            'building' => '佐土原城',
            'detail' => '商品について質問したい。',
        ]);
        $toyohisa->tags()->attach([2]);

        $chacha = Contact::create([
            'category_id' => 3,
            'first_name' => '浅井',
            'last_name' => '茶々',
            'gender' => 2,
            'email' => 'chacha@example.com',
            'tel' => '09089012345',
            'address' => '滋賀県長浜市',
            'building' => '小谷城',
            'detail' => '商品について詳しく確認したい。',
        ]);
        $chacha->tags()->attach([1, 3]);

        $masako = Contact::create([
            'category_id' => 4,
            'first_name' => '北条',
            'last_name' => '政子',
            'gender' => 2,
            'email' => 'masako@example.com',
            'tel' => '09090123456',
            'address' => '神奈川県鎌倉市',
            'building' => '鎌倉御所',
            'detail' => 'サービスについて問い合わせたい。',
        ]);
        $masako->tags()->attach([2, 5]);

        $sakihisa = Contact::create([
           'category_id' => 5,
           'first_name' => '近衛',
           'last_name' => '前久',
           'gender' => 1,
           'email' => 'sakihisa@example.com',
           'tel' => '09001234567',
           'address' => '京都府京都市',
           'building' => '近衛邸',
           'detail' => 'お問い合わせ内容について確認したい。',
        ]);
        $sakihisa->tags()->attach([1, 3, 5]);

        $kagekatsu = Contact::create([
           'category_id' => 1,
           'first_name' => '上杉',
           'last_name' => '景勝',
           'gender' => 1,
           'email' => 'kagekatsu@example.com',
           'tel' => '09012345001',
           'address' => '新潟県南魚沼市',
           'building' => '坂戸城',
           'detail' => '商品の配送について確認したい。',
        ]);
        $kagekatsu->tags()->attach([4]);

        $ginchiyo = Contact::create([
            'category_id' => 2,
            'first_name' => '立花',
            'last_name' => '誾千代',
            'gender' => 2,
            'email' => 'ginchiyo@example.com',
            'tel' => '09023456002',
            'address' => '福岡県柳川市',
            'building' => '立花城',
            'detail' => '商品について質問したい。',
        ]);
        $ginchiyo->tags()->attach([2, 3]);

        $fujitaka = Contact::create([
            'category_id' => 3,
            'first_name' => '細川',
            'last_name' => '藤孝',
            'gender' => 1,
            'email' => 'fujitaka@example.com',
            'tel' => '09034567003',
            'address' => '京都府舞鶴市',
            'building' => '田辺城',
            'detail' => '商品の交換について相談したい。',
        ]);
        $fujitaka->tags()->attach([1, 4, 5]);

        $motochika = Contact::create([
            'category_id' => 4,
            'first_name' => '長宗我部',
            'last_name' => '元親',
            'gender' => 1,
            'email' => 'motochika@example.com',
            'tel' => '09045678004',
            'address' => '高知県高知市',
            'building' => '岡豊城',
            'detail' => 'サービスの利用方法について確認したい。',
        ]);
        $motochika->tags()->attach([3]);

        $masayuki = Contact::create([
            'category_id' => 5,
            'first_name' => '保科',
            'last_name' => '正之',
            'gender' => 1,
            'email' => 'masayuki@example.com',
            'tel' => '09056789005',
            'address' => '福島県会津若松市',
            'building' => '若松城',
            'detail' => 'お問い合わせ内容について確認したい。',
        ]);
        $masayuki->tags()->attach([2, 4]);

        $doyo = Contact::create([
            'category_id' => 1,
            'first_name' => '佐々木',
            'last_name' => '道誉',
            'gender' => 1,
            'email' => 'doyo@example.com',
            'tel' => '09067890006',
            'address' => '滋賀県米原市',
            'building' => '勝楽寺城',
            'detail' => '商品の配送について確認したい。',
        ]);

        $doyo->tags()->attach([1, 5]);

        $yoshiaki = Contact::create([
            'category_id' => 2,
            'first_name' => '最上',
            'last_name' => '義光',
            'gender' => 1,
            'email' => 'yoshiaki@example.com',
            'tel' => '09078901007',
            'address' => '山形県山形市',
            'building' => '山形城',
            'detail' => '商品について質問したい。',
        ]);
        $yoshiaki->tags()->attach([2, 3]);

        $sozui = Contact::create([
            'category_id' => 3,
            'first_name' => '伊勢',
            'last_name' => '宗瑞',
            'gender' => 1,
            'email' => 'sozui@example.com',
            'tel' => '09089012008',
            'address' => '神奈川県小田原市',
            'building' => '小田原城',
            'detail' => '商品の交換について相談したい。',
        ]);
        $sozui->tags()->attach([1, 3, 4]);
        
        $tsunenaga = Contact::create([
            'category_id' => 4,
            'first_name' => '支倉',
            'last_name' => '常長',
            'gender' => 1,
            'email' => 'tsunenaga@example.com',
            'tel' => '09090123009',
            'address' => '宮城県仙台市',
            'building' => '仙台城',
            'detail' => 'サービスの利用方法について確認したい。',
        ]);
        $tsunenaga->tags()->attach([2, 5]);

        $motoyasu = Contact::create([
            'category_id' => 5,
            'first_name' => '松平',
            'last_name' => '元康',
            'gender' => 1,
            'email' => 'motoyasu@example.com',
            'tel' => '09001234010',
            'address' => '愛知県岡崎市',
            'building' => '岡崎城',
            'detail' => 'お問い合わせ内容について確認したい。',
        ]);
        $motoyasu->tags()->attach([1, 3, 5]);
     
        
    }
}
