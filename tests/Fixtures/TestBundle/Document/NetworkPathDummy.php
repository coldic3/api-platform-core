<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Tests\Fixtures\TestBundle\Document;

use ApiPlatform\Api\UrlGeneratorInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ApiResource(urlGenerationStrategy: UrlGeneratorInterface::NET_PATH)]
#[ApiResource(uriTemplate: '/network_path_relation_dummies/{id}/network_path_dummies.{_format}', uriVariables: ['id' => new Link(fromClass: \ApiPlatform\Tests\Fixtures\TestBundle\Document\NetworkPathRelationDummy::class, identifiers: ['id'], toProperty: 'networkPathRelationDummy')], status: 200, urlGenerationStrategy: UrlGeneratorInterface::NET_PATH, operations: [new GetCollection()])]
#[ODM\Document]
class NetworkPathDummy
{
    #[ODM\Id(strategy: 'INCREMENT', type: 'int')]
    private $id;
    #[ODM\ReferenceOne(targetDocument: NetworkPathRelationDummy::class, inversedBy: 'networkPathDummies', storeAs: 'id')]
    public $networkPathRelationDummy;

    public function getId()
    {
        return $this->id;
    }
}
