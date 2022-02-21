<?php


namespace App\Services\Helpers;


class EnsOrderHelper
{
    public static function convertBoolToSex($string)
    {
        return $string == '1' ? 'М' : 'Ж';
    }

    public static function convertDocCLassName($typeId)
    {
        switch ($typeId) {
            case '1':
                $docClassName = 'Удостоверение личности гражданина Казахстана';
                break;
            case '2':
                $docClassName = 'Паспорт гражданина Казахстана';
                break;
            case '3':
                $docClassName = 'Свидетельство о рождении';
                break;
            case '4':
                $docClassName = 'Вид на жительство';
                break;
            case '8':
                $docClassName = 'Служебный паспорт Республики Казахстан';
                break;
            default:
                $docClassName = null;
        }
        return $docClassName;
    }

    public static function secret($response)
    {
        if(isset($response['client']['DOCUMENT_GIVED_DATE']))
            $response['client']['DOCUMENT_GIVED_DATE'] = substr($response['client']['DOCUMENT_GIVED_DATE'], 0, 1) . "*.**.***" . substr($response['client']['DOCUMENT_GIVED_DATE'], -1);
        if(isset($response['client']['DOCUMENT_NUMBER']))
            $response['client']['DOCUMENT_NUMBER'] = substr($response['client']['DOCUMENT_NUMBER'], 0, 2) . "*****" . substr($response['client']['DOCUMENT_NUMBER'], -2);
        return $response;
    }

    public static function identifySexByIIN($iin)
    {
        $sexIndex = (int)$iin[6];
        if($sexIndex % 2 == 0) return 'Ж';
        else return 'М';
    }

}
