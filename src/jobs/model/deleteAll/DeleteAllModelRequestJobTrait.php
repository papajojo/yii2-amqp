<?php
namespace matrozov\yii2amqp\jobs\model\deleteAll;

use matrozov\yii2amqp\Connection;
use matrozov\yii2amqp\jobs\model\ModelRequestJobTrait;
use matrozov\yii2amqp\jobs\model\ModelResponseJob;
use yii\base\ErrorException;

/**
 * Trait DeleteAllModelRequestJobTrait
 * @package matrozov\yii2amqp\jobs\model\deleteAll
 */
trait DeleteAllModelRequestJobTrait
{
    use ModelRequestJobTrait;

    /**
     * @param Connection $connection
     *
     * @return integer|bool|null
     * @throws
     */
    public function deleteAll(Connection $connection = null)
    {
        if (!$this->beforeModelRequest()) {
            return false;
        }

        $response = $this->send($connection);

        /* @var ModelResponseJob $response */
        if (!$this->afterModelRequest($response)) {
            return false;
        }

        if (!is_int($response->result)) {
            throw new ErrorException('Result must be integer (affected rows)!');
        }

        return $response->result;
    }
}