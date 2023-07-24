<?php

use DDD\Modules\Customer\Business\Types\Phone;
use DDD\Modules\Customer\Business\App\Actions\UpdateCustomer\UpdateCustomerAction;
use DDD\Modules\Customer\Business\App\Actions\UpdateCustomer\UpdateCustomerOutput;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\ReadCustomerByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\UpdateCustomerRepo;
use DDD\Modules\Customer\Business\Entities\Customer;
use DDD\Modules\Customer\Tests\CustomerTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class UpdateCustomerActionTest extends TestCase
{
    /** @test */
    public function itShouldUpdateCustomer()
    {
        /** @var UpdateCustomerRepo|ReadCustomerByIdRepo|MockObject $repo */
        $repo = $this->createStub(CustomerTestRepository::class);

        $customer = Customer::createWithId('1', 'customer', new Phone('12345'));

        $repo
            ->method('readCustomerById')
            ->willReturn($customer);
        
        $repo
            ->method('updateCustomer')
            ->willReturn($customer);

        $action = new UpdateCustomerAction($repo);
        $output = $action->execute($customer->id, $customer->name, $customer->phone->value);

        $expectedOutput = new UpdateCustomerOutput('1', 'customer', '12345');
        
        $this->assertEquals($expectedOutput, $output);
    }

    /** @test */
    public function itShouldThrowExceptionIfCustomerIsNotExists(): void
    {
        /** @var ReadCustomerByIdRepo|MockObject $repo */
        $repo = $this->createStub(ReadCustomerByIdRepo::class);

        
        $repo
        ->method('readCustomerById')
        ->willReturn(null);
        
        $action = new UpdateCustomerAction($repo);
        
        $customer = Customer::createWithId('1', 'customer', new Phone('12345'));
        
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("customer with id of {$customer->id} does not exists");
        
        $action->execute($customer->id, $customer->name, $customer->phone->value);
    }
}
