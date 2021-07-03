<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Haruncpi\LaravelSimpleFilemanager\Controllers\FilemanagerController as Base;
use Haruncpi\LaravelSimpleFilemanager\Model\Filemanager;
use Illuminate\Http\Request;

class FilemanagerController extends Base
{
    public function getFiles(Request $r)
    {
        $data = new Filemanager();
        $data = $data->orderBy('id', 'desc');

        if ($r->has('q')) {
            $q = $r->get('q');
            if ($q !== 'undefined' && $q !== '' && !empty($q)) {
                $data = $data->where('name', 'like', '%' . $q . '%');
            }
        }

        if ($r->has('file_type')) {
            $type = $r->get('file_type');
            switch ($type) {
                case 'image';
                    $data = $data->whereIn('ext', $this->imageFormat);
                    break;
            }
        }

        return $data->paginate(20);
    }
}
