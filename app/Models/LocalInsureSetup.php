<?php
/**
 * Created by PhpStorm.
 * User: wangsl
 * Date: 2018/7/12
 * Time: 18:44
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalInsureSetup extends Model{

	protected $connection = 'local_mysql';
	protected $table = 'insure_setup';
}