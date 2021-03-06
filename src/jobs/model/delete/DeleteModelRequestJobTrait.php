<?php
namespace matrozov\yii2amqp\jobs\model\delete;

use matrozov\yii2amqp\Connection;
use matrozov\yii2amqp\jobs\model\ModelRequestJobTrait;
use matrozov\yii2amqp\jobs\model\ModelResponseJob;
use yii\base\ErrorException;

/**
 * Trait DeleteModelRequestJobTrait
 * @package matrozov\yii2amqp\jobs\model\delete
 */
trait DeleteModelRequestJobTrait
{
    use ModelRequestJobTrait;

    /**
     * @param Connection $connection
     *
     * @return integer|bool|null
     * @throws
     */
    public function delete(Connection $connection = null)
    {
        if (!$this->beforeModelRequest()) {
            return false;
        }

        $response = $this->send($connection);

        /* @var ModelResponseJob $response */
        if (!$this->afterModelRequest($response)) {
            return false;
        }

        if (!is_bool($response->result) && !is_int($response->result)) {
            throw new ErrorException('Result must be boolean or integer!');
        }

        return $response->result;
    }
}