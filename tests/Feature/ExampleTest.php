<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Bill;
use App\Models\BillIssuer;
use App\Models\BillItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_bill()
    {
        $billIssuers = BillIssuer::factory()->count(2)->create();
        
        $body =
        ["due_date" => '2024-01-01', "bill_items" => [
                ["amount" => 88888, "bill_issuer_id" => $billIssuers[0]->id],
                ["amount" => 22222, "bill_issuer_id" => $billIssuers[1]->id]
            ]
        ];

        $response = $this->actingAs(User::factory()->create())->post("/api/bills", $body);

        $billId = $response->json('id');

        $this->assertDatabaseHas("bills", ["id" => $billId, "amount" => 111110]);

        $this->assertDatabaseHas("bill_items", ["bill_id" => $billId, "amount" => 88888, "bill_issuer_id" => 1]);
        $this->assertDatabaseHas("bill_items", ["bill_id" => $billId, "amount" => 22222, "bill_issuer_id" => 2]);
    }

    public function test_create_invalid_bill_due_date()
    {
        $billIssuer = BillIssuer::factory()->create();

        $body = [
            'due_date' => 'hey',
            'bill_items' => [
                ["amount" => 88888, "bill_issuer_id" => $billIssuer->first()->id]
            ]
        ];

        $response = $this->actingAs(User::factory()->create())->post("/api/bills", $body, ["Accept" => "application/json"]);

        $response->assertStatus(422);

        $response->assertJsonFragment(["message" => "The due date field must be a valid date."]);
    }

    public function test_create_invalid_bill_issuer()
    {
        $body = [
            'due_date' => '2025-01-01',
            'bill_items' => [
                ["amount" => 88888, "bill_issuer_id" => 5]
            ]
        ];

        $response = $this->actingAs(User::factory()->create())->post("/api/bills", $body, ["Accept" => "application/json"]);

        $response->assertStatus(422);

        $response->assertJsonFragment(["message" => "The selected bill_items.0.bill_issuer_id is invalid."]);
    }

    public function test_create_valid_bill_invalid_item_amount()
    {
        $billIssuer = BillIssuer::factory()->create();

        $body = [
            'due_date' => '2024-01-01',
            'bill_items' => [
                ["amount" => "Hey", "bill_issuer_id" => $billIssuer->first()->id]
            ]
        ];

        $response = $this->actingAs(User::factory()->create())->post("/api/bills", $body, ["Accept" => "application/json"]);

        $response->assertStatus(422);

        $response->assertJsonFragment(["message" => "The bill_items.0.amount field must be a number."]);
    }

    public function test_create_valid_bill_no_bill_items()
    {
        $body = [
            'due_date' => '2024-01-01',
            'bill_items' => [
            ]
        ];

        $response = $this->actingAs(User::factory()->create())->post("/api/bills", $body, ["Accept" => "application/json"]);

        $response->assertStatus(422);

        $response->assertJsonFragment(["message" => "The bill items field must have a value."]);
    }

    public function test_update_bill()
    {
        $bill = Bill::factory()->create(['due_date' => '2021-04-03', 'amount' => 1001]);

        $body = [
            'id' => $bill->first()->id,
            'due_date' => '2024-01-01',
            'amount' => 20002
        ];

        $response = $this->actingAs(User::factory()->create())->put("/api/bills/" . $bill->first()->id, $body, ["Accept" => "application/json"]);

        $this->assertDatabaseHas('bills', ['id' => $bill->first()->id, 'due_date' => '2024-01-01', 'amount' => 1001]);
    }

    public function test_update_invalid_bill()
    {
        $body = [
            'due_date' => '2024-01-01',
        ];

        $response = $this->actingAs(User::factory()->create())->put("/api/bills/" . 5, $body, ["Accept" => "application/json"]);

        $response->assertStatus(404);
    }

    public function test_add_bill_item()
    {
        $body = [
            'due_date' => '2024-01-01',
        ];

        $response = $this->actingAs(User::factory()->create())->put("/api/bills/" . 5, $body, ["Accept" => "application/json"]);

        $response->assertStatus(404);
    }
}
