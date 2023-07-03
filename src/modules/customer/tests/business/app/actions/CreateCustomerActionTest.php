<?php

use DDD\Modules\Customer\Business\Types\Phone;
use DDD\Modules\Customer\Business\App\Actions\CreateCustomer\CreateCustomerAction;
use DDD\Modules\Customer\Business\App\Actions\CreateCustomer\CreateCustomerOutput;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreateCustomerRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreatePhoneRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\ReadCustomerByNameRepo;
use DDD\Modules\Customer\Business\Entities\Cart;
use DDD\Modules\Customer\Business\Entities\Customer;
use DDD\Modules\Customer\Tests\CustomerTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateCustomerActionTest extends TestCase
{
    /** @test */
    public function itShouldCreateCustomer()
    {
        /** @var CreateCustomerRepo|CreatePhoneRepo|CreateCartRepo|MockObject $repo */
        $repo = $this->createStub(CustomerTestRepository::class);

        $customer = Customer::createWithId('1', 'customer', new Phone('12345'));

        $repo
            ->method('createCustomer')
            ->willReturn($customer);
        
        $cart = new Cart('2');

        $repo
            ->method('createCart')
            ->willReturn($cart);

        $action = new CreateCustomerAction($repo);
        $output = $action->execute($customer->name, $customer->phone->value);

        $expectedOutput = new CreateCustomerOutput(
            '1', 'customer', '12345', '2'
        );

        $this->assertEquals($expectedOutput, $output);
    }

    /** @test */
    public function itShoutNotCreateCustomerWithExistentName()
    {
        /** @var ReadCustomerByNameRepo|MockObject $repo */
        $repo = $this->createStub(ReadCustomerByNameRepo::class);

        $customer = Customer::createWithId('1', 'customer', new Phone('12345'));

        $repo
            ->method('readCustomerByName')
            ->willReturn($customer);

        $action = new CreateCustomerAction($repo);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("customer with name of {$customer->name} already exists");

        $action->execute('customer', '12345');
    }
}
