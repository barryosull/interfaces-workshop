<?php namespace Tests\Acceptance;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class ContactTest extends TestCase
{
    const CONTACT_EMAIL = 'contact@me.com';

    public function test_add_contact()
    {
        $response = $this->addContact();

        $response->assertSessionHas("ok", "Your message has been recorded, we will respond as soon as possible.");
    }

    private function addContact(): TestResponse
    {
        $uri = "contacts";
        $data = [
            'name' => "fsdfsd",
            'email' => self::CONTACT_EMAIL,
            'message' => "sdfdsfsd"
        ];
        return $this->post($uri, $data);
    }

    public function test_fetch_contacts()
    {
        $this->addContact();

        $response = $this->fetchContacts();

        $this->assertContains(self::CONTACT_EMAIL, $response->getContent(), "HTML does not contain contact");
    }

    private function fetchContacts(): TestResponse
    {
        $user = factory(User::class)->create(['role'=>'admin']);

        $uri = 'admin/contacts';

        return $this->actingAs($user)
            ->get($uri);
    }
}