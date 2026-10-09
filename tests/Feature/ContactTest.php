<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_contact_form_is_displayed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

    }

    public function test_valid_contact_can_show_confirm_page(): void
    {
        $category = Category::create([
            'content' => '商品のお届けについて',

        ]);

        $tag = Tag::create([
            'name' => '質問',

        ]);

        $data = [
            'first_name' => '樋口',
            'last_name' => '兼続',
            'gender' => 1,
            'email' => 'kanetsugu@example.com',
            'tel' => '09012345678',
            'address' => '新潟県上越市',
            'building' => '春日山城',
            'category_id' => $category->id,
            'detail' => '商品について確認したい。',    
        ];

        $response = $this->post('/contacts/confirm', $data);


        $response->assertStatus(200);

    


    }

    public function test_contact_form_validation(): void
    {
        $response = $this->post('/contacts/confirm', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'category_id',
            'detail',
        ]);
    }

    public function test_contact_can_be_stored(): void
    {
        $category = Category::create([
            'content' => '商品のお届けについて',   
        ]);

        $tag = Tag::create([
            'name' => '質問',

        ]);


        $data = [
            'first_name' => '樋口',
            'last_name' => '兼続',
            'gender' => 1,
            'email' => 'kanetsugu@example.com',
            'tel' => '09012345678',
            'address' => '新潟県上越市',
            'building' => '春日山城',
            'category_id' => $category->id,
            'tag_ids' => [$tag->id],
            'detail' => '商品について確認したい。',
        ];

        $response = $this->post('/contacts', $data);

        $this->assertDatabaseHas('contacts', [
            'first_name' => '樋口',
            'last_name' => '兼続',
            'email' => 'kanetsugu@example.com',    
        ]);

        $this->assertDatabaseHas('contact_tag', [
            'tag_id' => $tag->id,

        ]);

        $response->assertRedirect('/thanks');



    }
}
