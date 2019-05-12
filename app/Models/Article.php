<?php
/*
 * 文章模型
 *
 * */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //过滤黑名单
    protected  $guarded=[];

}
