<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia;
use App\Models\Contact;

class CreateContactsTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function it_should_be_able_to_create_a_new_contact(): void
    {
        $data = [
            'name' => 'Rodolfo Meri',
            'email' => 'rodolfomeri@contato.com',
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->post('/contacts', $data);

        $response->assertRedirect('/contacts');

        $expected = $data;
        $expected['phone'] = preg_replace('/\D/', '', $expected['phone']);

        $this->assertDatabaseHas('contacts', $expected);
    }

    #[Test]
    public function it_should_validate_information(): void
    {
        $data = [
            'name' => 'ro',
            'email' => 'email-errado@',
            'phone' => '419'
        ];

        $response = $this->post('/contacts', $data);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone'
        ]);

        $this->assertDatabaseCount('contacts', 0);
    }

    #[Test]
    public function it_should_be_able_to_list_contacts_paginated_by_10_items_per_page(): void
    {
        Contact::factory(20)->create();

        $response = $this->get('/contacts');

        $response->assertStatus(200);

        $response->assertInertia(fn (AssertableInertia $page) =>
            $page->component('Contacts/Index')->has('contacts.data', 10)
        );
    }

    #[Test]
    public function it_should_be_able_to_delete_a_contact(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->delete("/contacts/{$contact->id}");

        $response->assertRedirect('/contacts');

        $this->assertDatabaseMissing('contacts', $contact->toArray());
    }

    #[Test]
    public function the_contact_email_should_be_unique(): void
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Rodolfo Meri',
            'email' => $contact->email,
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->post('/contacts', $data);

        $response->assertSessionHasErrors([
            'email'
        ]);

        $this->assertDatabaseCount('contacts', 1);
    }

    #[Test]
    public function it_should_be_able_to_update_a_contact(): void
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Rodolfo Meri',
            'email' => 'emailatualizado@email.com',
            'phone' => '(41) 98899-4422'
        ];

        $response = $this->put("/contacts/{$contact->id}", $data);

        $response->assertRedirect('/contacts');

        $expected = $data;

        $expected['phone'] = preg_replace('/\D/', '', $expected['phone']);

        $this->assertDatabaseHas('contacts', $expected);

        $this->assertDatabaseMissing('contacts', $contact->toArray());
    }
}
