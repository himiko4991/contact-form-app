<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin(): void
    { 
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_admin(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        
        $response->assertStatus(200);
    }

    public function test_admin_can_search_contact_by_name(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::create([

            'content' => '商品のお届けについて',
        ]);

        $contact = Contact::create([
            'first_name' => '樋口',
            'last_name' => '兼続',
            'gender' => 1,
            'email' => 'kanetsugu@example.com',
            'tel' => '09012345678',
            'address' => '新潟県上越市',
            'building' => '春日山城',
            'category_id' => $category->id,
            'detail' => '商品について確認したい。',
        ]);
        
        $response = $this->actingAs($user)->get('/admin?keyword=兼続');
        $response->assertSee('樋口');
        $response->assertSee('兼続');
    }

    public function test_admin_can_search_contact_by_gender(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        $contact = Contact::create([
            'first_name' => '立花',
            'last_name' => '誾千代',
            'gender' => 2,
            'email' => 'ginchiyo@example.com',
            'tel' => '09098765432',
            'address' => '福岡県柳川市',
            'building' => '柳川城',
            'category_id' => $category->id,
            'detail' => '商品について確認したい。',
        ]);

        $response = $this->actingAs($user)->get('/admin?gender=2');

        $response->assertSee('立花');
        $response->assertSee('誾千代');

    }

    public function test_admin_can_search_contact_by_category(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::create([
            'content' => '商品の交換について',
        ]);

        $contact = Contact::create([
            'first_name' => '鈴木',
            'last_name' => '孫一',
            'gender' => 1,
            'email' => 'magoichi@example.com',
            'tel' => '09034567890',
            'address' => '和歌山県和歌山市',
            'building' => '雑賀城',
            'category_id' => $category->id,
            'detail' => '商品の交換について相談したい。',
        ]);

        $response = $this->actingAs($user)
            ->get('/admin?category_id=' . $category->id);

        $response->assertSee('鈴木');
        $response->assertSee('孫一');

    }

    public function test_admin_can_search_contact_by_date(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        $oldContact = Contact::create([
            'first_name' => '山中',
            'last_name' => '鹿介',
            'gender' => 1,
            'email' => 'shikanosuke@example.com',
            'tel' => '09011112222',
            'address' => '島根県安来市',
            'building' => '月山富田城',
            'category_id' => $category->id,
            'detail' => '商品について確認したい。',
            'created_at' => '2026-10-01 10:00:00',
            'updated_at' => '2026-10-01 10:00:00',
        ]);

        $oldContact->updateQuietly([
            'created_at' => '2026-10-01 10:00:00',
            'updated_at' => '2026-10-01 10:00:00',
        ]);

        $newContact = Contact::create([
            'first_name' => '高橋',
            'last_name' => '紹運',
            'gender' => 1,
            'email' => 'joun@example.com',
            'tel' => '09033334444',
            'address' => '福岡県太宰府市',
            'building' => '岩屋城',
            'category_id' => $category->id,
            'detail' => '商品について確認したい。',
            
        ]);
        

        $newContact->created_at = '2026-10-07 10:00:00';
        $newContact->updated_at = '2026-10-07 10:00:00';
        $newContact->saveQuietly();
                
        
        $response = $this->actingAs($user)
            ->get('/admin?date=2026-10-07');
           

        $response->assertSee('高橋');
        $response->assertDontSee('山中');  

    }
    
}
