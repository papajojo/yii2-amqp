<?php
namespace matrozov\yii2amqp\jobs\model\save;

use matrozov\yii2amqp\Connection;
use matrozov\yii2amqp\jobs\model\ModelRequestJob;

/**
 * Interface SaveRequestJob
 * @package matrozov\yii2amqp\jobs\model\save
 */
interface SaveRequestJob extends ModelRequestJob
{
    public function save(Connection $connection = null);
}