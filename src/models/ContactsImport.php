<?php
namespace pantera\crm\contacts\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ContactsImport extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;
    public $clients = [];
    private $_savedFile;
    public $parsedArray;

    const SCENARIO_SAVE_CLIENTS = 'save_clients';

    public function rules()
    {
        return [
            [['importFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv','wrongMimeType' => false,'checkExtensionByMimeType' => false,'except' => self::SCENARIO_SAVE_CLIENTS],
            [['clients'],'each','rule' => 'string'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->_savedFile = $this->importFile->tempName;
            return true;
        } else {
            return false;
        }
    }


    public function parse() {
        if($this->upload()) {
            $file = fopen($this->_savedFile,'r+');
            $this->parsedArray = [];
            $i = 0;
            while ($row = fgetcsv($file)) {
                foreach ($row as $column) {
                    $this->parsedArray[$i][] = $column;
                }
                $i++;
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveParamGroup($name) {
        $name = trim($name);
        $group = ParamGroup::findOne(['name' => $name]);
        if(!$group) {
            $group = new ParamGroup(['name' => $name]);
            $group->save();
        }
        return $group;
    }

    public function saveParam(ParamGroup $group, $name) {
        $name = trim($name);
        $param = Param::findOne(['name' => $name, 'group_id' => $group->id]);
        if(!$param) {
            $param = new Param(['name' => $name, 'group_id' => $group->id]);
        }
        $param->save();
        return $param;
    }

    public function registryClientParam(Contact $client, Param $param, ParamGroup $paramGroup) {
        $registryRecord = ParamRegistry::findOne(['param_id' => $paramGroup->id, 'contact_id' => $client->id]);
        if(!$registryRecord) {
            $registryRecord = new ParamRegistry([
                'param_id' => $param->id,
                'contact_id' => $client->id,
            ]);
        }
        $registryRecord->user_id = 1;
        $registryRecord->save();
    }

    public function saveClients() {
        $header = [0 => 'nameee'];
        if(isset($this->clients[0])) $header = $this->clients[1];
        $header = json_decode($header);
        unset($this->clients[1]);
        foreach ($this->clients as $client) {
            $clientData = json_decode($client);
            if(is_array($clientData)) {
                $client = new Contact();
                $nameArray = explode(' ',$clientData[0]); //Имя фамилия отчество
                if(isset($nameArray[0])) {
                    $client->first_name = $nameArray[0];
                }
                if(isset($nameArray[1])) {
                    $client->last_name = $nameArray[1];
                }
                if(isset($nameArray[2])) {
                    $client->middle_name = $nameArray[2];
                }
                if(!empty($clientData[3])) {
                    $client->email = $clientData[3];
                }
                $client->phone = $clientData[2];
                $client->save();
                unset($clientData[0]);
                unset($clientData[2]);
                unset($clientData[3]);
                unset($header[0]);
                unset($header[2]);
                unset($header[3]);
                //Атрибуты
                foreach ($header as $key => $value) {
                    $paramGroup = $this->saveParamGroup($value);
                    $param = $this->saveParam($paramGroup,$clientData[$key]);
                    $this->registryClientParam($client,$param,$paramGroup);
                }
            }

        }
        return true;
    }
}