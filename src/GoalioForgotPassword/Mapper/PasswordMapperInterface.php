<?php
namespace GoalioForgotPassword\Mapper;

interface PasswordMapperInterface
{
    public function remove($passwordModel);

    public function findByUserId($userId);

    public function findByRequestKey($key);

    public function cleanExpiredForgotRequests($expiryTime=86400);

    public function cleanPriorForgotRequests($userId);

    public function findByUserIdRequestKey($userId, $token);

    function fromRow($row);

    public function toScalarValueArray($passwordModel);
}
