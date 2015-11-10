<?php

namespace directapi\services\bids\models;

use directapi\components\constraints as DirectApiAssert;
use directapi\services\bids\enum\CalculateByEnum;
use directapi\services\bids\enum\PositionEnum;
use directapi\services\bids\enum\ScopeEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BidSetAutoItem
{
    /**
     * @var int
     */
    public $CampaignId;

    /**
     * @var int
     */
    public $AdGroupId;

    /**
     * @var int
     */
    public $KeywordId;

    /**
     * @var ScopeEnum[]
     * @Assert\NotBlank()
     * @DirectApiAssert\ArrayOf(type="directapi\services\bids\enum\ScopeEnum")
     */
    public $Scope;

    /**
     * @var int
     */
    public $MaxBid;

    /**
     * @var PositionEnum
     * @DirectApiAssert\IsEnum(type="directapi\services\bids\enum\PositionEnum")
     */
    public $Position;

    /**
     * @var int
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     * )
     */
    public $IncreasePercent;

    /**
     * @var CalculateByEnum
     * @DirectApiAssert\IsEnum(type="directapi\services\bids\enum\CalculateByEnum")
     */
    public $CalculateBy;

    /**
     * @var int
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     * )
     */
    public $ContextCoverage;

    /**
     * @Assert\Callback()
     * @param ExecutionContextInterface $context
     */
    public function isValid(ExecutionContextInterface $context)
    {
        if (!$this->CampaignId && !$this->AdGroupId && !$this->KeywordId) {
            $context->buildViolation('Должно быть указано одно из следующих значений: CampaignId, AdGroupId, KeywordId')
                ->atPath('CampaignId')
                ->atPath('AdGroupId')
                ->atPath('KeywordId')
                ->addViolation();
        }
    }
}