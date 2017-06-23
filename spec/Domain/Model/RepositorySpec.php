<?php

namespace spec\Domain\Model;

use Domain\Model\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('KnpLabs', 'magnolia');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Repository::class);
    }

    function it_contains_owner_name_and_repository_name()
    {
        $this->getOwner()->shouldReturn('KnpLabs');
        $this->getName()->shouldReturn('magnolia');
    }

    function it_throws_an_exception_if_there_is_no_slash_in_the_full_name()
    {
        $this
            ->beConstructedThrough('fromFullName', ['invalid-name'])
        ;
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->duringInstantiation()
        ;
    }

    function it_is_constructible_from_full_name()
    {
        $this->beConstructedThrough('fromFullName', ['KnpLabs/magnolia']);
        $this->getOwner()->shouldReturn('KnpLabs');
        $this->getName()->shouldReturn('magnolia');
    }
}
