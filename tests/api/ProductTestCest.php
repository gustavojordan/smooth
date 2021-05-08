<?php

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTestCest
{
    public function _before(ApiTester $I)
    {
        Artisan::call('db:seed');
    }

    public function getProduct(ApiTester $I)
    {
        $I->wantToTest('get product from seeder');

        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendGET('product/1');
        $I->seeResponseCodeIs(200);

        $I->seeResponseContainsJson(['id' => 1]);
    }

    public function listAllProducts(ApiTester $I)
    {

        $I->wantToTest('list all products from seeder');

        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendGET('product');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['total' => 3]);
    }

    public function listAllCategories(ApiTester $I)
    {

        $I->wantToTest('get all categories from seeder');

        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendGET('category');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['total' => 3]);
    }

    public function createProduct(ApiTester $I)
    {

        $I->wantToTest('create product');

        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendPOST('product', [
            'name' => 'this is name',
            'sku' => '111111111',
            'price' => '1.1',
            'category_id' => 1
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['id' => 4]);
    }

    public function createProductWrongParameters(ApiTester $I)
    {

        $I->wantToTest('create product without name should return 422');

        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendPOST('product', [
            'price' => '1.1',
            'sku' => '111111111',
            'category_id' => 1
        ]);

        $I->seeResponseCodeIs(422);
    }

    public function deleteProduct(ApiTester $I)
    {

        $I->wantToTest('delete product one');
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendDELETE('product/1');
        $I->seeResponseCodeIs(204);
    }

    public function updateProduct(ApiTester $I)
    {
        $I->wantToTest('update product one');
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendPUT('product/1', ['name' => 'NameChange']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'NameChange']);
    }

    public function updateProductAllAttributes(ApiTester $I)
    {
        $I->wantToTest('update product one all attributes');
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $I->amBearerAuthenticated($token);
        $I->sendPUT('product/1', ['name' => 'ONE', 'sku' => '123', 'category_id' => 3, 'price' => '99.99']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'ONE', 'sku' => '123', 'category_id' => 3, 'price' => '99.99']);
    }}
