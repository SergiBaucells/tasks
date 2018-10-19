<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
//    protected $fillable = ['name','completed'];
    protected $guarded = [];

    public function file()
    {
        // return $this->hasOne('App\File');
        return $this->hasOne(File::class);
    }
    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();
    }
}
